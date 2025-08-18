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

    protected array $vorGruppe;

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
        $this->vorGruppe = config('vorgruppe');
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
    public function sd_0101_beauftragung_vorgang($requestData): ?array
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
            $adresse = Adresse::where('AdressNummer', $requestData['kunnr'])->first();
            if ($adresse !== null) {
                if ($adresse->AdrLiefersperreJN == "1") {
                    throw new AdresseGesperrtException($adresse->AdressNummer);
                }
                $data['VorAuftraggeber'] = $adresse->InterneAdressnummer; // Kunnr
                $data['VorLieferanschrift'] = $adresse->InterneAdressnummer;
                $data['VorRechnungsanschrift'] = $adresse->InterneAdressnummer;
                $data['VorSammelRechnungsanschrift'] = $adresse->InterneAdressnummer;
            } else {
                throw new AdresseNotFoundException($requestData['vbeln'], $requestData['kunnr']);
            }

            //vdatu
            $data['VorLieferungWunschDatum'] = Carbon::parse($requestData['vdatu'])->format('Ymd');
            $data['VorStichwort'] = $requestData['txtZ013'] ?? 'MONTAGEAUFTRAG';
            $data['VorIndividualC1'] = $requestData['vbeln'];
            $data['VorIndividualC2'] = $requestData['auart'];
            $data['VorIndividualC3'] = $requestData['zzlgsnr'];
            $data['VorIndividualD4'] = $requestData['genrCeos'];// GebäudeNr

            $data['VorNotiz'] = $requestData['txtZ012'];
            $data['VorArt'] = 'A';
            $data['VorUnterArt'] = 'R';  // char 1
            $data['VorGruppe'] = $this->vorGruppe[$requestData['augru']]; //  -- Montage/Liefer/Rechnung: 'RE' / Vertr ge: 'WIE' ? / Rahmenauftr ge: 'AB'
            $data['VNkArt'] = '100000';
            $data['VorStatus'] = '100100'; //-- 100000 Nicht gedruckt / 100010 Angebot / 100100 Auftragsbestätigung

            $vorgang = new VorgangService();
            $vorgang = $vorgang->createVorgang($data);
            if ($vorgang !== null) {
                return [
                    'InterneVorgangsnummer' => $vorgang['InterneVorgangsnummer'],
                    'VorNummer' => $vorgang['VorNummer'],
                    'Verkaufsbeleg' => $requestData['vbeln'],
                ];
            }
            Log::error('sd_0101_beauftragung_vorgang creation Failed');
            return null;
        });

    }

    public function sd_0101_beauftragung_positions($positions, $vorgangDataArray): ?array
    {
        //todo important delete all position if one fails also vorgang
        $vorgangsnummer = $vorgangDataArray['VorNummer'];

        $positionsArray = [];
        foreach ($positions as $key => $position) {
            $artikelNummer = ltrim($position['matnr'], '0');
            $artikel = Artikel::where('Artikelnummer', $artikelNummer)->first();
            if ($artikel === null) {
                Log::error(
                    "Material für Position nicht gefunden",
                    [
                        'Material' => $artikelNummer,
                        'Vorgangnummer' => $vorgangsnummer
                    ]
                );
                return null;
            }

            $positionData['InterneVorgangsnummer'] = $vorgangDataArray['InterneVorgangsnummer'];
            $positionData['VorNummer'] = $vorgangDataArray['VorNummer'];
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
            return $positionsArray;
        }
        Log::error('sd_0101_beauftragung_positions Positions Creation Failed');
        return null;
    }
}





