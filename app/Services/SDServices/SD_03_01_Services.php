<?php

namespace App\Services\SDServices;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Ceos_DTA_Eigenschaften;
use App\Models\Position;
use App\Models\Position3Menge;
use App\Models\Vorgang;
use App\Services\SapApiClient;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class SD_03_01_Services
{
    protected string $sd0301_path;
    protected string $baseUrl;
    protected array $mwstSatzProzentArray;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');

        $this->sd0301_path = config('sap.sd0301_path');
        $this->mwstSatzProzentArray = [
            7 => 2,
            19 => 3,
            0 => 4,
        ];
    }

    /**
     * CEOSWeb -> CEOS --> SAP
     * SD-03-01 Dienstleistungsrechnung
     * @throws ResourceNotFoundException
     * @throws Exception
     */
    public function sd_0301_dienstleistungsrechnung($request): ?array
    {
        $data = [];
        $vorgang = Vorgang::where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->first();
        if ($vorgang === null) {
            throw new ResourceNotFoundException('Vorgang wurde nicht gefunden',
                ['InterneVorgangsnummer' => $request->InterneVorgangsnummer]);
        }
        $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
        if ($adresse === null) {
            throw new ResourceNotFoundException('AdressNummer wurde nicht gefunden',
                [
                    'InterneVorgangsnummer' => $request->InterneVorgangsnummer,
                    'AdressNummer' => $vorgang->VorAuftraggeber
                ]
            );
        }

        $carbonAbrVon = Carbon::parse((string)$vorgang->VorIndividualT1);
        $carbonAbrBis = Carbon::parse((string)$vorgang->VorIndividualT2);

        $abrechnungseinheit = Ceos_DTA_Eigenschaften::query()
            ->where('DatumVon', $carbonAbrVon->format('Ymd'))
            ->where('DatumBis', $carbonAbrBis->format('Ymd'))
            ->where('EigenschaftTyp', 1)
            ->where('LiegenschaftsNummer', (string)$vorgang->VorIndividualC3)
            ->first();

        $data['Kunnr'] = $adresse->AdressNummer;
        $data['Auart'] = (string)$vorgang->VorIndividualC2;
        $data['Zzlgsnr'] = (string)$vorgang->VorIndividualC3;
        $data['Vorgn'] = (string)$vorgang->VorNummer;
        $data['VorgnInt'] = (string)$vorgang->InterneVorgangsnummer;
        $data['AbrVon'] = $carbonAbrVon->format('Ymd');
        $data['AbrBis'] = $carbonAbrBis->format('Ymd');
        $data['Zzbukrs'] = '1450';
        $data['Zzswenr'] = substr((string)$vorgang->VorIndividualC3, 2, 6);
        $data['Zzsnksl'] = '3040';
        $data['Zzsempsl'] = (string)$abrechnungseinheit?->EigenschaftWert;
        //---------------------------------------------------------------------------------------------
        $positions = Position::where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->get();
        foreach ($positions as $position) {
            $artikel = Artikel::where('InterneArtikelnummer', $position->InterneArtikelnummer)->first();
            if (is_null($artikel)) {
                throw new ResourceNotFoundException('Artikel für Position wurde nicht gefunden',
                    [
                        'Vorgangnummer' => $request->InterneVorgangsnummer,
                        'InterneArtikelnummer' => $position->InterneArtikelnummer,
                        'InternePositionsnummer' => $position->InternePositionsnummer,
                    ]
                );
            }
            $position3Menge = Position3Menge::where
            ('InternePositionsnummer', $position->InternePositionsnummer)->first();
            if (is_null($position3Menge)) {
                throw new ResourceNotFoundException('Position3Menge wurde nicht gefunden',
                    [
                        'Vorgangnummer' => $request->InterneVorgangsnummer,
                        'InterneArtikelnummer' => $position->InterneArtikelnummer,
                        'InternePositionsnummer' => $position->InternePositionsnummer,
                    ]
                );
            }

            if ($position3Menge->PosKZMengeneinheit1 == "Stck") {
                $vrkme = "ST";
            } else {
                $vrkme = $position3Menge->PosKZMengeneinheit1;
            }
            $data['to_ServItems'][] = [
                'Matnr' => $artikel->Artikelnummer,
                'Kwmeng' => (string)$position3Menge->PosMenge1,
                'Vrkme' => (string)$vrkme,
                'Vorgn' => (string)$vorgang->VorNummer,
                'VorgnInt' => (string)$vorgang->InterneVorgangsnummer,
            ];
        }
        Log::info('sd-03-01 Sent data', $data);
        $result = app(SapApiClient::class)->post($this->sd0301_path, $data);
        if ($result === null ||
            !isset($result['d']['Status']) ||
            $result['d']['Status'] === "error") {
            Log::error('sd-03-01 Error received', $result);
            return null;
        }

        Log::info('sd-03-01 received data: ', $result);
        return $result;
    }
}





