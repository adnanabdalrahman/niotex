<?php

namespace App\Services\BPServices;

use App\Exceptions\DBSaveException;
use App\Models\Ansprechpartner;
use Carbon\Carbon;
use Throwable;

class BP_01_03_Services
{
    /**
     * SAP → Ceos
     * BP-01-03 Geschäftspartner (GP-Rolle "Verwalter")
     *
     * @param array $data
     * @param int $interneAdressnummer
     * @return array|null
     *
     * @throws DBSaveException
     */
    public function bp_0103_verwalter(array $data, int $interneAdressnummer): ?array
    {
        $defaults = [
            'Anrede' => 5,
            'Titel' => null,
            'Vorname' => null,
            'Nachname' => null,
            'Strasse' => '',
            'Postleitzahl' => '',
            'Ort' => '',
            'Telefon' => null,
            'Mobiltelefon' => null,
            'Fax' => null,
            'EMail' => null,
            'Geschaeftspartnernummer' => null,
            'Ansprechpartner2' => null,
            'GueltigVon' => null,
            'GueltigBis' => null,
        ];

        $data = array_merge($defaults, $data);

        // Format dates safely
        $gueltigVon = $data['GueltigVon'] ? Carbon::parse($data['GueltigVon'])->format('Ymd') : null;
        $gueltigBis = $data['GueltigBis'] ? Carbon::parse($data['GueltigBis'])->format('Ymd') : null;

        try {
            $ansprechpartner = Ansprechpartner::updateOrCreate(
                [
                    'InterneAdressnummer' => $interneAdressnummer,
                    'AnsIndividualC1' => $data['Geschaeftspartnernummer'],
                ],
                [
                    'InterneAdressnummer' => $interneAdressnummer,
                    'NRTitel' => $data['Titel'],
                    'NRAnrede' => $data['Anrede'] ?: 5,
                    'AnsVorname' => $data['Vorname'],
                    'AnsNachname' => $data['Nachname'],
                    'AnsPrivatStrasse' => mb_substr($data['Strasse'], 0, 39),
                    'AnsPrivatOrt' => trim($data['Postleitzahl'] . ' ' . $data['Ort']),
                    'AnsPrivatTelefon' => $data['Telefon'],
                    'AnsMobiltelefon' => $data['Mobiltelefon'],
                    'AnsFax' => $data['Fax'],
                    'AnsEMail' => $data['EMail'],
                    'AnsIndividualD1' => $gueltigVon,
                    'AnsIndividualD2' => $gueltigBis,
                    'AnsIndividualC1' => $data['Geschaeftspartnernummer'],
                    'AnsIndividualC2' => $data['Ansprechpartner2'],
                ]
            );

            return [
                'interneAnsprechpartnerId' => $ansprechpartner->AnsprechpartnerID,
                'Geschaeftspartnernummer' => $data['Geschaeftspartnernummer'],
                'Adresse' => $interneAdressnummer,
            ];
        } catch (Throwable $exception) {
            throw new DBSaveException('Fehler beim Speichern oder Aktualisieren des Ansprechpartner: ' . $exception->getMessage());
        }
    }
}
