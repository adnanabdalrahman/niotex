<?php

namespace App\Services\REServices;

use App\Models\Adresse;
use App\Models\Ceos_ABRECHNUNG;
use App\Models\Ceos_ABRECHNUNG_TimeLine;
use App\Models\Ceos_GEBAEUDE;
use App\Models\Ceos_GEBAEUDE_TimeLine;
use App\Models\Ceos_ID_SAP;
use App\Models\Ceos_LIEGENSCHAFT;
use App\Models\Ceos_LIEGENSCHAFT_TimeLine;
use App\Models\Ceos_MIETER;
use App\Models\Ceos_MIETER_TimeLine;
use App\Models\Ceos_VERWALTUNG;
use App\Models\Ceos_VERWALTUNG_TimeLine;
use App\Models\Ceos_WOHNEINHEIT;
use App\Models\Ceos_WOHNEINHEIT_TimeLine;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class RE_01_01_Services
{
    public function re_01_01_Liegenschaften(array $receivedLiegenschaften): array
    {
        $report = ['success' => [], 'failed' => []];

        foreach ($receivedLiegenschaften as $wrapper) {
            $data = $wrapper['liegenschaft'];
            $slgnr = $data['slgnr'];

            try {
                DB::transaction(fn() => $this->processLiegenschaft($data), 3);

                $report['success'][] = [
                    'slgnr' => $slgnr,
                    'message' => 'Erfolgreich importiert'
                ];
            } catch (Throwable $e) {
                Log::error("Liegenschaft $slgnr failed", [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);

                $report['failed'][] = [
                    'slgnr' => $slgnr,
                    'message' => $e->getMessage()
                ];
            }
        }

        return $report;
    }

    private function processLiegenschaft(array $data): void
    {
        $liegenschaft = Ceos_LIEGENSCHAFT::updateOrCreate(
            ['Liegenschaftsnummer' => $data['slgnr']],
            ['User' => 0]
        );

        $this->processTimeline($liegenschaft, $data);
        $this->processGebaeude($liegenschaft, $data['adressen']);
        $this->processMieter0($liegenschaft, $data);
        $this->processKunden($liegenschaft, $data['kunden'] ?? []);
        $this->processMietobjekte($liegenschaft, $data['mietobjekte'] ?? []);
        $this->processMieter($liegenschaft, $data['mieter']);
        $this->processAbrechnungen($liegenschaft, $data['abrechnungsdaten']);
    }

    private function processTimeline(Ceos_LIEGENSCHAFT $liegenschaft, array $data): void
    {
        $kunden = $data['kunden'];

        Ceos_LIEGENSCHAFT_TimeLine::upsert(
            [[
                'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                'Liegenschaftsnummer' => $data['slgnr'],
                'MDM' => $data['mdmId'],
                'Fernablesung_JN' => $data['fern'],
                'Fernablesung_Ab' => $data['fernAb'],
                'OnlinePortal_JN' => $data['opk'],
                'OnlinePortal_Ab' => $data['opkAb'],
                'UviReady_JN' => $data['uvir'],
                'UviReady_Ab' => $data['uvirAb'],
                'Mdf' => $data['mdf'],
                'Vertreter' => $kunden[0]['vtrCeos'] ?? null,
                'Mdf_Bis' => $data['mdfBis'],
                'DatumVon' => $data['validfrom'],
                'DatumBis' => $data['validto'],
                'User' => 0,
            ]],
            ['LiegenschaftsID', 'DatumVon'],
            ['Fernablesung_JN', 'Fernablesung_Ab', 'OnlinePortal_JN', 'OnlinePortal_Ab', 'UviReady_JN', 'UviReady_Ab', 'Mdf', 'Vertreter', 'Mdf_Bis', 'DatumBis', 'User']
        );

        if (!empty($data['lgnrExt'])) {
            $this->createSapId($liegenschaft->LiegenschaftsID, 'LG_KORR_Nr', $data['lgnrExt']);
        }
    }

    private function createSapId(int $id, string $type, string $value): void
    {
        Ceos_ID_SAP::updateOrCreate(
            ['ID' => $id, 'TYPE' => $type],
            ['VALUE' => $value]
        );
    }

    private function processGebaeude(Ceos_LIEGENSCHAFT $liegenschaft, array $adressen): void
    {
        $rows = [];
        foreach ($adressen as $adresse) {
            $gebaeude = Ceos_GEBAEUDE::updateOrCreate(
                ['GEB_COMP_API_ID' => $liegenschaft->Liegenschaftsnummer . '-' . $adresse['genrCeos']],
                ['User' => 0]
            );

            $rows[] = [
                'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                'GebaeudeID' => $gebaeude->GebaeudeID,
                'MDM' => $adresse['mdmId'],
                'DatumVon' => $adresse['validfrom'],
                'DatumBis' => $adresse['validto'],
                'GebaeudeNr' => $adresse['genrCeos'],
                'LG_Strasse' => $adresse['lgStr'],
                'LG_PLZ' => $adresse['lgPlz'],
                'LG_Ort' => $adresse['lgOrt'],
                'Heizanlage_JN' => $adresse['hausHeizanlage'],
                'User' => 0,
            ];

            if (!empty($adresse['tplnr'])) {
                $this->createSapId($gebaeude->GebaeudeID, 'GEB_TPlatz', $adresse['tplnr']);
            }
        }

        if (!empty($rows)) {
            foreach (array_chunk($rows, 150) as $chunk) {
                Ceos_GEBAEUDE_TimeLine::upsert(
                    $chunk,
                    ['LiegenschaftsID', 'GebaeudeNr', 'DatumVon'],
                    ['MDM', 'DatumBis', 'LG_Strasse', 'LG_PLZ', 'LG_Ort', 'Heizanlage_JN', 'User']
                );
            }
        }
    }

    private function processMieter0(Ceos_LIEGENSCHAFT $liegenschaft, array $data): void
    {
        $wohneinheit = Ceos_WOHNEINHEIT::updateOrCreate(
            ['WE_COMP_API_ID' => $data['slgnr'] . '-0-0'],
            ['User' => 0]
        );

        $gebaeude = $this->findGebaeude($liegenschaft, 0);

        Ceos_WOHNEINHEIT_TimeLine::upsert([[
            'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
            'WohneinheitID' => $wohneinheit->WohneinheitID,
            'lfd_Adressnummer_GE_CEOS' => 0,
            'GebaeudeID' => $gebaeude?->GebaeudeID,
            'MDM' => null,
            'WE_LfdNr' => 0,
            'WE_Bezeichnung' => 'Allgemein',
            'Gewerblich_JN' => 0,
            'DatumVon' => $this->today(),
            'DatumBis' => '99991231',
            'User' => 0,
        ]],
            ['LiegenschaftsID', 'WE_LfdNr', 'DatumVon'],
            ['DatumBis', 'WE_Bezeichnung', 'Gewerblich_JN', 'User']
        );

        $mieter = Ceos_MIETER::updateOrCreate(
            ['MI_COMP_API_ID' => $data['slgnr'] . '-0-0'],
            ['User' => 0]
        );

        Ceos_MIETER_TimeLine::upsert([[
            'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
            'WohneinheitID' => $wohneinheit->WohneinheitID,
            'MieterID' => $mieter->MieterID,
            'lfd_Adressnummer_GE_CEOS' => 0,
            'lfd_Adressnummer_ME_CEOS' => 0,
            'Mietvertragsnummer' => null,
            'M_Name1' => 'Allgemein',
            'M_Anrede' => null,
            'DatumVon' => $this->today(),
            'DatumBis' => '99991231',
            'User' => 0,
        ]],
            ['LiegenschaftsID', 'MieterID', 'DatumVon'],
            ['DatumBis', 'M_Name1', 'M_Anrede', 'User']
        );
    }

    private function findGebaeude(Ceos_LIEGENSCHAFT $liegenschaft, int $nr): ?Ceos_GEBAEUDE_TimeLine
    {
        return Ceos_GEBAEUDE_TimeLine::where('GebaeudeNr', $nr)
            ->where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
            ->first();
    }

    private function today(): string
    {
        return Carbon::now()->format('Ymd');
    }

    private function processKunden(Ceos_LIEGENSCHAFT $liegenschaft, array $kunden): void
    {
        $rows = [];
        foreach ($kunden as $kunde) {
            $verwaltung = Ceos_VERWALTUNG::updateOrCreate(
                ['VER_FOREIGN_ID' => $kunde['kunnr']],
                ['User' => 0]
            );

            $adressnummer = ltrim($kunde['kunnr'], '0');
            $adresse = Adresse::where('AdressNummer', $adressnummer)->first();
            if (!$adresse) {
                $this->logMissing('Kein Adresse gefunden', ['adressnummer' => $adressnummer]);
                continue;
            }

            $rows[] = [
                'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                'VerwaltungID' => $verwaltung->VerwaltungID,
                'DatumVon' => $kunde['validfrom'],
                'DatumBis' => $kunde['validto'],
                'AuftraggeberID' => $adresse->InterneAdressnummer,
                'Kundenart' => $kunde['kdart'],
                'ErsteAbr' => $kunde['abrfirst'],
                'LetzteAbr' => $kunde['abrlast'],
                'User' => 0,
            ];
        }

        if ($rows) {
            Ceos_VERWALTUNG_TimeLine::upsert(
                $rows,
                ['LiegenschaftsID', 'VerwaltungID', 'DatumVon'],
                ['DatumBis', 'AuftraggeberID', 'Kundenart', 'ErsteAbr', 'LetzteAbr', 'User']
            );
        }
    }

    private function logMissing(string $context, array $extra = []): void
    {
        Log::warning("re_01_01_Liegenschaften: $context", $extra);
    }

    private function processMietobjekte(Ceos_LIEGENSCHAFT $liegenschaft, array $mietobjekte): void
    {
        $rows = [];
        foreach ($mietobjekte as $mietobjekt) {
            $wohneinheit = Ceos_WOHNEINHEIT::updateOrCreate(
                ['WE_COMP_API_ID' => $liegenschaft->Liegenschaftsnummer . '-' . $mietobjekt['genrCeos'] . '-' . $mietobjekt['menrCeos']],
                ['User' => 0]
            );

            $gebaeude = $this->findGebaeude($liegenschaft, $mietobjekt['genrCeos']);
            if (!$gebaeude) {
                $this->logMissing('Kein Gebaeude', ['LiegenschaftsID' => $liegenschaft->LiegenschaftsID, 'GebaeudeNr' => $mietobjekt['genrCeos']]);
                continue;
            }

            $rows[] = [
                'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                'WohneinheitID' => $wohneinheit->WohneinheitID,
                'lfd_Adressnummer_GE_CEOS' => $mietobjekt['genrCeos'],
                'GebaeudeID' => $gebaeude->GebaeudeID,
                'MDM' => $mietobjekt['mdmIdMe'],
                'WE_LfdNr' => $mietobjekt['menrCeos'],
                'WE_Bezeichnung' => $mietobjekt['mLage'],
                'Gewerblich_JN' => $mietobjekt['gewerblichJn'],
                'DatumVon' => $mietobjekt['validfrom'],
                'DatumBis' => $mietobjekt['validto'],
                'User' => 0,
            ];

            foreach ([
                         'tplnr' => 'WE_TPlatz',
                         'korrnrHk' => 'WE_HK_KORR_Nr',
                         'korrnrKw' => 'WE_KW_KORR_Nr',
                     ] as $key => $type) {
                if (!empty($mietobjekt[$key])) {
                    $this->createSapId($wohneinheit->WohneinheitID, $type, $mietobjekt[$key]);
                }
            }
        }

        if (!empty($rows)) {
            foreach (array_chunk($rows, 150) as $chunk) {
                Ceos_WOHNEINHEIT_TimeLine::upsert(
                    $chunk,
                    ['LiegenschaftsID', 'WE_LfdNr', 'DatumVon'],
                    ['lfd_Adressnummer_GE_CEOS', 'GebaeudeID', 'MDM', 'WE_Bezeichnung', 'Gewerblich_JN', 'DatumBis', 'User']
                );
            }
        }

    }

    private function processMieter(Ceos_LIEGENSCHAFT $liegenschaft, array $mieters): void
    {
        $rows = [];
        foreach ($mieters as $receivedMieter) {
            //todo important delete later
            if ($receivedMieter['recnnr'] == null) {
                continue;
            }
            $mieter = Ceos_MIETER::updateOrCreate(
                ['MI_COMP_API_ID' => $receivedMieter['recnnr']],
                ['User' => 0]
            );

            $gebaeude = $this->findGebaeude($liegenschaft, $receivedMieter['genrCeos']);
            $wohneinheit = $this->findWohneinheit($liegenschaft, $gebaeude, $receivedMieter['menrCeos']);

            if (!$wohneinheit) {
                $this->logMissing('Kein Wohneinheit', ['genr' => $receivedMieter['genrCeos'], 'menr' => $receivedMieter['menrCeos']]);
                continue;
            }

            $rows[] = [
                'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                'WohneinheitID' => $wohneinheit->WohneinheitID,
                'MieterID' => $mieter->MieterID,
                'lfd_Adressnummer_GE_CEOS' => $receivedMieter['genrCeos'],
                'lfd_Adressnummer_ME_CEOS' => $receivedMieter['menrCeos'],
                'Mietvertragsnummer' => $receivedMieter['recnnr'],
                'M_Name1' => $receivedMieter['mName'],
                'M_Anrede' => $receivedMieter['mAnrede'],
                'DatumVon' => $receivedMieter['datumEinzug'],
                'DatumBis' => $receivedMieter['datumAuszug'],
                'User' => 0,
            ];
        }

        if (!empty($rows)) {
            // Process in chunks to avoid SQL Server's 2100 parameter limit
            foreach (array_chunk($rows, 150) as $chunk) {
                Ceos_MIETER_TimeLine::upsert(
                    $chunk,
                    ['LiegenschaftsID', 'MieterID', 'DatumVon'],
                    ['lfd_Adressnummer_GE_CEOS', 'lfd_Adressnummer_ME_CEOS', 'Mietvertragsnummer', 'M_Name1', 'M_Anrede', 'DatumBis', 'User']
                );
            }
        }

    }

    private function findWohneinheit(Ceos_LIEGENSCHAFT $liegenschaft, ?Ceos_GEBAEUDE_TimeLine $gebaeude, int $menr): ?Ceos_WOHNEINHEIT_TimeLine
    {
        if (!$gebaeude) {
            return null;
        }
        return Ceos_WOHNEINHEIT_TimeLine::where('WE_LfdNr', $menr)
            ->where('GebaeudeID', $gebaeude->GebaeudeID)
            ->where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
            ->first();
    }

    private function processAbrechnungen(Ceos_LIEGENSCHAFT $liegenschaft, array $abrechnungsdaten): void
    {
        $rows = [];
        foreach ($abrechnungsdaten as $receivedAbrechnung) {
            $abrechnung = Ceos_ABRECHNUNG::updateOrCreate(
                ['ABR_COMP_API_ID' => $liegenschaft->Liegenschaftsnummer],
                ['User' => 0]
            );

            $rows[] = [
                'AbrechnungID' => $abrechnung->AbrechnungID,
                'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                'DatumVon' => $receivedAbrechnung['datab'],
                'DatumBis' => $receivedAbrechnung['datbi'],
                'Stichtag_HKA' => $this->formatTo1900Date($receivedAbrechnung['sttHka']),
                'Stichtag_KWA' => $this->formatTo1900Date($receivedAbrechnung['sttKwa']),
                'Stichtag_NKA' => $this->formatTo1900Date($receivedAbrechnung['sttNka']),
                'Stichtag_STA' => $this->formatTo1900Date($receivedAbrechnung['sttNka']),
                'Heizung_JN' => $receivedAbrechnung['hka'],
                'Kaltwasser_JN' => $receivedAbrechnung['kwa'],
                'Betriebskosten_JN' => $receivedAbrechnung['nka'],
                'Stromkosten_JN' => $receivedAbrechnung['sta'],
                'Ablesung' => $receivedAbrechnung['abl'],
                'Selbstableser' => $receivedAbrechnung['selbstableserJn'],
                'DTA' => $receivedAbrechnung['dta'],
                'BKB' => $receivedAbrechnung['bkb'],
                'ServiceRWM' => $receivedAbrechnung['rwm'],
                'AbrechnungProHaus' => $receivedAbrechnung['hwabr'],
                'Warmwasser_JN' => $receivedAbrechnung['ww'],
                'User' => 0,
            ];
        }

        if ($rows) {
            Ceos_ABRECHNUNG_TimeLine::upsert(
                $rows,
                ['AbrechnungID', 'LiegenschaftsID', 'DatumVon'],
                ['DatumBis', 'Stichtag_HKA', 'Stichtag_KWA', 'Stichtag_NKA', 'Stichtag_STA', 'Heizung_JN', 'Kaltwasser_JN', 'Betriebskosten_JN', 'Stromkosten_JN', 'Ablesung', 'Selbstableser', 'DTA', 'BKB', 'ServiceRWM', 'AbrechnungProHaus', 'Warmwasser_JN', 'User']
            );
        }
    }

    private function formatTo1900Date(?string $md): ?string
    {
        if (empty($md) || !preg_match('/^\d{4}$/', $md)) {
            return null;
        }

        $month = substr($md, 0, 2);
        $day = substr($md, 2, 2);
        $date = "1900-$month-$day";

        try {
            return Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
        } catch (Throwable $e) {
            Log::error('Invalid month/day: ' . $e->getMessage());
            return null;
        }
    }
}
