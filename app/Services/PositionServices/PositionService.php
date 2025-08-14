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
            $position->FibuKontoGruppeID = $data['FibuKontoGruppeID'] ?? NULL;

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


    public function createPositionMaster($data): ?Position
    {
        try {
            $position = new Position();
            $position->InterneVorgangsnummer = $data['InterneVorgangsnummer'];
            $position->PosVorgaenger = $data['PosVorgaenger'] ?? 0;
            $position->PosHaupt = $data['PosHaupt'] ?? 0;
            $position->PosEbene = $data['PosEbene'] ?? 0;
            $position->PosNummer = $data['PosNummer'];
            $position->PosNummernText = $data['PosNummernText'];

            $position->InterneArtikelnummer = $data['InterneArtikelnummer'] ?? NULL;
            $position->KZArtikelgruppe = $data['KZArtikelgruppe'];
            $position->KZWarengruppe = $data['KZWarengruppe'];
            $position->ArtikelUntergruppeID = $data['ArtikelUntergruppeID'] ?? NULL;
            $position->KZProduktgruppe = $data['KZProduktgruppe'] ?? NULL;
            $position->PosBezeichnung1 = $data['PosBezeichnung1'];
            $position->KZKalkulationGruppe = $data['KZKalkulationGruppe'] ?? NULL;
            $position->FibuKontoGruppeID = $data['FibuKontoGruppeID'] ?? NULL;
            $position->FKtoNummer = $data['FKtoNummer'] ?? NULL;


            $position->PosNeueSeite = $data['PosNeueSeite'] ?? 0;
            $position->PosTyp = $data['PosTyp'] ?? NULL;
            $position->PosSeriennummernfaehigJN = $data['PosSeriennummernfaehigJN'] ?? 0;
            $position->PosChargenfaehigJN = $data['PosChargenfaehigJN'] ?? 1;
            $position->PosAutoAbbuchenJN = $data['PosAutoAbbuchenJN'] ?? 0;
            $position->PosAutoZubuchenJN = $data['PosAutoZubuchenJN'] ?? 0;
            $position->LagerGruppe = $data['LagerGruppe'] ?? NULL;
            $position->Lagerortnummer = $data['Lagerortnummer'] ?? NULL;
            $position->MagazinID = $data['MagazinID'] ?? NULL;
            $position->PosUeberschrift = $data['PosUeberschrift'] ?? NULL;

            $position->PosGebuchtJN = $data['PosGebuchtJN'] ?? 0;
            $position->PosErledigtJN = $data['PosErledigtJN'] ?? 0;
            $position->PosLagerbuchungJN = $data['PosLagerbuchungJN'] ?? 1;
            $position->PosFremdfertigungJN = $data['PosFremdfertigungJN'] ?? 0;
            $position->PosLieferantenfaehigJN = $data['PosLieferantenfaehigJN'] ?? 0;
            $position->PosFertigungsfaehigJN = $data['PosFertigungsfaehigJN'] ?? 0;
            $position->PosUrsprungsnachweisJN = $data['PosUrsprungsnachweisJN'] ?? 0;
            $position->PosEKInNachkalkulationJN = $data['PosEKInNachkalkulationJN'] ?? 0;

            $position->PosKZMengeneinheit1Ansicht = $data['PosKZMengeneinheit1Ansicht'] ?? NULL;
            $position->PosFaktorAnsicht = $data['PosFaktorAnsicht'] ?? NULL;
            $position->PosAnlageAm = $data['PosAnlageAm'] ?? date('Ymd');
            $position->PosAnlageDurch = $data['PosAnlageDurch'] ?? NULL;
            $position->PosLetzteAenderungAm = $data['PosLetzteAenderungAm'] ?? NULL;
            $position->PosLetzteAenderungDurch = $data['PosLetzteAenderungDurch'] ?? NULL;
            $position->KZKalkulationGruppe = $data['KZKalkulationGruppe'] ?? NULL;

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





