<?php

namespace App\Services\BPServices;

use App\Exceptions\DBSaveException;
use App\Models\Adresse;
use App\Models\AdresseBranche;
use Throwable;

class BP_01_01_Services
{
    /**
     * @throws DBSaveException
     */
    public function bp_0101_geschaeftspartner(array $data): array
    {
        $data['Loeschvormerkung'] = $this->toBool($data['Loeschvormerkung']);
        $data['AutoWEAbr'] = $this->toBool($data['AutoWEAbr']);
        $data['Sperrkennzeichen'] = $this->toBool($data['Sperrkennzeichen']);
        if ($data['Sperrkennzeichen']) {
            $data['Loeschvormerkung'] = 1; // if locked, always marked for deletion
        }

        $data['Suchbegriff1'] = $this->truncate($data['Suchbegriff1'] ?? '', 10);

        //INT Code (0001 Frau, 0002 Herr, 0003 Firma, 0005, 0006 Eheleute)
        $data['Anrede'] = $data['Anrede'] ?: 5; // default to "Firma" / 5
        $kundengruppe1 = ($data['Adresstyp'] === 'KUN') ? $data['Kundengruppe1'] : null;
        try {
            $adresse = Adresse::updateOrCreate(
                ['AdressNummer' => $data['DebitorenKreditorennummer']],
                [
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
                    'NRTitel' => $data['Titel'],
                    'AdrFirmenbezeichnung1' => $this->truncate($data['Name1'] ?? '', 40),
                    'AdrFirmenbezeichnung2' => $this->truncate($data['Name2'] ?? '', 40),
                    'AdrFirmenbezeichnung3' => $this->truncate($data['Name3'] ?? '', 40),
                    'AdrMatchcode' => $data['Suchbegriff1'],
                    'AdrStrasse' => $this->truncate($data['Strasse'] ?? '', 39),
                    'AdrStrasse2' => mb_substr($data['Strasse'] ?? '', 39),
                    'AdrPLZ' => $data['Postleitzahl'],
                    'AdrOrt' => $data['Ort'],
                    'KZLand' => $data['Land'],
                    'AdrPostfach' => $data['Postfach'],
                    'AdrPLZPostfach' => $data['PostleitzahlPostfach'],
                    'AdrOrtPostfach' => $data['OrtPostfach'],
                    'AdrTelefon' => $data['Telefon'],
                    'AdrMobiltelefon' => $data['Mobiltelefon'],
                    'AdrFax' => $data['Fax'],
                    'AdrEmail' => $data['EMail'],
                    'AdrGutschriftsverfahrenJN' => $data['AutoWEAbr'],
                    'AdrLiefersperreJN' => $data['Sperrkennzeichen'],
                    'KZAdressgruppe' => $kundengruppe1,
                    'AdrAltJN' => $data['Loeschvormerkung'],
                    //'ADRindividualC1' => $data['Suchbegriff2'],
                    'ADRindividualC2' => $data['UVIMailadresse'],
                    'ADRindividualC3' => $data['PDFMailadresse'],
                ]
            );
        } catch (Throwable $exception) {
            /*  throw new DBSaveException('bp_0101_geschaeftspartner', ['error' => $exception->getMessage()]);*/
            throw new DBSaveException('bp_0101_geschaeftspartner', [
                'database' => 'Failed to insert worker record'
            ]);
        }

        $interneAdressnummer = $adresse['InterneAdressnummer'] ?? null;

        if ($data['Adresstyp'] === 'KUN' && $interneAdressnummer && !empty($data['Kundengruppe'])) {
            AdresseBranche::updateOrCreate(
                ['InterneAdressnummer' => $interneAdressnummer],
                [
                    'KZBranche' => $data['Kundengruppe'],
                    'AbrHauptJN' => 1,
                ]
            );
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
}
