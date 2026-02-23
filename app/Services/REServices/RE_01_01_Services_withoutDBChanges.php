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

class RE_01_01_Services_withoutDBChanges
{
    private array $importedGebaeude = [];
    private array $importedWohneinheiten = [];
    private array $importedMieter = [];
    private ?int $currentLiegenschaftId = null;

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

    /**
     * @throws Throwable
     */
    private function processLiegenschaft(array $data): void
    {
        $liegenschaft = Ceos_LIEGENSCHAFT::updateOrCreate(
            ['Liegenschaftsnummer' => $data['slgnr']],
            ['User' => 0]
        );
        $this->currentLiegenschaftId = $liegenschaft->LiegenschaftsID;
        $this->processTimeline($liegenschaft, $data);
        $this->processGebaeude($liegenschaft, $data['adressen']);
        $this->processMieter0($liegenschaft, $data);
        $this->processKunden($liegenschaft, $data['kunden'] ?? []);
        $this->processMietobjekte($liegenschaft, $data['mietobjekte'] ?? []);
        $this->processMieter($liegenschaft, $data['mieter']);
        $this->processAbrechnungen($liegenschaft, $data['abrechnungsdaten']);
    }

    /**
     * @throws Throwable
     */


    private function processTimeline(Ceos_LIEGENSCHAFT $liegenschaft, array $data): void
    {
        $kunden = $data['kunden'] ?? [];

        DB::transaction(function () use ($liegenschaft, $data, $kunden) {

            // -------------------------------------------------
            // API data
            // -------------------------------------------------
            $apiData = [
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
                'Mdf_Bis' => $data['mdfBis'],
                'Vertreter' => $kunden[0]['vtrCeos'] ?? null,
                'DatumVon' => $data['validfrom'],
                'DatumBis' => $this->normalizeValidTo($data['validto'] ?? null),
                'User' => 1,
            ];

            // =================================================
            // HISTORICAL RECORD (closed period)
            // =================================================
            if ($apiData['DatumBis'] !== '9999-12-31') {

                // Check duplicate by period
                $exists = Ceos_LIEGENSCHAFT_TimeLine::where([
                    'LiegenschaftsID' => $apiData['LiegenschaftsID'],
                    'DatumVon' => $apiData['DatumVon'],
                    'DatumBis' => $apiData['DatumBis'],
                ])->exists();

                if ($exists) {
                    return;
                }

                // Find last record for this property
                $lastRecord = Ceos_LIEGENSCHAFT_TimeLine::where(
                    'LiegenschaftsID',
                    $apiData['LiegenschaftsID']
                )->orderByDesc('ID')->first();

                if ($lastRecord) {

                    $base = $lastRecord->toArray();

                    unset(
                        $base['ID'],
                        $base['DateStamp'],
                        $base['TimeStamp'],
                        $base['FULL_HASH']
                    );

                    $newData = array_merge($base, $apiData);

                    Ceos_LIEGENSCHAFT_TimeLine::create($newData);
                    return;
                }

                // No history → insert as is
                Ceos_LIEGENSCHAFT_TimeLine::create($apiData);
                return;
            }

            // =================================================
            // CURRENT STATE = latest open record
            // =================================================
            $last = Ceos_LIEGENSCHAFT_TimeLine::where('LiegenschaftsID', $apiData['LiegenschaftsID'])
                ->where('DatumBis', '9999-12-31')
                ->orderByDesc('ID')
                ->first();

            // -------------------------------------------------
            // No history → insert
            // -------------------------------------------------
            if (!$last) {
                Ceos_LIEGENSCHAFT_TimeLine::create($apiData);
                return;
            }

            // =================================================
            // CASE 1 — identical current state
            // =================================================
            $identical = true;

            foreach ($apiData as $field => $value) {
                if ($last->$field != $value) {
                    $identical = false;
                    break;
                }
            }

            if ($identical) {
                return;
            }

            // =================================================
            // CASE 3/4 — copy previous data
            // =================================================
            $base = $last->toArray();

            unset(
                $base['ID'],
                $base['DateStamp'],
                $base['TimeStamp'],
                $base['FULL_HASH']
            );

            $newData = array_merge($base, $apiData);

            Ceos_LIEGENSCHAFT_TimeLine::create($newData);
        });

        // -------------------------------------------------
        // SAP ID (outside transaction is OK here)
        // -------------------------------------------------
        if (!empty($data['lgnrExt'])) {
            $this->createSapId(
                $liegenschaft->LiegenschaftsID,
                'LG_KORR_Nr',
                $data['lgnrExt']
            );
        }
    }

