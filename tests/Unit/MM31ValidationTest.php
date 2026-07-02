<?php

namespace Tests\Unit;

use App\Helpers\MM_31_01_01_Validation;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

/**
 * Unit Tests für MM_31_01_01_Validation Helper.
 *
 * Prüft alle Validierungsregeln: Pflichtfelder, optionale Felder,
 * Längenbeschränkungen und Typen.
 */
class MM31Validation_Test extends TestCase
{
    // Minimaler gültiger Datensatz
    private function validPayload(): array
    {
        return [
            'Material'               => '000000000000012345',  // 18-stellig numeric
            'Materialkurztext'       => 'Testmaterial',
            'Warengruppe'            => 'WG001',
            'Bezeichnung1'           => 'Beschreibung 1',
            'Bezeichnung2'           => null,
            'Basismengeneinheit'     => 'ST',
            'LVorm'                  => null,
            'BKSchluessel'           => null,
            'CEOSWarengruppe'        => 'WG01',
            'CEOSArtikelgruppe'      => 'AG01',
            'CEOSArtikeluntergruppe' => null,
            'CEOSHIBEzuHAWA1'       => null,
            'CEOSHIBEzuHAWA2'       => null,
            'CEOSHIBEzuHAWA3'       => null,
            'Produktgruppe'          => null,
            'Basisempfindlichkeit'   => 5,
            'Hersteller'             => null,
            'Herstellerteilenummer'  => null,
            'EANNummerSAP'           => null,
            'Langtext'               => null,
            'Matchcode'              => null,
        ];
    }

    private function validate(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, MM_31_01_01_Validation::rules(), MM_31_01_01_Validation::messages());
    }

    // -------------------------------------------------------------------------
    // Pflichtfelder
    // -------------------------------------------------------------------------

    public function test_valid_payload_passes(): void
    {
        $this->assertTrue($this->validate($this->validPayload())->passes());
    }

    public function test_material_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['Material']);

        $this->assertTrue($this->validate($data)->fails());
        $this->assertArrayHasKey('Material', $this->validate($data)->errors()->toArray());
    }

    public function test_material_must_be_18_digits(): void
    {
        $data = $this->validPayload();
        $data['Material'] = '12345'; // zu kurz

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_material_must_be_numeric(): void
    {
        $data = $this->validPayload();
        $data['Material'] = 'ABCDEFGHIJKLMNOPQR'; // nicht numerisch

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_materialkurztext_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['Materialkurztext']);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_materialkurztext_max_40_chars(): void
    {
        $data = $this->validPayload();
        $data['Materialkurztext'] = str_repeat('A', 41);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_warengruppe_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['Warengruppe']);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_bezeichnung1_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['Bezeichnung1']);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_ceos_warengruppe_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['CEOSWarengruppe']);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_ceos_artikelgruppe_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['CEOSArtikelgruppe']);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_basismengeneinheit_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['Basismengeneinheit']);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_basismengeneinheit_max_3_chars(): void
    {
        $data = $this->validPayload();
        $data['Basismengeneinheit'] = 'STCK'; // 4 Zeichen - zu lang

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_basisempfindlichkeit_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['Basisempfindlichkeit']);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_basisempfindlichkeit_must_be_numeric(): void
    {
        $data = $this->validPayload();
        $data['Basisempfindlichkeit'] = 'hoch'; // kein Numeric

        $this->assertTrue($this->validate($data)->fails());
    }

    // -------------------------------------------------------------------------
    // Optionale Felder
    // -------------------------------------------------------------------------

    public function test_nullable_fields_can_be_null(): void
    {
        $data = $this->validPayload();
        // alle nullable Felder sind bereits null - muss passieren
        $this->assertTrue($this->validate($data)->passes());
    }

    public function test_bezeichnung2_is_optional(): void
    {
        $data = $this->validPayload();
        $data['Bezeichnung2'] = 'Optional Text';

        $this->assertTrue($this->validate($data)->passes());
    }

    public function test_ceos_hibe_zu_hawa_optional(): void
    {
        $data = $this->validPayload();
        $data['CEOSHIBEzuHAWA1'] = '123456789012345678';
        $data['CEOSHIBEzuHAWA2'] = '234567890123456789';
        $data['CEOSHIBEzuHAWA3'] = '345678901234567890';

        $this->assertTrue($this->validate($data)->passes());
    }

    public function test_hersteller_max_10_chars(): void
    {
        $data = $this->validPayload();
        $data['Hersteller'] = str_repeat('A', 11);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_langtext_max_1000_chars(): void
    {
        $data = $this->validPayload();
        $data['Langtext'] = str_repeat('X', 1001);

        $this->assertTrue($this->validate($data)->fails());
    }

    // -------------------------------------------------------------------------
    // Messages
    // -------------------------------------------------------------------------

    public function test_messages_returns_array(): void
    {
        $messages = MM_31_01_01_Validation::messages();

        $this->assertIsArray($messages);
        $this->assertArrayHasKey('required', $messages);
        $this->assertArrayHasKey('string', $messages);
        $this->assertArrayHasKey('max', $messages);
        $this->assertArrayHasKey('numeric', $messages);
    }
}
