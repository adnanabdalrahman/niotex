<?php

namespace App\Services\MMServices;

use App\Exceptions\DBSaveException;
use App\Exceptions\InvalidSapResponseException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Artikel;
use App\Models\Position;
use App\Models\Position3Menge;
use App\Models\Vorgang;
use App\Services\SapApiClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;

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
     * @throws DBSaveException
     * @throws InvalidSapResponseException
     * @throws ResourceNotFoundException
     * @throws Throwable
     */

    public function mm_34_01_umlagerungsreservierung($requestData): array
    {
        $vorgang = Vorgang::where('VorNummer', $requestData['Vorgangnummer'])
            ->where('VorGruppe', $requestData['VorGruppe']) //M_LG
            ->first();

        if ($vorgang === null) {
            throw new ResourceNotFoundException('Kein Vorgang gefunden.',
                ['Vorgangnummer' => $requestData['Vorgangnummer']]
            );
        }

        $milliseconds = Carbon::parse($requestData['tourDate'])->timestamp * 1000;
        $tourDate = "/Date({$milliseconds})/";

        $positions = Position::where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)->get();

        $to_Items = [];
        /** @var Position $position */
        foreach ($positions as $position) {
            if ($position->InterneArtikelnummer === null) {
                throw new ResourceNotFoundException(
                    'Keine InterneArtikelnummer für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                    ]
                );
            }
            $artikel = Artikel::find($position->InterneArtikelnummer);

            if ($artikel === null) {
                throw new ResourceNotFoundException(
                    'Kein Artikel für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                        'InterneArtikelnummer' => $position->InterneArtikelnummer,
                    ]
                );
            }

            $position3Menge = Position3Menge::where('InternePositionsnummer', $position->InternePositionsnummer)
                ->where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)
                ->first();
            if ($position3Menge === null) {
                throw new ResourceNotFoundException(
                    'Keine Mengenangabe für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                    ]
                );
            }
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
        Log::info("mm_34_01_umlagerungsreservierung received Data", $response);

        if (
            !isset($response['d']) ||
            !isset($response['d']['ReservNo']) ||
            !isset($response['d']['MoveStloc']
            )
        ) {
            throw new InvalidSapResponseException('Ungültige SAP-Antwort.');
        }
        $reservNo = $response['d']['ReservNo'];
        $lager = $response['d']['MoveStloc'];
        $reservNo = ltrim($reservNo, '0');
        try {
            $vorgang->VorStatus = 100220;
            $vorgang->VorIndividualC4 = $reservNo;
            $vorgang->save();
        } catch (Throwable $e) {
            throw new DBSaveException(
                'Fehler beim Speichern des Vorgangs: ' . $e->getMessage()
            );
        }
        return [
            'reservNo' => $reservNo,
            'lager' => $lager
        ];
    }
}