    private function normalizeValidTo(?string $date): string
    {
        if (!$date || $date === '0000-00-00') {
            return '9999-12-31';
        }

        return $date;
    }

    private function createSapId(int $id, string $type, string $value): void
    {
        Ceos_ID_SAP::updateOrCreate(
            ['ID' => $id, 'TYPE' => $type],
            ['VALUE' => $value]
        );
    }

    /**
     * @throws Throwable
     */
    private function processGebaeude(Ceos_LIEGENSCHAFT $liegenschaft, array $adressen): void
    {
        foreach ($adressen as $adresse) {

            // -------------------------------------------------
            // Gebäude master
            // -------------------------------------------------
            $gebaeude = Ceos_GEBAEUDE::firstOrCreate(
                ['GEB_COMP_API_ID' => $liegenschaft->Liegenschaftsnummer . '-' . $adresse['genrCeos']],
                ['User' => 0]
            );

            $this->importedGebaeude[] = $gebaeude->GebaeudeID;

            $tplnr = $adresse['tplnr'] ?? null;

            DB::transaction(function () use ($liegenschaft, $adresse, $gebaeude) {

                // -------------------------------------------------
                // API data
                // -------------------------------------------------
                $apiData = [
                    'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                    'GebaeudeID' => $gebaeude->GebaeudeID,
                    'GebaeudeNr' => $adresse['genrCeos'],
                    'MDM' => $adresse['mdmId'],
                    'LG_Strasse' => $adresse['lgStr'],
                    'LG_PLZ' => $adresse['lgPlz'],
                    'LG_Ort' => $adresse['lgOrt'],
                    'LAND' => 'DE',
                    'Heizanlage_JN' => $adresse['hausHeizanlage'],
                    'DatumVon' => $adresse['validfrom'],
                    'DatumBis' => $this->normalizeValidTo($adresse['validto'] ?? null),
                    'User' => 1,
                ];

                // =================================================
                // HISTORICAL RECORD (closed period)
                // =================================================
                if ($apiData['DatumBis'] !== '9999-12-31') {

                    // Check duplicate by period
                    $exists = Ceos_GEBAEUDE_TimeLine::where([
                        'LiegenschaftsID' => $apiData['LiegenschaftsID'],
                        'GebaeudeID' => $apiData['GebaeudeID'],
                        'DatumVon' => $apiData['DatumVon'],
                        'DatumBis' => $apiData['DatumBis'],
                    ])->exists();

                    if ($exists) {
                        return;
                    }

                    // Find last record for this building
                    $lastRecord = Ceos_GEBAEUDE_TimeLine::where([
                        'LiegenschaftsID' => $apiData['LiegenschaftsID'],
                        'GebaeudeID' => $apiData['GebaeudeID'],
                    ])
                        ->orderByDesc('ID')
                        ->first();

                    if ($lastRecord) {

                        $base = $lastRecord->toArray();

                        unset(
                            $base['ID'],
                            $base['DateStamp'],
                            $base['TimeStamp'],
                            $base['FULL_HASH']
                        );

                        $newData = array_merge($base, $apiData);

                        Ceos_GEBAEUDE_TimeLine::create($newData);
                        return;
                    }

                    // No history → insert as is
                    Ceos_GEBAEUDE_TimeLine::create($apiData);
                    return;
                }

                // =================================================
                // CURRENT STATE = latest open record
                // =================================================
                $last = Ceos_GEBAEUDE_TimeLine::where('GebaeudeID', $apiData['GebaeudeID'])
                    ->where('DatumBis', '9999-12-31')
                    ->orderByDesc('ID')
                    ->first();

                // -------------------------------------------------
                // No history → insert
                // -------------------------------------------------
                if (!$last) {
                    Ceos_GEBAEUDE_TimeLine::create($apiData);
                    return;
                }

                // =================================================
                // CASE 1 — identical current state
                // =================================================
                $identical = true;

                foreach ($apiData as $field => $value) {
                    if ($last->$field != $value) {
                        $identical = false;
                        break;
                    }
                }

                if ($identical) {
                    return;
                }

                // =================================================
                // CASE 3/4 — copy previous data
                // =================================================
                $base = $last->toArray();

                unset(
                    $base['ID'],
                    $base['DateStamp'],
                    $base['TimeStamp'],
                    $base['FULL_HASH']
                );

                $newData = array_merge($base, $apiData);

                Ceos_GEBAEUDE_TimeLine::create($newData);
            });

            // -------------------------------------------------
            // SAP ID
            // -------------------------------------------------
            if (!empty($tplnr)) {
                $this->createSapId(
                    $gebaeude->GebaeudeID,
                    'GEB_TPlatz',
                    $tplnr
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
        $this->importedWohneinheiten[] = $wohneinheit->WohneinheitID;

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
            'DatumBis' => '9999-12-31',
            'User' => 1,
        ]],
            ['LiegenschaftsID', 'WE_LfdNr'],
            ['DatumBis', 'WE_Bezeichnung', 'Gewerblich_JN', 'User']
        );

        $mieter = Ceos_MIETER::updateOrCreate(
            ['MI_COMP_API_ID' => $data['slgnr'] . '-0-0-0'],
            ['User' => 0]
        );
        $this->importedMieter[] = $mieter->MieterID;

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
            'User' => 1,
        ]],
            ['LiegenschaftsID', 'lfd_Adressnummer_GE_CEOS', 'lfd_Adressnummer_ME_CEOS', 'MieterID'],
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

    /**
     * @throws Throwable
     */
    private function processKunden(Ceos_LIEGENSCHAFT $liegenschaft, array $kunden): void
    {
        foreach ($kunden as $kunde) {

            DB::transaction(function () use ($liegenschaft, $kunde) {

                // -------------------------------------------------
                // Verwaltung master
                // -------------------------------------------------
                $verwaltung = Ceos_VERWALTUNG::firstOrCreate(
                    ['VER_FOREIGN_ID' => $kunde['kunnr']],
                    ['User' => 0]
                );

                // -------------------------------------------------
                // Resolve address
                // -------------------------------------------------
                $adressnummer = ltrim($kunde['kunnr'], '0');

                $adresse = Adresse::where('AdressNummer', $adressnummer)->first();

                if (!$adresse) {
                    $this->logMissing('Kein Adresse gefunden', ['adressnummer' => $adressnummer]);
                    return;
                }

                // -------------------------------------------------
                // API data
                // -------------------------------------------------
                $apiData = [
                    'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                    'VerwaltungID' => $verwaltung->VerwaltungID,
                    'AuftraggeberID' => $adresse->InterneAdressnummer,
                    'Kundenart' => $kunde['kdart'],
                    'ErsteAbr' => $kunde['abrfirst'],
                    'LetzteAbr' => $kunde['abrlast'],
                    'DatumVon' => $kunde['validfrom'],
                    'DatumBis' => $this->normalizeValidTo($kunde['validto'] ?? null),
                    'User' => 1,
                ];

                // =================================================
                // HISTORICAL RECORD (closed period)
                // =================================================
                if ($apiData['DatumBis'] !== '9999-12-31') {

                    // Check duplicate by period
                    $exists = Ceos_VERWALTUNG_TimeLine::where([
                        'LiegenschaftsID' => $apiData['LiegenschaftsID'],
                        'VerwaltungID' => $apiData['VerwaltungID'],
                        'DatumVon' => $apiData['DatumVon'],
                        'DatumBis' => $apiData['DatumBis'],
                    ])->exists();

                    if ($exists) {
                        return;
                    }

                    // Find last record for this Verwaltung
                    $lastRecord = Ceos_VERWALTUNG_TimeLine::where([
                        'LiegenschaftsID' => $apiData['LiegenschaftsID'],
                        'VerwaltungID' => $apiData['VerwaltungID'],
                    ])
                        ->orderByDesc('ID')
                        ->first();

                    if ($lastRecord) {

                        $base = $lastRecord->toArray();

                        unset(
                            $base['ID'],
                            $base['DateStamp'],
                            $base['TimeStamp'],
                            $base['FULL_HASH']
                        );

                        $newData = array_merge($base, $apiData);

                        Ceos_VERWALTUNG_TimeLine::create($newData);
                        return;
                    }

                    // No history → insert as is
                    Ceos_VERWALTUNG_TimeLine::create($apiData);
                    return;
                }

                // =================================================
                // CURRENT STATE = latest open record
                // =================================================
                $last = Ceos_VERWALTUNG_TimeLine::where('VerwaltungID', $apiData['VerwaltungID'])
                    ->where('DatumBis', '9999-12-31')
                    ->orderByDesc('ID')
                    ->first();

                // -------------------------------------------------
                // No history → insert
                // -------------------------------------------------
                if (!$last) {
                    Ceos_VERWALTUNG_TimeLine::create($apiData);
                    return;
                }

                // =================================================
                // CASE 1 — identical current state
                // =================================================
                $identical = true;

                foreach ($apiData as $field => $value) {
                    if ($last->$field != $value) {
                        $identical = false;
                        break;
                    }
                }

                if ($identical) {
                    return;
                }

                // =================================================
                // CASE 3/4 — copy previous data
                // =================================================
                $base = $last->toArray();

                unset(
                    $base['ID'],
                    $base['DateStamp'],
                    $base['TimeStamp'],
                    $base['FULL_HASH']
                );

                $newData = array_merge($base, $apiData);

                Ceos_VERWALTUNG_TimeLine::create($newData);
            });
        }
    }

    private function logMissing(string $context, array $extra = []): void
    {
        Log::warning("re_01_01_Liegenschaften: $context", $extra);
    }

    /**
     * @throws Throwable
     */
    private function processMietobjekte(Ceos_LIEGENSCHAFT $liegenschaft, array $mietobjekte): void
    {
        foreach ($mietobjekte as $mietobjekt) {

            // -------------------------------------------------
            // Wohneinheit master
            // -------------------------------------------------
            $wohneinheit = Ceos_WOHNEINHEIT::firstOrCreate(
                [
                    'WE_COMP_API_ID' =>
                        $liegenschaft->Liegenschaftsnummer . '-' .
                        $mietobjekt['genrCeos'] . '-' .
                        $mietobjekt['menrCeos'],
                ],
                ['User' => 0]
            );

            $this->importedWohneinheiten[] = $wohneinheit->WohneinheitID;

            // -------------------------------------------------
            // Resolve building
            // -------------------------------------------------
            $gebaeude = $this->findGebaeude($liegenschaft, $mietobjekt['genrCeos']);
            if (!$gebaeude) continue;

            DB::transaction(function () use ($liegenschaft, $mietobjekt, $wohneinheit, $gebaeude) {

                // -------------------------------------------------
                // API data
                // -------------------------------------------------
                $apiData = [
                    'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                    'GebaeudeID' => $gebaeude->GebaeudeID,
                    'WohneinheitID' => $wohneinheit->WohneinheitID,
                    'lfd_Adressnummer_GE_CEOS' => $mietobjekt['genrCeos'],
                    'WE_LfdNr' => $mietobjekt['menrCeos'],
                    'WE_Bezeichnung' => $mietobjekt['mLage'],
                    'Gewerblich_JN' => $mietobjekt['gewerblichJn'],
                    'MDM' => $mietobjekt['mdmIdMe'],
                    'DatumVon' => $mietobjekt['validfrom'],
                    'DatumBis' => $this->normalizeValidTo($mietobjekt['validto'] ?? null),
                    'User' => 1,
                ];

                // =================================================
                // HISTORICAL RECORD (closed period)
                // =================================================
                if ($apiData['DatumBis'] !== '9999-12-31') {

                    // Check exact duplicate
                    $exists = Ceos_WOHNEINHEIT_TimeLine::where([
                        'LiegenschaftsID' => $apiData['LiegenschaftsID'],
                        'WohneinheitID' => $apiData['WohneinheitID'],
                        'DatumVon' => $apiData['DatumVon'],
                        'DatumBis' => $apiData['DatumBis'],
                    ])->exists();

                    if ($exists) {
                        return;
                    }

                    // Find last record for this unit
                    $lastUnitRecord = Ceos_WOHNEINHEIT_TimeLine::where([
                        'LiegenschaftsID' => $apiData['LiegenschaftsID'],
                        'WohneinheitID' => $apiData['WohneinheitID'],
                    ])
                        ->orderByDesc('ID')
                        ->first();

                    if ($lastUnitRecord) {

                        $base = $lastUnitRecord->toArray();

                        unset(
                            $base['ID'],
                            $base['DateStamp'],
                            $base['TimeStamp'],
                            $base['FULL_HASH']
                        );

                        $newData = array_merge($base, $apiData);

                        Ceos_WOHNEINHEIT_TimeLine::create($newData);
                        return;
                    }

                    Ceos_WOHNEINHEIT_TimeLine::create($apiData);
                    return;
                }

                // =================================================
                // CURRENT STATE = latest open record
                // =================================================
                $last = Ceos_WOHNEINHEIT_TimeLine::where('WohneinheitID', $apiData['WohneinheitID'])
                    ->where('DatumBis', '9999-12-31')
                    ->orderByDesc('ID')
                    ->first();

                // -------------------------------------------------
                // No history → insert
                // -------------------------------------------------
                if (!$last) {
                    Ceos_WOHNEINHEIT_TimeLine::create($apiData);
                    return;
                }

                // =================================================
                // CASE 1 — identical
                // =================================================
                $identical = true;

                foreach ($apiData as $field => $value) {
                    if ($last->$field != $value) {
                        $identical = false;
                        break;
                    }
                }

                if ($identical) {
                    return;
                }

                // =================================================
                // CASE 3/4 — copy previous data
                // (units have no tenant dimension)
                // =================================================
                $base = $last->toArray();

                unset(
                    $base['ID'],
                    $base['DateStamp'],
                    $base['TimeStamp'],
                    $base['FULL_HASH']
                );

                $newData = array_merge($base, $apiData);

                Ceos_WOHNEINHEIT_TimeLine::create($newData);
            });

            // -------------------------------------------------
            // SAP IDs
            // -------------------------------------------------
            foreach ([
                         'tplnr' => 'WE_TPlatz',
                         'korrnrHk' => 'WE_HK_KORR_Nr',
                         'korrnrKw' => 'WE_KW_KORR_Nr',
                     ] as $key => $type) {

                if (!empty($mietobjekt[$key])) {
                    $this->createSapId(
                        $wohneinheit->WohneinheitID,
                        $type,
                        $mietobjekt[$key]
                    );
                }
            }
        }
    }

    /**
     * @throws Throwable
     */
    private function processMieter(Ceos_LIEGENSCHAFT $liegenschaft, array $mieters): void
    {
        foreach ($mieters as $receivedMieter) {

            $mieter = Ceos_MIETER::firstOrCreate(
                ['MI_COMP_API_ID' => $receivedMieter['partner']],
                ['User' => 0]
            );

            $gebaeude = $this->findGebaeude($liegenschaft, $receivedMieter['genrCeos']);

            $wohneinheit = $this->findWohneinheit(
                $liegenschaft,
                $gebaeude,
                $receivedMieter['menrCeos']
            );

            if (!$wohneinheit) continue;

            $apiData = [
                'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                'WohneinheitID' => $wohneinheit->WohneinheitID,
                'MieterID' => $mieter->MieterID,
                'lfd_Adressnummer_GE_CEOS' => $receivedMieter['genrCeos'],
                'lfd_Adressnummer_ME_CEOS' => $receivedMieter['menrCeos'],
                'Mietvertragsnummer' => $receivedMieter['recnnr'],
                'M_Name1' => $receivedMieter['mName'],
                'M_Anrede' => $receivedMieter['mAnrede'],
                'DatumVon' => $receivedMieter['datumEinzug'],
                'DatumBis' => $this->normalizeValidTo($receivedMieter['datumAuszug'] ?? null),
                'User' => 1,
            ];

            DB::transaction(function () use ($apiData) {

                // ===== HISTORICAL RECORD =====
                if ($apiData['DatumBis'] !== '9999-12-31') {

                    $lastTenantRecord = $this->findLastTenantRecord($apiData);

                    if ($lastTenantRecord) {

                        if (
                            $apiData['DatumVon'] == $lastTenantRecord->DatumVon &&
                            $apiData['DatumBis'] == $lastTenantRecord->DatumBis &&
                            $this->isIdentical($lastTenantRecord, $apiData)
                        ) {
                            return;
                        }

                        $newData = array_merge(
                            $this->extractBase($lastTenantRecord),
                            $apiData
                        );

                        Ceos_MIETER_TimeLine::create($newData);
                        return;
                    }

                    Ceos_MIETER_TimeLine::create($apiData);
                    return;
                }

                // ===== CURRENT STATE =====
                $last = Ceos_MIETER_TimeLine::where('WohneinheitID', $apiData['WohneinheitID'])
                    ->where('DatumBis', '9999-12-31')
                    ->orderByDesc('ID')
                    ->first();

                if (!$last) {
                    Ceos_MIETER_TimeLine::create($apiData);
                    return;
                }

                // CASE 1 — identical
                if ($this->isIdentical($last, $apiData)) {
                    return;
                }

                // CASE 4 — different tenant
                if ($last->MieterID != $apiData['MieterID']) {

                    $lastTenantRecord = $this->findLastTenantRecord($apiData);

                    $base = $lastTenantRecord
                        ? $this->extractBase($lastTenantRecord)
                        : [];

                    Ceos_MIETER_TimeLine::create(array_merge($base, $apiData));
                    return;
                }

                // CASE 3 — same tenant, new period
                if ($last->MieterID == $apiData['MieterID']) {

                    Ceos_MIETER_TimeLine::create(
                        array_merge($this->extractBase($last), $apiData)
                    );

                    return;
                }

                // CASE 2 — correction
                $samePeriod = Ceos_MIETER_TimeLine::where([
                    'LiegenschaftsID' => $apiData['LiegenschaftsID'],
                    'WohneinheitID' => $apiData['WohneinheitID'],
                    'MieterID' => $apiData['MieterID'],
                    'DatumVon' => $apiData['DatumVon'],
                    'DatumBis' => $apiData['DatumBis'],
                ])->orderByDesc('ID')->first();

                if ($samePeriod) {
                    Ceos_MIETER_TimeLine::create(
                        array_merge($this->extractBase($samePeriod), $apiData)
                    );
                }
            });
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

    private function findLastTenantRecord(array $apiData): \Eloquent|Ceos_MIETER_TimeLine|\Illuminate\Database\Eloquent\Builder|null
    {
        return Ceos_MIETER_TimeLine::where([
            'LiegenschaftsID' => $apiData['LiegenschaftsID'],
            'WohneinheitID' => $apiData['WohneinheitID'],
            'MieterID' => $apiData['MieterID'],
        ])->orderByDesc('ID')->first();
    }

    private function isIdentical($record, array $apiData): bool
    {
        foreach ($apiData as $field => $value) {
            if ($record->$field != $value) {
                return false;
            }
        }
        return true;
    }

    private function extractBase($record): array
    {
        $base = $record->toArray();
        unset($base['ID'], $base['DateStamp'], $base['TimeStamp']);
        return $base;
    }

    /**
     * @throws Throwable
     */
    private function processAbrechnungen(Ceos_LIEGENSCHAFT $liegenschaft, array $abrechnungsdaten): void
    {
        foreach ($abrechnungsdaten as $receivedAbrechnung) {

            DB::transaction(function () use ($liegenschaft, $receivedAbrechnung) {

                // -------------------------------------------------
                // Abrechnung master
                // -------------------------------------------------
                $abrechnung = Ceos_ABRECHNUNG::firstOrCreate(
                    ['ABR_COMP_API_ID' => $liegenschaft->Liegenschaftsnummer],
                    ['User' => 0]
                );

                // -------------------------------------------------
                // API data
                // -------------------------------------------------
                $apiData = [
                    'AbrechnungID' => $abrechnung->AbrechnungID,
                    'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                    'DatumVon' => $receivedAbrechnung['datab'],
                    'DatumBis' => $this->normalizeValidTo($receivedAbrechnung['datbi'] ?? null),
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
                    'User' => 1,
                ];

                // =================================================
                // HISTORICAL RECORD (closed period)
                // =================================================
                if ($apiData['DatumBis'] !== '9999-12-31') {

                    // Check duplicate by period
                    $exists = Ceos_ABRECHNUNG_TimeLine::where([
                        'LiegenschaftsID' => $apiData['LiegenschaftsID'],
                        'DatumVon' => $apiData['DatumVon'],
                        'DatumBis' => $apiData['DatumBis'],
                    ])->exists();

                    if ($exists) {
                        return;
                    }

                    // Find last record for this property
                    $lastRecord = Ceos_ABRECHNUNG_TimeLine::where(
                        'LiegenschaftsID',
                        $apiData['LiegenschaftsID']
                    )->orderByDesc('ID')->first();

                    if ($lastRecord) {

                        $base = $lastRecord->toArray();

                        unset(
                            $base['ID'],
                            $base['DateStamp'],
                            $base['TimeStamp'],
                            $base['FULL_HASH']
                        );

                        $newData = array_merge($base, $apiData);

                        Ceos_ABRECHNUNG_TimeLine::create($newData);
                        return;
                    }

                    // No history → insert as is
                    Ceos_ABRECHNUNG_TimeLine::create($apiData);
                    return;
                }

                // =================================================
                // CURRENT STATE = latest open record
                // =================================================
                $last = Ceos_ABRECHNUNG_TimeLine::where('LiegenschaftsID', $apiData['LiegenschaftsID'])
                    ->where('DatumBis', '9999-12-31')
                    ->orderByDesc('ID')
                    ->first();

                // -------------------------------------------------
                // No history → insert
                // -------------------------------------------------
                if (!$last) {
                    Ceos_ABRECHNUNG_TimeLine::create($apiData);
                    return;
                }

                // =================================================
                // CASE 1 — identical current state
                // =================================================
                $identical = true;

                foreach ($apiData as $field => $value) {
                    if ($last->$field != $value) {
                        $identical = false;
                        break;
                    }
                }

                if ($identical) {
                    return;
                }

                // =================================================
                // CASE 3/4 — copy previous data
                // =================================================
                $base = $last->toArray();

                unset(
                    $base['ID'],
                    $base['DateStamp'],
                    $base['TimeStamp'],
                    $base['FULL_HASH']
                );

                $newData = array_merge($base, $apiData);

                Ceos_ABRECHNUNG_TimeLine::create($newData);
            });
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
