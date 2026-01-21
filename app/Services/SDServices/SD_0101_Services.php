<?php

namespace App\Services\SDServices;

use App\Exceptions\AdresseGesperrtException;
use App\Exceptions\CreationFailedException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Ceos_GEBAEUDE_TimeLine;
use App\Models\Ceos_LIEGENSCHAFT_TimeLine;
use App\Models\Preisbasis;
use App\Services\PositionService;
use App\Services\VorgangService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;


class SD_0101_Services
{
    protected string $baseUrl;
    protected string $sd0102_path;
    protected string $sd0301_path;
    protected array $vorgruppeMapping;
    protected array $vorgruppeSKTMapping;
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
        $this->vorgruppeSKTMapping = config('vorgruppeSKTMapping');
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
        return DB::transaction(function () use (&$requestData) {

            $header = $requestData['header'];
            $positions = $requestData['positions'];
            $data = [];
            // Adresse
            $this->prepareAdresse($header['kunnr'], $data);
            // VorGruppe
            $materialGruppe = substr($positions[0]['aufnr'], 0, 2);
            $vorGruppe = $this->getVorGruppe($header['augru'], $materialGruppe);
            // Header Daten
            $this->prepareHeaderData($header, $data, $vorGruppe);
            // Liegenschaft / Gebäude
            $this->prepareLiegenschaftData($header, $data);
            // Vorgang erstellen
            $vorgang = $this->createVorgang($data, $header);
            // Positionen erstellen
            $positionsArray = $this->preparePositions($positions, $vorgang);
            return [
                'header' => [
                    'InterneVorgangsnummer' => $vorgang['InterneVorgangsnummer'],
                    'VorNummer' => $vorgang['VorNummer'],
                    'Verkaufsbeleg' => $header['vbeln'],
                ],
                'positions' => $positionsArray,
            ];
        });
    }

    /* =========================
     * Helper Methods
     * ========================= */

    /**
     * @throws ResourceNotFoundException
     * @throws AdresseGesperrtException
     */
    protected function prepareAdresse(string $kunnr, array &$data): void
    {
        $adresse = Adresse::where('AdressNummer', $kunnr)->first();

        if ($adresse === null) {
            throw new ResourceNotFoundException('Ressource wurde nicht gefunden', ['AdressNummer' => $kunnr]);
        }

        if ($adresse->AdrLiefersperreJN == "1") {
            throw new AdresseGesperrtException($adresse->AdressNummer);
        }

        $interneNummer = $adresse->InterneAdressnummer;

        $data['VorAuftraggeber'] = $interneNummer;
        $data['VorLieferanschrift'] = $interneNummer;
        $data['VorRechnungsanschrift'] = $interneNummer;
        $data['VorSammelRechnungsanschrift'] = $interneNummer;
    }

    protected function getVorGruppe(string $augru, string $materialGruppe): string
    {
        return $this->vorgruppeMapping[$augru . $materialGruppe] ?? 'RE';
    }

    protected function prepareHeaderData(array $header, array &$data, string $vorGruppe): void
    {
        $data['VorLieferungWunschDatum'] = !empty($header['vdatu'])
            ? Carbon::parse($header['vdatu'])->format('Ymd')
            : null;

        $txtZ013 = $header['txtZ013']
            ? mb_substr($header['txtZ013'], 0, 40)
            : 'MONTAGEAUFTRAG';

        $data['VorStichwort'] = $txtZ013;
        $data['VorIndividualC1'] = $header['vbeln'];
        $data['VorIndividualC2'] = $header['auart'];
        $data['VorIndividualC3'] = $header['zzlgsnr'];
        $data['VorIndividualC7'] = $this->vorgruppeSKTMapping[$header['augru']];
        $data['VorIndividualD4'] = $header['genrCeos'];
        $data['VorNotiz'] = $header['txtZ012'];

        $data['VorArt'] = 'A';
        $data['VorUnterArt'] = 'R';
        $data['VorGruppe'] = $vorGruppe;
        $data['VNkArt'] = '100000';
        $data['VorStatus'] = '100100';
    }

    protected function prepareLiegenschaftData(array $header, array &$data): void
    {
        $liegenschaft = Ceos_LIEGENSCHAFT_TimeLine::where(
            'Liegenschaftsnummer',
            $header['zzlgsnr']
        )->first();

        if ($liegenschaft === null) {
            return;
        }

        $gebaeude = Ceos_GEBAEUDE_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
            ->where('GebaeudeNr', $header['genrCeos'])
            ->first();

        if ($gebaeude !== null) {
            $data['VorBetrefftextZeile1'] = $gebaeude->LG_Strasse;
            $data['VorBetrefftextZeile2'] = $gebaeude->LG_PLZ . ' ' . $gebaeude->LG_Ort;
        }
    }

    /**
     * @throws CreationFailedException
     */
    protected function createVorgang(array $data, array $header): array
    {
        $vorgangService = new VorgangService();
        $vorgang = $vorgangService->createVorgang($data);

        if ($vorgang === null) {
            throw new CreationFailedException('Vorgang Erstellung fehlgeschlagen', $header);
        }

        return $vorgang;
    }

    /**
     * @throws ResourceNotFoundException
     * @throws CreationFailedException
     */
    protected function preparePositions(array $positions, array $vorgang): array
    {
        $artikelIds = array_map(
            fn($p) => ltrim($p['matnr'], '0'),
            $positions
        );

        $artikelCollection = Artikel::whereIn('Artikelnummer', $artikelIds)
            ->get()
            ->keyBy('Artikelnummer');

        $preisbasisCollection = Preisbasis::whereIn(
            'NRPreisbasis',
            $artikelCollection->pluck('NRPreisbasis')
        )
            ->get()
            ->keyBy('NRPreisbasis');

        $positionsArray = [];

        foreach ($positions as $key => $position) {

            $artikelNummer = ltrim($position['matnr'], '0');
            $artikel = $artikelCollection[$artikelNummer] ?? null;

            if ($artikel === null) {
                throw new ResourceNotFoundException(
                    'Material für Position nicht gefunden',
                    ['Material' => $artikelNummer, 'Vorgangnummer' => $vorgang['VorNummer']]
                );
            }

            $preisbasis = $preisbasisCollection[$artikel->NRPreisbasis] ?? null;

            if ($preisbasis === null) {
                throw new ResourceNotFoundException(
                    'Preisbasis für Artikel nicht gefunden',
                    ['Material' => $artikelNummer, 'NRPreisbasis' => $artikel->NRPreisbasis]
                );
            }

            $montagedatum = !empty($position['montagedatum'])
                ? Carbon::parse($position['montagedatum'])->format('Ymd')
                : null;

            $positionData = [
                'InterneVorgangsnummer' => $vorgang['InterneVorgangsnummer'],
                'VorNummer' => $vorgang['VorNummer'],
                'PosIndividualC1' => $position['posnr'],
                'PosZusatztextLieferschein' => $position['txtZ002'],
                'PosZusatztext' => $position['txtZ009'],
                'PosNotiz' => $position['txtZ010'],
                'PosMenge1' => $position['kwmeng'],
                'PosKZMengeneinheit1' => $position['vrkme'],
                'PosIndividualC5' => $position['kwmeng'],
                'externMenge' => $position['kwmeng'],
                'current_date' => date('Ymd'),
                'PosIndividualT3' => $montagedatum,
                'NRPreisbasis' => $artikel->NRPreisbasis,
                'PosPreisfaktor' => $preisbasis->Preisfaktor,
                'PosNummer' => $key + 1,
                'PosNummernText' => $key + 1,
            ];

            $positionService = new PositionService();
            $createdPosition = $positionService->createPosition($positionData, $artikel);

            if ($createdPosition === null) {
                throw new CreationFailedException(
                    'Position Erstellung fehlgeschlagen',
                    $positionData
                );
            }

            $positionsArray[] = $createdPosition;
        }

        if (empty($positionsArray)) {
            throw new CreationFailedException('Positionen Erstellung fehlgeschlagen');
        }

        return $positionsArray;
    }
}
