<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

/**
 * Unit Tests für MM_3701_nuLeistungspositionenRequest Validierungsregeln.
 *
 * Testet Header-Felder, Positions-Array und Datums-Logik.
 */
class MM3701ValidationTest extends TestCase
{
    private function rules(): array
    {
        return [
            'header'                          => 'required|array',
            'header.kontraktnummer'           => 'required|string|max:20',
            'header.kreditor'                 => 'required|string|max:20',
            'header.gueltigVon'               => 'required|date_format:Y-m-d',
            'header.gueltigBis'               => 'required|date_format:Y-m-d|after_or_equal:header.gueltigVon',
            'positions'                       => 'required|array|min:1',
            'positions.*.kontraktnummer'      => 'required|string|max:20',
            'positions.*.kontraktposition'    => 'required|integer',
            'positions.*.materialnummer'      => 'required|string|max:50',
            'positions.*.materialkurztext'    => 'nullable|string|max:255',
            'positions.*.mengeneinheit'       => 'nullable|string|max:10',
            'positions.*.preis'               => 'required|numeric|min:0',
            'positions.*.preismengeneinheit'  => 'required|numeric|min:1',
            'positions.*.loeschkennzeichen'   => 'nullable|string|in:L,""',
        ];
    }

    private function validPayload(): array
    {
        return [
            'header' => [
                'kontraktnummer' => 'K-2025-001',
                'kreditor'       => 'KRED-100',
                'gueltigVon'     => '2025-01-01',
                'gueltigBis'     => '2025-12-31',
            ],
            'positions' => [
                [
                    'kontraktnummer'    => 'K-2025-001',
                    'kontraktposition'  => 1,
                    'materialnummer'    => 'MAT-12345',
                    'preis'             => 49.99,
                    'preismengeneinheit'=> 1,
                ]
            ],
        ];
    }

    private function validate(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, $this->rules());
    }

    // -------------------------------------------------------------------------
    // Gültige Daten
    // -------------------------------------------------------------------------

    public function test_valid_payload_passes(): void
    {
        $this->assertTrue($this->validate($this->validPayload())->passes());
    }

    // -------------------------------------------------------------------------
    // Header Pflichtfelder
    // -------------------------------------------------------------------------

    public function test_header_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['header']);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_header_kontraktnummer_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['header']['kontraktnummer']);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_header_kreditor_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['header']['kreditor']);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_header_gueltig_von_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['header']['gueltigVon']);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_header_gueltig_bis_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['header']['gueltigBis']);

        $this->assertTrue($this->validate($data)->fails());
    }

    // -------------------------------------------------------------------------
    // Datums-Validierung
    // -------------------------------------------------------------------------

    public function test_gueltig_von_must_be_ymd_format(): void
    {
        $data = $this->validPayload();
        $data['header']['gueltigVon'] = '01.01.2025'; // deutsches Format → ungültig

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_gueltig_bis_must_be_ymd_format(): void
    {
        $data = $this->validPayload();
        $data['header']['gueltigBis'] = '31-12-2025'; // falsches Format

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_gueltig_bis_must_be_after_or_equal_von(): void
    {
        $data = $this->validPayload();
        $data['header']['gueltigVon'] = '2025-12-31';
        $data['header']['gueltigBis'] = '2025-01-01'; // vor Von → ungültig

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_gueltig_von_and_bis_can_be_same_date(): void
    {
        $data = $this->validPayload();
        $data['header']['gueltigVon'] = '2025-06-15';
        $data['header']['gueltigBis'] = '2025-06-15'; // gleich → gültig

        $this->assertTrue($this->validate($data)->passes());
    }

    // -------------------------------------------------------------------------
    // Positions Array
    // -------------------------------------------------------------------------

    public function test_positions_must_have_at_least_one_entry(): void
    {
        $data = $this->validPayload();
        $data['positions'] = []; // leer → min:1 → ungültig

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_position_kontraktnummer_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['positions'][0]['kontraktnummer']);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_position_kontraktposition_must_be_integer(): void
    {
        $data = $this->validPayload();
        $data['positions'][0]['kontraktposition'] = 'eins'; // kein Integer

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_position_materialnummer_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['positions'][0]['materialnummer']);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_position_preis_must_be_numeric(): void
    {
        $data = $this->validPayload();
        $data['positions'][0]['preis'] = 'teuer'; // kein Numeric

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_position_preis_cannot_be_negative(): void
    {
        $data = $this->validPayload();
        $data['positions'][0]['preis'] = -1; // min:0

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_position_preismengeneinheit_must_be_at_least_1(): void
    {
        $data = $this->validPayload();
        $data['positions'][0]['preismengeneinheit'] = 0; // min:1

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_position_loeschkennzeichen_only_allows_L(): void
    {
        $data = $this->validPayload();
        $data['positions'][0]['loeschkennzeichen'] = 'X'; // nur L oder "" erlaubt

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_position_loeschkennzeichen_allows_L(): void
    {
        $data = $this->validPayload();
        $data['positions'][0]['loeschkennzeichen'] = 'L';

        $this->assertTrue($this->validate($data)->passes());
    }

    public function test_multiple_positions_pass_validation(): void
    {
        $data = $this->validPayload();
        $data['positions'][] = [
            'kontraktnummer'    => 'K-2025-001',
            'kontraktposition'  => 2,
            'materialnummer'    => 'MAT-99999',
            'materialkurztext'  => 'Zweites Material',
            'mengeneinheit'     => 'ST',
            'preis'             => 0.00, // Preis 0 ist erlaubt (min:0)
            'preismengeneinheit'=> 10,
        ];

        $this->assertTrue($this->validate($data)->passes());
    }
}
