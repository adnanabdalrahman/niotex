<?php

namespace App\Services;

use App\Models\Artikel;
use App\Models\Preisbasis;
use App\Services\PositionServices\Position1WertService;
use App\Services\PositionServices\Position2TextService;
use App\Services\PositionServices\Position3MengeService;
use App\Services\PositionServices\Position4LieferungService;
use App\Services\PositionServices\Position5IndividualService;
use App\Services\PositionServices\Position6StuecklisteService;
use App\Services\PositionServices\Position7ZusatzService;
use App\Services\PositionServices\PositionService as PositionServiceTable;
use App\Services\PositionServices\PositionWertService;
use Illuminate\Support\Facades\Log;
use Throwable;

class PositionService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');
    }

    public function createPosition($data, Artikel $artikel): ?array
    {
        try {
            //todo check and delete
            $data['PosNummer'] = $data['key'] + 1;
            $data['PosNummernText'] = $data['key'] + 1;
            $positionService = new PositionServiceTable();
            $position = $positionService->createPosition($data, $artikel);
            $internePositionsnummer = $position->InternePositionsnummer;

            $position2Text = new Position2TextService($internePositionsnummer);
            $position2Text->savePosition2Text($data, $artikel);

            $position3Menge = new Position3MengeService($internePositionsnummer);
            $position3Menge->savePosition3Menge($data);

            $position4Lieferung = new Position4LieferungService($internePositionsnummer);
            $position4Lieferung->savePosition4Lieferung($data);

            $position5Individual = new Position5IndividualService($internePositionsnummer);
            $position5Individual->savePosition5Individual($data);

            $position6Stueckliste = new Position6StuecklisteService($internePositionsnummer);
            $position6Stueckliste->savePosition6Stueckliste($data);

            $position7Zusatz = new Position7ZusatzService($internePositionsnummer);
            $position7Zusatz->savePosition7Zusatz($data);

            $preisbasis = Preisbasis::where('NRPreisbasis', $artikel->NRPreisbasis)->first();

            /* Position1Wert */
            //todo check and delete
            $data['NRPreisbasis'] = $artikel->NRPreisbasis;
            $data['PosPreisfaktor'] = $preisbasis->Preisfaktor;
            $position1Wert = new Position1WertService($internePositionsnummer);
            $position1Wert->savePosition1Wert($data);

            /* PositionWert */
            $positionWert = new PositionWertService($internePositionsnummer);
            $positionWert->savePositionWert($data);

            $positionsResultArray = [
                'InternePositionsnummer' => $internePositionsnummer,
                'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                'posnr' => $data['PosIndividualD1'],
            ];
        } catch (Throwable $e) {
            Log::error('Create Position' . $e->getMessage());
            return null;
        }
        return $positionsResultArray;
    }

}
