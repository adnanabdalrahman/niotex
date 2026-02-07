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

class RE_01_01_Services_V3
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

            // Prepare API data
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
                'DatumBis' => $data['validto'],
                'User' => 1,
            ];

            $newDatumVon = $apiData['DatumVon'];

            // Check if a record with the same DatumVon exists
            $existing = Ceos_LIEGENSCHAFT_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                ->where('DatumVon', $newDatumVon)
                ->orderByDesc('ID')
                ->first();

            $sameDatumVonButDifferent = false;

            if ($existing) {
                $isIdentical = true;

                foreach ($apiData as $key => $value) {
                    if (in_array($key, ['DatumVon', 'DatumBis', 'User'])) {
                        continue;
                    }
                    if ($existing->$key != $value) {
                        $isIdentical = false;
                        break;
                    }
                }

                // Same DatumVon and identical data
                if ($isIdentical) {
                    return;
                }

                // Same DatumVon but different data
                $sameDatumVonButDifferent = true;
            }

            // Close all overlapping records except same DatumVon case
            if (!$sameDatumVonButDifferent) {
                $overlappingRecords = Ceos_LIEGENSCHAFT_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                    ->where('DatumBis', '>=', $newDatumVon)
                    ->lockForUpdate()
                    ->get();

                foreach ($overlappingRecords as $record) {
                    if ($record->DatumVon != $newDatumVon) {
                        $record->update([
                            'DatumBis' => date(
                                'Y-m-d',
                                strtotime($newDatumVon . ' -1 day')
                            ),
                        ]);
                    }
                }
            }

            // Find previous record strictly before new DatumVon for data copy
            $previous = Ceos_LIEGENSCHAFT_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                ->where('DatumVon', '<=', $newDatumVon)
                ->orderByDesc('DatumVon')
                ->orderByDesc('ID')
                ->first();

            // Prepare new record by copying previous data
            $newData = $previous ? $previous->toArray() : [];
            unset(
                $newData['ID'],
                $newData['FULL_HASH'],
                $newData['DateStamp'],
                $newData['TimeStamp']
            );

            // Merge API data into copied data
            $newData = array_merge($newData, $apiData);

            // Create new timeline record
            Ceos_LIEGENSCHAFT_TimeLine::create($newData);
        });

        // Create SAP ID if provided
        if (!empty($data['lgnrExt'])) {
            $this->createSapId(
                $liegenschaft->LiegenschaftsID,
                'LG_KORR_Nr',
                $data['lgnrExt']
            );
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
        foreach ($adressen as $adresse) {

            // Create or get building master record
            $gebaeude = Ceos_GEBAEUDE::firstOrCreate(
                ['GEB_COMP_API_ID' => $liegenschaft->Liegenschaftsnummer . '-' . $adresse['genrCeos']],
                ['User' => 0]
            );

            $this->importedGebaeude[] = $gebaeude->GebaeudeID;

            // Prepare API data
            $apiData = [
                'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                'GebaeudeID' => $gebaeude->GebaeudeID,
                'GebaeudeNr' => $adresse['genrCeos'],
                'MDM' => $adresse['mdmId'],
                'LG_Strasse' => $adresse['lgStr'],
                'LG_PLZ' => $adresse['lgPlz'],
                'LG_Ort' => $adresse['lgOrt'],
                'Heizanlage_JN' => $adresse['hausHeizanlage'],
                'DatumVon' => $adresse['validfrom'],
                'DatumBis' => $adresse['validto'],
                'User' => 1,
            ];

            $newDatumVon = $apiData['DatumVon'];

            // Check if a record with the same DatumVon exists
            $existing = Ceos_GEBAEUDE_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                ->where('GebaeudeNr', $adresse['genrCeos'])
                ->where('DatumVon', $newDatumVon)
                ->orderByDesc('ID')
                ->first();

            $sameDatumVonButDifferent = false;

            if ($existing) {
                $isIdentical = true;

                foreach ($apiData as $key => $value) {
                    if (in_array($key, ['DatumVon', 'DatumBis', 'User'])) {
                        continue;
                    }
                    if ($existing->$key != $value) {
                        $isIdentical = false;
                        break;
                    }
                }

                // Same DatumVon and identical data
                if ($isIdentical) {
                    continue;
                }

                // Same DatumVon but different data
                $sameDatumVonButDifferent = true;
            }

            // Close all overlapping records except same DatumVon case
            if (!$sameDatumVonButDifferent) {
                $overlappingRecords = Ceos_GEBAEUDE_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                    ->where('GebaeudeNr', $adresse['genrCeos'])
                    ->where('DatumBis', '>=', $newDatumVon)
                    ->lockForUpdate()
                    ->get();

                foreach ($overlappingRecords as $record) {
                    if ($record->DatumVon != $newDatumVon) {
                        $record->update([
                            'DatumBis' => date(
                                'Y-m-d',
                                strtotime($newDatumVon . ' -1 day')
                            ),
                        ]);
                    }
                }
            }

            // Find previous record strictly before new DatumVon for copy
            $previous = Ceos_GEBAEUDE_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                ->where('GebaeudeNr', $adresse['genrCeos'])
                ->where('DatumVon', '<=', $newDatumVon)
                ->orderByDesc('DatumVon')
                ->orderByDesc('ID')
                ->first();

            // Prepare new record by copying previous data
            $newData = $previous ? $previous->toArray() : [];
            unset(
                $newData['ID'],
                $newData['FULL_HASH'],
                $newData['DateStamp'],
                $newData['TimeStamp']
            );

            // Merge API data
            $newData = array_merge($newData, $apiData);

            // Create new timeline row
            Ceos_GEBAEUDE_TimeLine::create($newData);

            // Create SAP ID if provided
            if (!empty($adresse['tplnr'])) {
                $this->createSapId(
                    $gebaeude->GebaeudeID,
                    'GEB_TPlatz',
                    $adresse['tplnr']
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
            'DatumBis' => '99991231',
            'User' => 1,
        ]],
            ['LiegenschaftsID', 'WE_LfdNr', 'DatumVon'],
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


    private function processKunden(Ceos_LIEGENSCHAFT $liegenschaft, array $kunden): void
    {
        foreach ($kunden as $kunde) {
            // Create or get Verwaltung master record
            $verwaltung = Ceos_VERWALTUNG::firstOrCreate(
                ['VER_FOREIGN_ID' => $kunde['kunnr']],
                ['User' => 0]
            );

            // Resolve address
            $adressnummer = ltrim($kunde['kunnr'], '0');
            $adresse = Adresse::where('AdressNummer', $adressnummer)->first();

            if (!$adresse) {
                $this->logMissing('Kein Adresse gefunden', ['adressnummer' => $adressnummer]);
                continue;
            }

            // Prepare API data
            $apiData = [
                'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                'VerwaltungID' => $verwaltung->VerwaltungID,
                'AuftraggeberID' => $adresse->InterneAdressnummer,
                'Kundenart' => $kunde['kdart'],
                'ErsteAbr' => $kunde['abrfirst'],
                'LetzteAbr' => $kunde['abrlast'],
                'DatumVon' => $kunde['validfrom'],
                'DatumBis' => $kunde['validto'],
                'User' => 1,
            ];

            $newDatumVon = $apiData['DatumVon'];

            // Check if a record with the same DatumVon exists
            $existing = Ceos_VERWALTUNG_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                ->where('VerwaltungID', $verwaltung->VerwaltungID)
                ->where('DatumVon', $newDatumVon)
                ->orderByDesc('ID')
                ->first();

            $sameDatumVonButDifferent = false;

            if ($existing) {
                $isIdentical = true;

                foreach ($apiData as $key => $value) {
                    if (in_array($key, ['DatumVon', 'DatumBis', 'User'])) {
                        continue;
                    }
                    if ($existing->$key != $value) {
                        $isIdentical = false;
                        break;
                    }
                }

                // Same DatumVon and identical data
                if ($isIdentical) {
                    continue;
                }

                // Same DatumVon but different data
                $sameDatumVonButDifferent = true;
            }

            // Close all overlapping records except same DatumVon case
            if (!$sameDatumVonButDifferent) {
                $overlappingRecords = Ceos_VERWALTUNG_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                    ->where('VerwaltungID', $verwaltung->VerwaltungID)
                    ->where('DatumBis', '>=', $newDatumVon)
                    ->lockForUpdate()
                    ->get();

                foreach ($overlappingRecords as $record) {
                    if ($record->DatumVon != $newDatumVon) {
                        $record->update([
                            'DatumBis' => date(
                                'Y-m-d',
                                strtotime($newDatumVon . ' -1 day')
                            ),
                        ]);
                    }
                }
            }

            // Find previous record strictly before new DatumVon for copy
            $previous = Ceos_VERWALTUNG_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                ->where('VerwaltungID', $verwaltung->VerwaltungID)
                ->where('DatumVon', '<=', $newDatumVon)
                ->orderByDesc('DatumVon')
                ->orderByDesc('ID')
                ->first();

            // Prepare new timeline row by copying previous data
            $newData = $previous ? $previous->toArray() : [];
            unset(
                $newData['ID'],
                $newData['DateStamp'],
                $newData['TimeStamp']
            );

            // Merge API data
            $newData = array_merge($newData, $apiData);

            // Create new timeline row
            Ceos_VERWALTUNG_TimeLine::create($newData);
        }
    }


    private function logMissing(string $context, array $extra = []): void
    {
        Log::warning("re_01_01_Liegenschaften: $context", $extra);
    }


    private function processMietobjekte(Ceos_LIEGENSCHAFT $liegenschaft, array $mietobjekte): void
    {
        foreach ($mietobjekte as $mietobjekt) {

            // Create or get Wohneinheit master record
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

            // Resolve building
            $gebaeude = $this->findGebaeude($liegenschaft, $mietobjekt['genrCeos']);
            if (!$gebaeude) {
                $this->logMissing('Kein Gebaeude', [
                    'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                    'GebaeudeNr' => $mietobjekt['genrCeos'],
                ]);
                continue;
            }

            // Prepare API data
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
                'DatumBis' => $mietobjekt['validto'],
                'User' => 1,
            ];

            $newDatumVon = $apiData['DatumVon'];

            // Check if a record with the same DatumVon exists
            $existing = Ceos_WOHNEINHEIT_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                ->where('WohneinheitID', $wohneinheit->WohneinheitID)
                ->where('DatumVon', $newDatumVon)
                ->orderByDesc('ID')
                ->first();

            $sameDatumVonButDifferent = false;

            if ($existing) {
                $isIdentical = true;

                foreach ($apiData as $key => $value) {
                    if (in_array($key, ['DatumVon', 'DatumBis', 'User'])) {
                        continue;
                    }
                    if ($existing->$key != $value) {
                        $isIdentical = false;
                        break;
                    }
                }

                // Same DatumVon and identical data
                if ($isIdentical) {
                    continue;
                }

                // Same DatumVon but different data
                $sameDatumVonButDifferent = true;
            }

            // Close all overlapping records except same DatumVon case
            if (!$sameDatumVonButDifferent) {
                $overlappingRecords = Ceos_WOHNEINHEIT_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                    ->where('WohneinheitID', $wohneinheit->WohneinheitID)
                    ->where('DatumBis', '>=', $newDatumVon)
                    ->lockForUpdate()
                    ->get();

                foreach ($overlappingRecords as $record) {
                    if ($record->DatumVon != $newDatumVon) {
                        $record->update([
                            'DatumBis' => date(
                                'Y-m-d',
                                strtotime($newDatumVon . ' -1 day')
                            ),
                        ]);
                    }
                }
            }

            // Find previous record strictly before new DatumVon for copy
            $previous = Ceos_WOHNEINHEIT_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                ->where('WohneinheitID', $wohneinheit->WohneinheitID)
                ->where('DatumVon', '<=', $newDatumVon)
                ->orderByDesc('DatumVon')
                ->orderByDesc('ID')
                ->first();

            // Prepare new timeline row by copying previous data
            $newData = $previous ? $previous->toArray() : [];
            unset(
                $newData['ID'],
                $newData['DateStamp'],
                $newData['TimeStamp']
            );

            // Merge API data
            $newData = array_merge($newData, $apiData);

            // Create new timeline row
            Ceos_WOHNEINHEIT_TimeLine::create($newData);

            // Create SAP IDs
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
        $leerstand = "1000000000";

        foreach ($mieters as $receivedMieter) {

            $isLeerstand = ($receivedMieter['partner'] === $leerstand);

            // -------------------------------------------------
            // Mieter
            // -------------------------------------------------
            $mieter = Ceos_MIETER::firstOrCreate(
                ['MI_COMP_API_ID' => $receivedMieter['partner']],
                ['User' => 0]
            );

            $this->importedMieter[] = $mieter->MieterID;

            // -------------------------------------------------
            // Wohneinheit
            // -------------------------------------------------
            $gebaeude = $this->findGebaeude($liegenschaft, $receivedMieter['genrCeos']);
            $wohneinheit = $this->findWohneinheit(
                $liegenschaft,
                $gebaeude,
                $receivedMieter['menrCeos']
            );

            if (!$wohneinheit) {
                $this->logMissing(
                    'No Wohneinheit found',
                    [
                        'genr' => $receivedMieter['genrCeos'],
                        'menr' => $receivedMieter['menrCeos']
                    ]
                );
                continue;
            }

            // -------------------------------------------------
            // API Fields
            // -------------------------------------------------
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
                'DatumBis' => $receivedMieter['datumAuszug'],
                'User' => 1,
            ];

            DB::transaction(function () use ($apiData, $isLeerstand) {
                // -------------------------------------------------
                // Last Record (LG + W)
                // -------------------------------------------------
                $lastRecord = Ceos_MIETER_TimeLine::where('LiegenschaftsID', $apiData['LiegenschaftsID'])
                    ->where('WohneinheitID', $apiData['WohneinheitID'])
                    ->orderByDesc('DatumVon')
                    ->orderByDesc('ID')
                    ->first();

                // -------------------------------------------------
                // Same LG-W-M with same period?
                // -------------------------------------------------
                $samePeriod = Ceos_MIETER_TimeLine::where('LiegenschaftsID', $apiData['LiegenschaftsID'])
                    ->where('WohneinheitID', $apiData['WohneinheitID'])
                    ->where('MieterID', $apiData['MieterID'])
                    ->where('DatumVon', $apiData['DatumVon'])
                    ->where('DatumBis', $apiData['DatumBis'])
                    ->where('Geloescht_JN', 0)
                    ->orderByDesc('ID')
                    ->first();

                // -------------------------------------------------
                // CASE 1 & 2
                // -------------------------------------------------
                if ($samePeriod) {
                    $identical = true;
                    foreach ($apiData as $field => $value) {
                        if ($samePeriod->$field != $value) {
                            $identical = false;
                            break;
                        }
                    }
                    if ($identical) {
                        if ($apiData['DatumBis'] === '9999-12-31') {
                            $entries = Ceos_MIETER_TimeLine::where('LiegenschaftsID', $apiData['LiegenschaftsID'])
                                ->where('WohneinheitID', $apiData['WohneinheitID'])
                                ->where('Geloescht_JN', 0)
                                ->orderByDesc('DatumVon')
                                ->orderByDesc('ID')
                                ->take(2)
                                ->get();

                            if ($entries->isNotEmpty()) {

                                $latest = $entries[0];
                                $previous = $entries[1] ?? null;

                                // If API date is not newer, ignore
                                if (strtotime($latest->DatumVon) <= strtotime($apiData['DatumVon'])) {
                                    if ($apiData['WohneinheitID'] == 8858) {
                                        dd($entries);
                                    }
                                    return;
                                }

                                // Always close latest entry
                                $latest->update([
                                    'Geloescht_JN' => 1
                                ]);

                                // Check sequential date condition
                                if ($previous) {
                                    $expectedDate = date(
                                        'Y-m-d',
                                        strtotime($latest->DatumVon . ' -1 day')
                                    );

                                    if ($previous->DatumBis === $expectedDate) {
                                        // Close previous entry only if condition matches
                                        $previous->update([
                                            'Geloescht_JN' => 1
                                        ]);
                                    }

                                }
                            }
                            // allow creation
                        } else {
                            return;
                        }
                    }

                    // ---------- END NEW CASE 1 LOGIC ----------

                    // CASE 2 → Duplicate this record
                    $baseData = $samePeriod->toArray();

                }

                // -------------------------------------------------
                // CASE 3 & 4
                // -------------------------------------------------
                if (!isset($baseData)) {

                    // CASE 4 → New Mieter
                    if ($lastRecord && $lastRecord->MieterID != $apiData['MieterID']) {

                        $baseData = [];

                    } else {
                        // CASE 3 → Same Mieter
                        if ($lastRecord && $lastRecord->MieterID == $apiData['MieterID'] && !$isLeerstand) {
                            $baseData = $lastRecord->toArray();
                        } else {

                            // Last was Leerstand OR no history
                            $baseData = [];
                        }
                    }
                }

                // -------------------------------------------------
                // Prepare Insert
                // -------------------------------------------------
                unset(
                    $baseData['ID'],
                    $baseData['DateStamp'],
                    $baseData['TimeStamp']
                );

                $newData = array_merge($baseData, $apiData);

                // -------------------------------------------------
                // Insert
                // -------------------------------------------------
                Ceos_MIETER_TimeLine::create($newData);
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
                'User' => 1,
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
