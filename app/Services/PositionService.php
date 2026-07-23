<?php

namespace App\Services;

use App\Models\Artikel;
use App\Services\PositionServices\Position1WertService;
use App\Services\PositionServices\Position2TextService;
use App\Services\PositionServices\Position3MengeService;
use App\Services\PositionServices\Position4LieferungService;
use App\Services\PositionServices\Position5IndividualService;
use App\Services\PositionServices\Position6StuecklisteService;
use App\Services\PositionServices\Position7ZusatzService;
use App\Services\PositionServices\PositionService as PositionServiceTable;
use App\Services\PositionServices\PositionWertService;

class PositionService
{
    public function __construct(
        protected PositionServiceTable        $positionServiceTable,
        protected Position2TextService        $position2TextService,
        protected Position3MengeService       $position3MengeService,
        protected Position4LieferungService   $position4LieferungService,
        protected Position5IndividualService  $position5IndividualService,
        protected Position6StuecklisteService $position6StuecklisteService,
        protected Position7ZusatzService      $position7ZusatzService,
        protected Position1WertService        $position1WertService,
        protected PositionWertService         $positionWertService,
    )
    {
    }

    public function createPosition(array $data, Artikel $artikel): array
    {
        $position = $this->positionServiceTable
            ->createPosition($data, $artikel);

        $internePositionsnummer = $position->InternePositionsnummer;

        $this->position2TextService
            ->savePosition2Text(
                $data,
                $artikel,
                $internePositionsnummer
            );

        $this->position3MengeService
            ->savePosition3Menge(
                $data,
                $internePositionsnummer
            );

        $this->position4LieferungService
            ->savePosition4Lieferung(
                $data,
                $internePositionsnummer
            );

        $this->position5IndividualService
            ->savePosition5Individual(
                $data,
                $internePositionsnummer
            );

        $this->position6StuecklisteService
            ->savePosition6Stueckliste(
                $data,
                $internePositionsnummer
            );

        $this->position7ZusatzService
            ->savePosition7Zusatz(
                $data,
                $internePositionsnummer
            );

        $this->position1WertService
            ->savePosition1Wert(
                $data,
                $internePositionsnummer
            );

        $this->positionWertService
            ->savePositionWert(
                $data,
                $internePositionsnummer
            );

        return [
            'InternePositionsnummer' => $internePositionsnummer,
            'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
            'vorgn' => $data['VorNummer'],
            'posnr' => $data['PosIndividualC1'],
        ];
    }
}
