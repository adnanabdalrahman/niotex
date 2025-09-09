<?php

namespace App\Services\SDServices;

use App\Exceptions\AdresseGesperrtException;
use App\Exceptions\AdresseNotFoundException;
use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Preisbasis;
use App\Services\PositionService;
use App\Services\VorgangService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;


class SD_0101_Services
{
    protected string $baseUrl;
    protected string $sd0102_path;
    protected string $sd0301_path;

    protected array $vorgruppeMapping;

    protected array $auth;

    protected array $mwstSatzProzentArray;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');
        $this->auth = [
            'client_id' => config('sap.client_id'),
            'client_secret' => config('sap.client_secret'),
        ];
        $this->sd0102_path = config('sap.sd0102_path');
        $this->sd0301_path = config('sap.sd0301_path');
        $this->vorgruppeMapping = config('vorgruppeMapping');
        $this->mwstSatzProzentArray = [
            7 => 2,
            19 => 3,
            0 => 4,
        ];
    }

    /**
     * SAP -> CEOS
     * SD-01-01 Beauftragung
     * @throws Throwable
     */
    public function sd_0101_beauftragung($requestData): ?array
    {
        // todo Important Adresse.Sperrkennzeichen ist 1 (gesperrt) darf keinen Auftrag anlegen.
        /*
            'vbeln' → Verkaufsbeleg Vorgang.VorIndividualC1
            'auart' → Vorgang.VorIndividualC2
            'kunnr' → Adresse.AdressNummer → Adresse.InterneAdressnummer(zu speichernde nummer in: Vorgang.VorAuftraggeber)
            'vdatu' → Vorgang.VorLieferung-WunschDatum Wunschlieferdatum
            'zzlgsnr' → Vorgang.VorIndividualC3 Liegenschaftsnummer
            'genrCeos' → Vorgang.VorIndividualD4
            'txtZ012' → Vorgang2Text.VorNotiz Bemerkung zur Liegenschaft
            'txtZ013' → Vorgang.VorStichwort für Reparaturaufträge Ausstattung / Austauschgrund
        */
        return DB::transaction(function () use (&$requestData) {
            $header = $requestData['header'];
            $positions = $requestData['positions'];
            $adresse = Adresse::where('AdressNummer', $header['kunnr'])->first();
            if ($adresse !== null) {
                if ($adresse->AdrLiefersperreJN == "1") {
                    throw new AdresseGesperrtException($adresse->AdressNummer);
                }
                $data['VorAuftraggeber'] = $adresse->InterneAdressnummer; // Kunnr
                $data['VorLieferanschrift'] = $adresse->InterneAdressnummer;
                $data['VorRechnungsanschrift'] = $adresse->InterneAdressnummer;
                $data['VorSammelRechnungsanschrift'] = $adresse->InterneAdressnummer;
            } else {
                throw new AdresseNotFoundException($header['vbeln'], $header['kunnr']);
            }
            $materialGruppe = substr($positions[0]['aufnr'], 0, 2);

            $vorGruppe = isset($this->vorgruppeMapping[$header['augru'] . $materialGruppe]) ?
                $this->vorgruppeMapping[$header['augru'] . $materialGruppe] : 'RE';

            //vdatu
            $data['VorLieferungWunschDatum'] = Carbon::parse($header['vdatu'])->format('Ymd');
            $data['VorStichwort'] = $header['txtZ013'] ?? 'MONTAGEAUFTRAG';
            $data['VorIndividualC1'] = $header['vbeln'];
            $data['VorIndividualC2'] = $header['auart'];
            $data['VorIndividualC3'] = $header['zzlgsnr'];
            $data['VorIndividualD4'] = $header['genrCeos'];// GebäudeNr

            $data['VorNotiz'] = $header['txtZ012'];
            $data['VorArt'] = 'A';
            $data['VorUnterArt'] = 'R';  // char 1
            $data['VorGruppe'] = $vorGruppe;
            $data['VNkArt'] = '100000';
            $data['VorStatus'] = '100100'; //-- 100000 Nicht gedruckt / 100010 Angebot / 100100 Auftragsbestätigung

            $vorgang = new VorgangService();
            $vorgang = $vorgang->createVorgang($data);
            if ($vorgang === null) {
                //todo add Throw Error Here
                Log::error('sd_0101_beauftragung_vorgang creation Failed');
                return null;
            }

            //todo important delete all position if one fails also vorgang
            $positionsArray = [];
            foreach ($positions as $key => $position) {
                $artikelNummer = ltrim($position['matnr'], '0');
                $artikel = Artikel::where('Artikelnummer', $artikelNummer)->first();
                if ($artikel === null) {
                    Log::error(
                        "Material für Position nicht gefunden",
                        [
                            'Material' => $artikelNummer,
                            'Vorgangnummer' => $vorgang['VorNummer']
                        ]
                    );
                    return null;
                }

                $positionData['InterneVorgangsnummer'] = $vorgang['InterneVorgangsnummer'];
                $positionData['VorNummer'] = $vorgang['VorNummer'];
                $positionData['PosIndividualC1'] = $position['posnr'];
                $positionData['PosZusatztextLieferschein'] = $position['txtZ002'];
                $positionData['PosZusatztext'] = $position['txtZ009'];
                $positionData['PosNotiz'] = $position['txtZ010'];
                $positionData['PosMenge1'] = $position['kwmeng'];
                $positionData['PosKZMengeneinheit1'] = $position['vrkme'];
                $positionData['PosIndividualC5'] = $position['kwmeng'];
                $positionData['externMenge'] = $position['kwmeng'];
                $positionData['current_date'] = date('Ymd');
                $carbonMontagedatum = Carbon::parse((string)$position['montagedatum']);
                $montagedatum = $carbonMontagedatum->format('Ymd');
                $positionData['PosIndividualT3'] = $montagedatum;

                $preisbasis = Preisbasis::where('NRPreisbasis', $artikel->NRPreisbasis)->first();
                $positionData['NRPreisbasis'] = $artikel->NRPreisbasis;
                $positionData['PosPreisfaktor'] = $preisbasis->Preisfaktor;

                $positionData['PosNummer'] = $key + 1;
                $positionData['PosNummernText'] = $key + 1;
                $positions = new PositionService();
                $createdPosition = $positions->createPosition($positionData, $artikel);
                if ($createdPosition !== null) {
                    $positionsArray[] = $createdPosition;
                }
            }
            if (!empty($positionsArray)) {
                return [
                    'header' => [
                        'InterneVorgangsnummer' => $vorgang['InterneVorgangsnummer'],
                        'VorNummer' => $vorgang['VorNummer'],
                        'Verkaufsbeleg' => $header['vbeln'],
                    ],
                    'positions' => $positionsArray,
                ];
            }
            Log::error('sd_0101_beauftragung_positions Positions Creation Failed');
            return null;
        });

    }


}





