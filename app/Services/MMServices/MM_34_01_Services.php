<?php

namespace App\Services\MMServices;

use App\Models\Artikel;
use App\Models\Position;
use App\Models\Position3Menge;
use App\Models\Vorgang;
use App\Services\SapApiClient;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class MM_34_01_Services
{
    protected string $mm341_path;

    public function __construct()
    {
        $this->mm341_path = config('sap.mm341_path');
    }


    /**
     * MM-34-1 Umlagerungsreservierung
     * CEOSWEB-->CEOSAPI-->SAP
     * @throws Exception
     */

    public function mm_34_01_umlagerungsreservierung($requestData): ?array
    {
        $vorgang = Vorgang::where('VorNummer', $requestData['Vorgangnummer'])
            ->where('VorGruppe', $requestData['VorGruppe']) //M_LG
            ->first();

        if ($vorgang === null) {
            Log::error(
                'mm_34_01_umlagerungsreservierung Kein Vorgang vorhanden',
                ['Vorgangnummer' => $requestData['Vorgangnummer']]
            );
            return null;
        }

        $milliseconds = Carbon::parse($requestData['tourDate'])->timestamp * 1000;
        $tourDate = "/Date({$milliseconds})/";

        $positions = Position::where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)->get();

        $to_Items = [];
        foreach ($positions as $position) {
            if ($position->InterneArtikelnummer === null) {
                Log::error(
                    'mm_34_01_umlagerungsreservierung Kein InterneArtikelnummer in Position gefunden',
                    [
                        'InterneVorgangsnummer' => $requestData['Vorgangnummer'],
                        'Position' => $position->InternePositionsnummer
                    ]
                );
                return null;
            }
            $artikel = Artikel::find($position->InterneArtikelnummer);

            if ($artikel === null) {
                Log::error(
                    'mm_34_01_umlagerungsreservierung Kein Artikel für Position gefunden',
                    [
                        'InterneVorgangsnummer' => $requestData['Vorgangnummer'],
                        'Position' => $position->InternePositionsnummer,
                        'InterneArtikelnummer' => $position->InterneArtikelnummer
                    ]
                );
                return null;
            }

            $position3Menge = Position3Menge::where('InternePositionsnummer', $position->InternePositionsnummer)
                ->where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)
                ->first();
            $to_Items[] = [
                'Material' => $artikel->Artikelnummer,
                "EntryQnt" => (string)(int)$position3Menge->PosMenge1,
                "EntryUom" => 'ST',
                "ReqDate" => $tourDate,
            ];
        }

        $requestData = [
            "TourId" => (string)$requestData['tourId'],
            "Remark" => "Test Remark", //todo later from Florian MAX 50 also in Florian page Max 50
            "MoveStloc" => "",
            "MoveStlocSearch" => "",
            "to_Items" => $to_Items
        ];
        Log::info("mm_34_01_umlagerungsreservierung sent Data", $requestData);
        $response = app(SapApiClient::class)->post($this->mm341_path, $requestData);
        if ($response === null) {
            Log::error('mm_22_01_lagerbestaende Error Response');
            return null;
        }
        Log::info("mm_34_01_umlagerungsreservierung received Data", $response);

        if (isset($response['d'])) {
            $reservNo = $response['d']['ReservNo'] ?? null;

            $lager = $response['d']['MoveStloc'] ?? null;
            if ($reservNo !== null) {
                $reservNo = ltrim($reservNo, '0');
                $vorgang->VorStatus = 100220;
                $vorgang->VorIndividualD6 = (int)$reservNo;
                $vorgang->save();
                return [
                    'reservNo' => $reservNo,
                    'lager' => $lager
                ];
            }
        }
        return null;
    }


}
