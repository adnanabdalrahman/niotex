<?php

namespace App\Services\PositionServices;

use App\Models\Artikel;
use App\Models\Position;

class PositionService
{
    protected mixed $internePositionsnummer;

    public function __construct($internePositionsnummer = null)
    {
        $this->internePositionsnummer = $internePositionsnummer;
    }


    public function createPosition($data, Artikel $artikel): Position
    {
        return Position::create([
            'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
            'PosVorgaenger' => $data['PosVorgaenger'] ?? 0,
            'PosHaupt' => $data['PosHaupt'] ?? 0,
            'PosEbene' => $data['PosEbene'] ?? 0,
            'PosNummer' => $data['PosNummer'],
            'PosNummernText' => $data['PosNummernText'],
            'InterneArtikelnummer' => $artikel->InterneArtikelnummer,
            'KZArtikelgruppe' => $artikel->KZArtikelgruppe,
            'KZWarengruppe' => $artikel->KZWarengruppe,
            'ArtikelUntergruppeID' => $artikel->ArtikelUntergruppeID,
            'KZProduktgruppe' => $artikel->KZProduktgruppe,
            'PosBezeichnung1' => $artikel->ArtBezeichnung1,
            'KZKalkulationGruppe' => $artikel->KZKalkulationGruppe,
            'FibuKontoGruppeID' => $data['FibuKontoGruppeID'] ?? null,
            'PosNeueSeite' => $data['PosNeueSeite'] ?? 0,
            'PosTyp' => $data['PosTyp'] ?? null,
            'PosSeriennummernfaehigJN' => $data['PosSeriennummernfaehigJN'] ?? 1,
            'PosChargenfaehigJN' => $data['PosChargenfaehigJN'] ?? 1,
            'PosAutoAbbuchenJN' => $data['PosAutoAbbuchenJN'] ?? 0,
            'PosAutoZubuchenJN' => $data['PosAutoZubuchenJN'] ?? 0,
            'PosGebuchtJN' => $data['PosGebuchtJN'] ?? 0,
            'PosErledigtJN' => $data['PosErledigtJN'] ?? 0,
            'PosLagerbuchungJN' => $data['PosLagerbuchungJN'] ?? 1,
            'PosFremdfertigungJN' => $data['PosFremdfertigungJN'] ?? 0,
            'PosLieferantenfaehigJN' => $data['PosLieferantenfaehigJN'] ?? 0,
            'PosFertigungsfaehigJN' => $data['PosFertigungsfaehigJN'] ?? 0,
            'PosUrsprungsnachweisJN' => $data['PosUrsprungsnachweisJN'] ?? 0,
            'PosEKInNachkalkulationJN' => $data['PosEKInNachkalkulationJN'] ?? 0,
            'PosAnlageAm' => $data['PosAnlageAm'] ?? now()->format('Ymd'),
        ]);

    }
}





