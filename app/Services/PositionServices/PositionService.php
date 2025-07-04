<?php

namespace App\Services\PositionServices;

use App\Models\Artikel;
use App\Models\Position;
use Illuminate\Support\Facades\Log;

class PositionService
{
    protected mixed $internePositionsnummer;

    public function __construct($internePositionsnummer = null)
    {
        $this->internePositionsnummer = $internePositionsnummer;
    }

    public function createPosition($data, Artikel $artikel): ?Position
    {

        try {
            $position = new Position();
            $position->InterneVorgangsnummer = $data['InterneVorgangsnummer'];
            $position->PosVorgaenger = $data['PosVorgaenger'] ?? 0;
            $position->PosHaupt = $data['PosHaupt'] ?? 0;
            $position->PosEbene = $data['PosEbene'] ?? 0;
            $position->PosNummer = $data['PosNummer'];
            $position->PosNummernText = $data['PosNummernText'];
            $position->InterneArtikelnummer = $artikel->InterneArtikelnummer;
            $position->KZArtikelgruppe = $artikel->KZArtikelgruppe;
            $position->KZWarengruppe = $artikel->KZWarengruppe;
            $position->ArtikelUntergruppeID = $artikel->ArtikelUntergruppeID;
            $position->KZProduktgruppe = $artikel->KZProduktgruppe;
            $position->PosBezeichnung1 = $artikel->ArtBezeichnung1;
            $position->KZKalkulationGruppe = $artikel->KZKalkulationGruppe;

            $position->PosNeueSeite = $data['PosNeueSeite'] ?? 0;
            $position->PosTyp = $data['PosTyp'] ?? null;
            $position->PosSeriennummernfaehigJN = $data['PosSeriennummernfaehigJN'] ?? 1;
            $position->PosChargenfaehigJN = $data['PosChargenfaehigJN'] ?? 1;
            $position->PosAutoAbbuchenJN = $data['PosAutoAbbuchenJN'] ?? 0;
            $position->PosAutoZubuchenJN = $data['PosAutoZubuchenJN'] ?? 0;
            $position->PosGebuchtJN = $data['PosGebuchtJN'] ?? 0;
            $position->PosErledigtJN = $data['PosErledigtJN'] ?? 0;
            $position->PosLagerbuchungJN = $data['PosLagerbuchungJN'] ?? 1;
            $position->PosFremdfertigungJN = $data['PosFremdfertigungJN'] ?? 0;
            $position->PosLieferantenfaehigJN = $data['PosLieferantenfaehigJN'] ?? 0;
            $position->PosFertigungsfaehigJN = $data['PosFertigungsfaehigJN'] ?? 0;
            $position->PosUrsprungsnachweisJN = $data['PosUrsprungsnachweisJN'] ?? 0;
            $position->PosEKInNachkalkulationJN = $data['PosEKInNachkalkulationJN'] ?? 0;
            $position->PosAnlageAm = $data['PosAnlageAm'] ?? date('Ymd');

            $position->save();
            return Position::where('InternePositionsnummer', $position->InternePositionsnummer)->first();

        } catch (\Throwable $e) {
            Log::error('Failed to save Position', [
                'error' => $e->getMessage(),
                'internePositionsnummer' => $this->internePositionsnummer,
            ]);
            return null;
        }
    }

}





