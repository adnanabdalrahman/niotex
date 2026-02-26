<?php

namespace App\Services\REServices;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Adresse;
use App\Models\Ceos_ABRECHNUNG;
use App\Models\Ceos_ABRECHNUNG_TimeLine;
use App\Models\Ceos_GEBAEUDE;
use App\Models\Ceos_GEBAEUDE_TimeLine;
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

class RE_01_01_Services_last_ohneCopy
{
    private array $importedGebaeude = [];
    private array $importedVerwaltungen = [];
    private array $importedWohneinheiten = [];
    private array $importedAbrechnungen = [];
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
        $this->importGebaeude($liegenschaft, $data['adressen']);
        $this->processMieter0($liegenschaft, $data);
        $this->importKunden($liegenschaft, $data['kunden'] ?? []);
        $this->importMietobjekte($liegenschaft, $data['mietobjekte'] ?? []);
        $this->processMieter($liegenschaft, $data['mieter']);
        $this->importAbrechnungen($liegenschaft, $data['abrechnungsdaten'], $data['lgart']);
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
                'MDM_LG' => $data['mdmId'],
                'Fernablesung_JN' => $data['fern'],
                'Fernablesung_Ab' => $data['fernAb'],
                'OnlinePortal_JN' => $data['opk'],
                'OnlinePortal_Ab' => $data['opkAb'],
                'UviReady_JN' => $data['uvir'],
                'UviReady_Ab' => $data['uvirAb'],
                'Mdf' => $data['mdf'],
                'Mdf_Bis' => $data['mdfBis'],
                'Vertreter' => $kunden[0]['vtrCeos'] ?? null,
                'LG_KORR_Nr' => $data['lgnrExt'],
                'DatumVon' => $data['validfrom'],
                'DatumBis' => $this->normalizeValidTo($data['validto'] ?? null),
                'User' => 1,
            ];

            // =================================================
            // HISTORICAL RECORD (closed period)
            // =================================================
            if ($apiData['DatumBis'] !== '9999-12-31') {
                // Duplicate check by period
                $exists = Ceos_LIEGENSCHAFT_TimeLine::where([
                    'LiegenschaftsID' => $apiData['LiegenschaftsID'],
                    'DatumVon' => $apiData['DatumVon'],
                    'DatumBis' => $apiData['DatumBis'],
                ])->exists();

                if ($exists) {
                    return;
                }

                // INSERT API DATA ONLY (no copy)
                Ceos_LIEGENSCHAFT_TimeLine::create($apiData);
                return;
            }

            // =================================================
            // CURRENT STATE = latest open record
            // =================================================
            $last = Ceos_LIEGENSCHAFT_TimeLine::where(
                'LiegenschaftsID',
                $apiData['LiegenschaftsID']
            )
                ->where('DatumBis', '9999-12-31')
                ->orderByDesc('ID')
                ->first();

            // No history → insert
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
            // CASE 3/4 — INSERT NEW RECORD WITHOUT COPY
            // =================================================
            Ceos_LIEGENSCHAFT_TimeLine::create($apiData);
        });
    }

    private function normalizeValidTo(?string $date): string
    {
        if (!$date || $date === '0000-00-00') {
            return '9999-12-31';
        }
        return $date;
    }

    /**
     * @throws Throwable
     */
    private function importGebaeude(Ceos_LIEGENSCHAFT $liegenschaft, array $adressen): void
    {
        // Reset imported list for this property
        $this->importedGebaeude = [];

        // Process incoming buildings
        $this->processGebaeude($liegenschaft, $adressen);

        // Close buildings missing from API snapshot
        $this->closeMissingGebaeude($liegenschaft->LiegenschaftsID);
    }

    /**
     * @throws Throwable
     */
    private function processGebaeude(Ceos_LIEGENSCHAFT $liegenschaft, array $adressen): void
    {
        foreach ($adressen as $adresse) {
            $gebaeude = Ceos_GEBAEUDE::firstOrCreate(
                [
                    'GEB_COMP_API_ID' =>
                        $liegenschaft->Liegenschaftsnummer . '-' .
                        $adresse['genrCeos']
                ],
                ['User' => 0]
            );
            $this->importedGebaeude[] = $gebaeude->GebaeudeID;
            DB::transaction(function () use ($liegenschaft, $adresse, $gebaeude) {
                $apiData = [
                    'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                    'GebaeudeID' => $gebaeude->GebaeudeID,
                    'GebaeudeNr' => $adresse['genrCeos'],
                    'MDM_GEB' => $adresse['mdmId'],
                    'LG_Strasse' => $adresse['lgStr'],
                    'GEB_TPlatz' => $adresse['tplnr'],
                    'LG_PLZ' => $adresse['lgPlz'],
                    'LG_Ort' => $adresse['lgOrt'],
                    'LAND' => 'DE',
                    'Heizanlage_JN' => $adresse['hausHeizanlage'] ?? 0,
                    'DatumVon' => $adresse['validfrom'],
                    'DatumBis' => $this->normalizeValidTo($adresse['validto'] ?? null),
                    'Geloescht_JN' => 0,
                    'User' => 1,
                ];

                $last = Ceos_GEBAEUDE_TimeLine::where([
                    'LiegenschaftsID' => $apiData['LiegenschaftsID'],
                    'GebaeudeID' => $apiData['GebaeudeID'],
                ])
                    ->orderByDesc('ID')
                    ->first();

                // =================================================
                // No history → insert
                // =================================================
                if (!$last) {
                    Ceos_GEBAEUDE_TimeLine::create($apiData);
                    return;
                }
                // =================================================
                // Reactivation (was deleted)
                // =================================================
                if ($last->Geloescht_JN == 1) {
                    Ceos_GEBAEUDE_TimeLine::create($apiData);
                    return;
                }
                // =================================================
                // Identical → ignore
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
                // Changed → new snapshot
                // =================================================
                Ceos_GEBAEUDE_TimeLine::create($apiData);
            });
        }
    }

    private function closeMissingGebaeude(int $liegenschaftID): void
    {
        $latestRecords = Ceos_GEBAEUDE_TimeLine::where('LiegenschaftsID', $liegenschaftID)
            ->orderByDesc('ID')
            ->get()
            ->unique('GebaeudeID');

        foreach ($latestRecords as $last) {

            // Skip buildings received in API
            if (in_array($last->GebaeudeID, $this->importedGebaeude)) {
                continue;
            }

            // Skip if already deleted
            if ($last->Geloescht_JN == 1) {
                continue;
            }

            // Create new deleted snapshot
            $base = $last->toArray();

            unset(
                $base['ID'],
                $base['DateStamp'],
                $base['TimeStamp'],
                $base['FULL_HASH']
            );

            $base['Geloescht_JN'] = 1;
            $base['User'] = 1;

            Ceos_GEBAEUDE_TimeLine::create($base);
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
            'MDM_WE' => null,
            'WE_LfdNr' => 0,
            'WE_Bezeichnung' => 'Allgemein',
            'Gewerblich_JN' => 0,
            'DatumVon' => '1900-01-01',
            'DatumBis' => '9999-12-31',
            'User' => 1,
        ]],
            ['LiegenschaftsID', 'WohneinheitID'],
            ['DatumBis', 'WE_Bezeichnung', 'Gewerblich_JN', 'User']
        );

        $mieter = Ceos_MIETER::updateOrCreate(
            ['MI_COMP_API_ID' => $data['slgnr'] . '-0-0-0'],
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
            'DatumVon' => '1900-01-01',
            'DatumBis' => '9999-12-31',
            'User' => 1,
        ]],
            ['LiegenschaftsID', 'WohneinheitID', 'MieterID'],
            ['DatumBis', 'M_Name1', 'M_Anrede', 'User']
        );
    }

    private function findGebaeude(Ceos_LIEGENSCHAFT $liegenschaft, int $nr): ?Ceos_GEBAEUDE_TimeLine
    {
        // Try active timeline
        $timeline = Ceos_GEBAEUDE_TimeLine::where('GebaeudeNr', $nr)
            ->where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
            ->where('DatumBis', '9999-12-31')
            ->orderByDesc('DatumVon')
            ->orderByDesc('ID')
            ->first();

        if ($timeline) {
            return $timeline;
        }

        // Fallback to master (if exists)
        $master = Ceos_GEBAEUDE::where(
            'GEB_COMP_API_ID',
            $liegenschaft->Liegenschaftsnummer . '-' . $nr
        )->first();

        if (!$master) {
            return null;
        }

        // Return latest timeline even if closed
        return Ceos_GEBAEUDE_TimeLine::where(
            'GebaeudeID',
            $master->GebaeudeID
        )
            ->orderByDesc('ID')
            ->first();
    }

    /**
     * @throws Throwable
     */
    private function importKunden(Ceos_LIEGENSCHAFT $liegenschaft, array $kunden): void
    {
        // Reset imported list
        $this->importedVerwaltungen = [];
        // Process incoming
        $this->processKunden($liegenschaft, $kunden);
        // Close missing
        $this->closeMissingKunden($liegenschaft->LiegenschaftsID);
    }

    /**
     * @throws Throwable
     */
    private function processKunden(Ceos_LIEGENSCHAFT $liegenschaft, array $kunden): void
    {
        foreach ($kunden as $kunde) {
            DB::transaction(function () use ($liegenschaft, $kunde) {
                $verwaltung = Ceos_VERWALTUNG::firstOrCreate(
                    ['VER_FOREIGN_ID' => $kunde['kunnr']],
                    ['User' => 0]
                );

                $this->importedVerwaltungen[] = $verwaltung->VerwaltungID;
                $adressnummer = ltrim($kunde['kunnr'], '0');
                $adresse = Adresse::where('AdressNummer', $adressnummer)->first();

                if (!$adresse) {
                    //$this->logMissing(['adressnummer' => $adressnummer]);
                    throw new ResourceNotFoundException('Adresse nicht gefunden', ['adressnummer' => $adressnummer]);
                }
                $apiData = [
                    'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                    'VerwaltungID' => $verwaltung->VerwaltungID,
                    'AuftraggeberID' => $adresse->InterneAdressnummer,
                    'Kundenart' => $kunde['kdart'],
                    'ErsteAbr' => $kunde['abrfirst'],
                    'LetzteAbr' => $kunde['abrlast'],
                    'DatumVon' => $kunde['validfrom'],
                    'DatumBis' => $this->normalizeValidTo($kunde['validto'] ?? null),
                    'Geloescht_JN' => 0,
                    'User' => 1,
                ];

                $last = Ceos_VERWALTUNG_TimeLine::where([
                    'LiegenschaftsID' => $apiData['LiegenschaftsID'],
                    'VerwaltungID' => $apiData['VerwaltungID'],
                ])
                    ->orderByDesc('ID')
                    ->first();

                // ===== No history =====
                if (!$last) {
                    Ceos_VERWALTUNG_TimeLine::create($apiData);
                    return;
                }

                // ===== Reactivation =====
                if ($last->Geloescht_JN == 1) {
                    Ceos_VERWALTUNG_TimeLine::create($apiData);
                    return;
                }

                // ===== Identical → ignore =====
                foreach ($apiData as $field => $value) {
                    if ($last->$field != $value) {
                        Ceos_VERWALTUNG_TimeLine::create($apiData);
                        return;
                    }
                }

                // identical → do nothing
            });
        }
    }

    private function closeMissingKunden(int $liegenschaftID): void
    {
        $latestRecords = Ceos_VERWALTUNG_TimeLine::where('LiegenschaftsID', $liegenschaftID)
            ->orderByDesc('ID')
            ->get()
            ->unique('VerwaltungID');
        foreach ($latestRecords as $last) {
            // Skip imported
            if (in_array(
                $last->VerwaltungID,
                $this->importedVerwaltungen
            )) {
                continue;
            }

            // Skip already deleted
            if ($last->Geloescht_JN == 1) {
                continue;
            }

            $base = $last->toArray();
            unset(
                $base['ID'],
                $base['DateStamp'],
                $base['TimeStamp'],
                $base['FULL_HASH']
            );

            $base['Geloescht_JN'] = 1;
            $base['User'] = 1;

            Ceos_VERWALTUNG_TimeLine::create($base);
        }
    }

    /**
     * @throws Throwable
     */
    private function importMietobjekte(Ceos_LIEGENSCHAFT $liegenschaft, array $mietobjekte): void
    {
        // Reset imported list for this property
        $this->importedWohneinheiten = [];
        // Process incoming units
        $this->processMietobjekte($liegenschaft, $mietobjekte);
        // Close units missing from API snapshot
        $this->closeMissingMietobjekte($liegenschaft->LiegenschaftsID);
    }

    /**
     * @throws Throwable
     */
    private function processMietobjekte(Ceos_LIEGENSCHAFT $liegenschaft, array $mietobjekte): void
    {
        foreach ($mietobjekte as $mietobjekt) {
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

            $gebaeude = $this->findGebaeude(
                $liegenschaft,
                $mietobjekt['genrCeos']
            );

            if (!$gebaeude) {
                Log::warning("re_01_01_Liegenschaften: Mietobjekte nicht gefunden", $gebaeude['genrCeos']);
                continue;
                //throw new ResourceNotFoundException('Gebaeude nicht gefunden', ['Gebaeude' => $mietobjekt['genrCeos']]);
            }

            DB::transaction(function () use (
                $liegenschaft,
                $mietobjekt,
                $wohneinheit,
                $gebaeude
            ) {

                $apiData = [
                    'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                    'GebaeudeID' => $gebaeude->GebaeudeID,
                    'WohneinheitID' => $wohneinheit->WohneinheitID,
                    'lfd_Adressnummer_GE_CEOS' => $mietobjekt['genrCeos'],
                    'WE_LfdNr' => $mietobjekt['menrCeos'],
                    'WE_Bezeichnung' => $mietobjekt['mLageBez'],
                    'Lage' => $mietobjekt['mLage'],
                    'Gewerblich_JN' => $mietobjekt['gewerblichJn'],
                    'Garage_JN' => $mietobjekt['garageJn'],
                    'Wohn_Flaeche' => $mietobjekt['wohnFl'],
                    'Heizung_Flaeche' => $mietobjekt['heizFl'],
                    'WW_Flaeche' => $mietobjekt['wwFl'],
                    'WE_HK_KORR_Nr' => $mietobjekt['korrnrHk'],
                    'WE_KW_KORR_Nr' => $mietobjekt['korrnrKw'],
                    'WE_TPlatz' => $mietobjekt['tplnr'],
                    'MDM_WE' => $mietobjekt['mdmIdMe'],
                    'DatumVon' => $mietobjekt['validfrom'],
                    'DatumBis' => $this->normalizeValidTo($mietobjekt['validto'] ?? null),
                    'Geloescht_JN' => 0,
                    'User' => 1,
                ];

                $last = Ceos_WOHNEINHEIT_TimeLine::where([
                    'LiegenschaftsID' => $apiData['LiegenschaftsID'],
                    'WohneinheitID' => $apiData['WohneinheitID'],
                ])
                    ->orderByDesc('ID')
                    ->first();

                // =================================================
                // No history → insert
                // =================================================
                if (!$last) {
                    Ceos_WOHNEINHEIT_TimeLine::create($apiData);
                    return;
                }

                // =================================================
                // Reactivation (was deleted)
                // =================================================
                if ($last->Geloescht_JN == 1) {
                    Ceos_WOHNEINHEIT_TimeLine::create($apiData);
                    return;
                }

                // =================================================
                // Identical → ignore
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
                // Changed → new snapshot
                // =================================================
                Ceos_WOHNEINHEIT_TimeLine::create($apiData);
            });
        }
    }

    private function closeMissingMietobjekte(int $liegenschaftID): void
    {
        $latestRecords = Ceos_WOHNEINHEIT_TimeLine::where(
            'LiegenschaftsID',
            $liegenschaftID
        )
            ->orderByDesc('ID')
            ->get()
            ->unique('WohneinheitID');

        foreach ($latestRecords as $last) {
            // Ignore Allgemein
            if ($last->WE_LfdNr == 0) {
                continue;
            }

            // Skip imported units
            if (in_array($last->WohneinheitID, $this->importedWohneinheiten)) {
                continue;
            }

            // Only if currently active
            if ($last->Geloescht_JN == 1) {
                continue;
            }
            $base = $last->toArray();
            unset(
                $base['ID'],
                $base['DateStamp'],
                $base['TimeStamp'],
                $base['FULL_HASH']
            );
            $base['Geloescht_JN'] = 1;
            $base['User'] = 1;

            Ceos_WOHNEINHEIT_TimeLine::create($base);
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
            if (!$wohneinheit) {
                Log::warning("re_01_01_Liegenschaften: Mietobjekte nicht gefunden", $receivedMieter['menrCeos']);
                continue;
//                throw new ResourceNotFoundException('Mietobjekte nicht gefunden',
//                    ['Mietobjekt' => $receivedMieter['menrCeos']]);
            }

            $apiData = [
                'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                'WohneinheitID' => $wohneinheit->WohneinheitID,
                'MieterID' => $mieter->MieterID,
                'lfd_Adressnummer_GE_CEOS' => $receivedMieter['genrCeos'],
                'lfd_Adressnummer_ME_CEOS' => $receivedMieter['menrCeos'],
                'Mietvertragsnummer' => $receivedMieter['recnnr'],
                'M_Name1' => $receivedMieter['mName'],
                'M_Anrede' => $receivedMieter['mAnrede'],
                'MDM_MI' => $receivedMieter['mdmIdCn'],
                'DatumVon' => $receivedMieter['datumEinzug'],
                'DatumBis' => $this->normalizeValidTo($receivedMieter['datumAuszug'] ?? null),
                'User' => 1,
            ];

            DB::transaction(function () use ($apiData) {
                // ===== HISTORICAL RECORD =====
                if ($apiData['DatumBis'] !== '9999-12-31') {

                    $exists = Ceos_MIETER_TimeLine::where([
                        'LiegenschaftsID' => $apiData['LiegenschaftsID'],
                        'WohneinheitID' => $apiData['WohneinheitID'],
                        'MieterID' => $apiData['MieterID'],
                        'DatumVon' => $apiData['DatumVon'],
                        'DatumBis' => $apiData['DatumBis'],
                    ])->orderByDesc('ID')->first();
                    if ($exists && $this->isIdentical($exists, $apiData)) {
                        return;
                    }
                    // NO COPY — insert API snapshot
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

                // CASE 2 — correction (same tenant + same period)
                if (
                    $last->MieterID == $apiData['MieterID'] &&
                    $last->DatumVon == $apiData['DatumVon'] &&
                    $last->DatumBis == $apiData['DatumBis']
                ) {
                    Ceos_MIETER_TimeLine::create($apiData);
                    return;
                }
                // CASE 4 — different tenant
                if ($last->MieterID != $apiData['MieterID']) {
                    Ceos_MIETER_TimeLine::create($apiData);
                    return;
                }
                // CASE 3 — same tenant, new period
                Ceos_MIETER_TimeLine::create($apiData);
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
            ->where('DatumBis', '9999-12-31')
            ->orderByDesc('ID')
            ->first();
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

    /**
     * @throws Throwable
     */
    private function importAbrechnungen(Ceos_LIEGENSCHAFT $liegenschaft, array $abrechnungsdaten, $lgart): void
    {
        // Reset imported list for this property
        $this->importedAbrechnungen = [];

        // Process incoming records
        $this->processAbrechnungen(
            $liegenschaft,
            $abrechnungsdaten,
            $lgart
        );
        // Close records missing from API snapshot
        $this->closeMissingAbrechnungen(
            $liegenschaft->LiegenschaftsID
        );
    }

    /**
     * @throws Throwable
     */
    private function processAbrechnungen(Ceos_LIEGENSCHAFT $liegenschaft, array $abrechnungsdaten, $lgart): void
    {
        foreach ($abrechnungsdaten as $receivedAbrechnung) {
            DB::transaction(function () use ($liegenschaft, $receivedAbrechnung, $lgart) {
                // ===== Master =====
                $abrechnung = Ceos_ABRECHNUNG::firstOrCreate(
                    ['ABR_COMP_API_ID' => $liegenschaft->Liegenschaftsnummer],
                    ['User' => 0]
                );
                $this->importedAbrechnungen[] = $abrechnung->AbrechnungID;
                // ===== API Snapshot =====
                $apiData = [
                    'AbrechnungID' => $abrechnung->AbrechnungID,
                    'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                    'DatumVon' => $receivedAbrechnung['datab'],
                    'DatumBis' => $this->normalizeValidTo($receivedAbrechnung['datbi'] ?? null),
                    'Stichtag_HKA' => $this->formatTo1900Date($receivedAbrechnung['sttHka']),
                    'Stichtag_KWA' => $this->formatTo1900Date($receivedAbrechnung['sttKwa']),
                    'Stichtag_NKA' => $this->formatTo1900Date($receivedAbrechnung['sttNka']),
                    'Stichtag_STA' => $this->formatTo1900Date($receivedAbrechnung['sttSta']),
                    'Heizung_JN' => $receivedAbrechnung['hka'],
                    'Liegenschaft_Art' => $lgart,
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
                    'Geloescht_JN' => 0,
                    'User' => 1,
                ];

                // =================================================
                // HISTORICAL RECORD (closed period)
                // =================================================
                if ($apiData['DatumBis'] !== '9999-12-31') {

                    // Duplicate check by period
                    $exists = Ceos_ABRECHNUNG_TimeLine::where([
                        'LiegenschaftsID' => $apiData['LiegenschaftsID'],
                        'AbrechnungID' => $apiData['AbrechnungID'],
                        'DatumVon' => $apiData['DatumVon'],
                        'DatumBis' => $apiData['DatumBis'],
                    ])->exists();

                    if ($exists) {
                        return;
                    }

                    // Insert historical snapshot
                    Ceos_ABRECHNUNG_TimeLine::create($apiData);
                    return;
                }

                // =================================================
                // CURRENT STATE (open period)
                // =================================================
                $last = Ceos_ABRECHNUNG_TimeLine::where([
                    'LiegenschaftsID' => $apiData['LiegenschaftsID'],
                    'AbrechnungID' => $apiData['AbrechnungID'],
                ])
                    ->where('DatumBis', '9999-12-31')
                    ->orderByDesc('ID')
                    ->first();

                // No history → insert
                if (!$last) {
                    Ceos_ABRECHNUNG_TimeLine::create($apiData);
                    return;
                }

                // Reactivation
                if ($last->Geloescht_JN == 1) {
                    Ceos_ABRECHNUNG_TimeLine::create($apiData);
                    return;
                }

                // Identical → ignore
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

                // Changed → new snapshot
                Ceos_ABRECHNUNG_TimeLine::create($apiData);
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

    private function closeMissingAbrechnungen(int $liegenschaftID): void
    {
        $latestRecords = Ceos_ABRECHNUNG_TimeLine::where('LiegenschaftsID', $liegenschaftID)
            ->orderByDesc('ID')
            ->get()
            ->unique('AbrechnungID');
        foreach ($latestRecords as $last) {
            // Skip imported in this run
            if (in_array($last->AbrechnungID, $this->importedAbrechnungen)) {
                continue;
            }
            // Already deleted
            if ($last->Geloescht_JN == 1) {
                continue;
            }
            // Create deleted snapshot
            $base = $last->toArray();
            unset(
                $base['ID'],
                $base['DateStamp'],
                $base['TimeStamp'],
                $base['FULL_HASH']
            );
            $base['Geloescht_JN'] = 1;
            $base['User'] = 1;
            Ceos_ABRECHNUNG_TimeLine::create($base);
        }
    }


}
