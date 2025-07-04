<?php

namespace App\Services\BPServices;

use App\Models\Ansprechpartner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;


class BP_01_03_Services
{

    /**
     * SAP → Ceos
     * BP-01-03 Geschäftspartner (GP-Rolle "Verwalter")
     */
    public function bp_0103_verwalter($data, $interneAdressnummer): ?array
    {
        try {
            $gueltigVon = Carbon::parse($data['GueltigVon'])->format('Ymd');
            $gueltigBis = Carbon::parse($data['GueltigBis'])->format('Ymd');
            if ($data['Anrede'] === null || $data['Anrede'] === "") {
                $data['Anrede'] = 5;
            }
            $ansprechpartner = Ansprechpartner::updateOrCreate(
                [
                    'InterneAdressnummer' => $interneAdressnummer,
                    'AnsIndividualC1' => $data['Geschaeftspartnernummer']
                ],
                [
                    'InterneAdressnummer' => $interneAdressnummer,
                    'NRTitel' => $data['Titel'],
                    'NRAnrede' => $data['Anrede'],
                    'AnsVorname' => $data['Vorname'],
                    'AnsNachname' => $data['Nachname'],
                    'AnsPrivatStrasse' => $data['Strasse'], // todo 40 CHAR in DB maybe split Hnr
                    'AnsPrivatOrt' => $data['Postleitzahl'] . " " . $data['Ort'],
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
            $ansprechpartnerId = $ansprechpartner['AnsprechpartnerID'];
        } catch (Throwable $e) {
            Log::error(
                'bp_0103_verwalter Error ' . $e->getMessage(),
                ['Adresse' => $interneAdressnummer]
            );
            return null;
        }
        return [
            'interneAnsprechpartnerId' => $ansprechpartnerId,
            'Geschaeftspartnernummer' => $data['Geschaeftspartnernummer'],
            'Adresse' => $interneAdressnummer
        ];
    }
}
