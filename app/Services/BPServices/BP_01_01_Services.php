<?php

namespace App\Services\BPServices;

use App\Exceptions\DBSaveException;
use App\Models\Adresse;
use App\Models\AdresseBranche;
use Throwable;

class BP_01_01_Services
{
    /**
     * SAP → Ceos
     * BP-01-01 Geschäftspartner (Adresse)
     *
     * @param array $data
     * @return array
     *
     * @throws DBSaveException
     */
    public function bp_0101_geschaeftspartner(array $data): array
    {
        $data['Loeschvormerkung'] = $this->toBool($data['Loeschvormerkung'] ?? 0);
        $data['AutoWEAbr'] = $this->toBool($data['AutoWEAbr'] ?? 0);
        $data['Sperrkennzeichen'] = $this->toBool($data['Sperrkennzeichen'] ?? 0);

        // If "gesperrt", also mark as "gelöscht"
        if ($data['Sperrkennzeichen']) {
            $data['Loeschvormerkung'] = 1;
        }

        $data['Suchbegriff1'] = $this->truncate($data['Suchbegriff1'] ?? '', 10);
        $data['Anrede'] = $data['Anrede'] ?: 5; // default to "Firma" / 5
        $kundengruppe1 = ($data['Adresstyp'] === 'KUN') ? ($data['Kundengruppe1'] ?? null) : null;

        try {
            $adresse = Adresse::updateOrCreate(
                ['AdressNummer' => $data['DebitorenKreditorennummer']],
                $this->mapAdresseData($data, $kundengruppe1)
            );
        } catch (Throwable $exception) {
            throw new DBSaveException('Fehler beim Speichern oder Aktualisieren des Geschäftspartners', [
                'database' => $exception->getMessage(),
            ]);
        }

        $interneAdressnummer = $adresse['InterneAdressnummer'] ?? null;

        // Only create/update AdresseBranche for Kunden
        if ($data['Adresstyp'] === 'KUN' && $interneAdressnummer && !empty($data['Kundengruppe'])) {
            $this->saveAdresseBranche($interneAdressnummer, $data['Kundengruppe']);
        }

        return [
            'interneArtikelnummer' => $interneAdressnummer,
            'Adresse' => $data['DebitorenKreditorennummer'],
        ];
    }


    private function toBool($value): int
    {
        return (!empty($value) && $value != "0") ? 1 : 0;
    }


    private function truncate(?string $value, int $length): string
    {
        return mb_substr($value ?? '', 0, $length);
    }


    private function mapAdresseData(array $data, ?string $kundengruppe1): array
    {
        return [
            'AdrFremdnummer' => $data['Geschaeftspartnernummer'],
            'AdressNummer' => $data['DebitorenKreditorennummer'],
            'KZWaehrung' => "EUR",
            'KZAdresstyp' => $data['Adresstyp'],
            'MwstTypID' => 3,
            'AdrKarenztage' => 0,
            'KZSprache' => "DE",
            'AdrFactoringJN' => 0,
            'AdrMahnSperreJN' => 0,
            'NRAnrede' => $data['Anrede'],
            'NRTitel' => $data['Titel'] ?? null,
            'AdrFirmenbezeichnung1' => $this->truncate($data['Name1'] ?? '', 40),
            'AdrFirmenbezeichnung2' => $this->truncate($data['Name2'] ?? '', 40),
            'AdrFirmenbezeichnung3' => $this->truncate($data['Name3'] ?? '', 40),
            'AdrMatchcode' => $data['Suchbegriff1'],
            'AdrStrasse' => $this->truncate($data['Strasse'] ?? '', 39),
            'AdrStrasse2' => mb_substr($data['Strasse'] ?? '', 39),
            'AdrPLZ' => $data['Postleitzahl'] ?? null,
            'AdrOrt' => $data['Ort'] ?? null,
            'KZLand' => $data['Land'] ?? null,
            'AdrPostfach' => $data['Postfach'] ?? null,
            'AdrPLZPostfach' => $data['PostleitzahlPostfach'] ?? null,
            'AdrOrtPostfach' => $data['OrtPostfach'] ?? null,
            'AdrTelefon' => $data['Telefon'] ?? null,
            'AdrMobiltelefon' => $data['Mobiltelefon'] ?? null,
            'AdrFax' => $data['Fax'] ?? null,
            'AdrEmail' => $data['EMail'] ?? null,
            'AdrGutschriftsverfahrenJN' => $data['AutoWEAbr'],
            'AdrLiefersperreJN' => $data['Sperrkennzeichen'],
            'KZAdressgruppe' => $kundengruppe1,
            'AdrAltJN' => $data['Loeschvormerkung'],
            //'ADRindividualC1'     => $data['Suchbegriff2'],
            'ADRindividualC2' => $data['UVIMailadresse'] ?? null,
            'ADRindividualC3' => $data['PDFMailadresse'] ?? null,
        ];
    }

    /**
     * @throws DBSaveException
     */
    private function saveAdresseBranche(string $interneAdressnummer, string $kundengruppe): void
    {
        try {
            AdresseBranche::updateOrCreate(
                ['InterneAdressnummer' => $interneAdressnummer],
                [
                    'KZBranche' => $kundengruppe,
                    'AbrHauptJN' => 1,
                ]
            );
        } catch (Throwable $exception) {
            throw new DBSaveException('Fehler beim Speichern oder Aktualisieren des AdresseBranche', [
                'database' => $exception->getMessage(),
            ]);
        }
    }
}
