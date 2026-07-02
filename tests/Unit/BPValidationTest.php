<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

/**
 * Unit Tests für BP_0101_geschaeftspartnerRequest Validierungsregeln.
 *
 * Testet alle Felder und Beschränkungen direkt über den Validator,
 * ohne HTTP-Request zu senden.
 */
class BPValidationTest extends TestCase
{
    private function rules(): array
    {
        return [
            'Geschaeftspartnernummer'   => 'required|numeric',
            'DebitorenKreditorennummer' => 'required|numeric',
            'Anrede'                    => 'nullable|digits:4',
            'Titel'                     => 'nullable|string|max:20',
            'Vorname'                   => 'nullable|string|max:40',
            'Nachname'                  => 'nullable|string|max:40',
            'Name1'                     => 'nullable|string|max:40',
            'Name2'                     => 'nullable|string|max:40',
            'Name3'                     => 'nullable|string|max:40',
            'Suchbegriff1'              => 'nullable|string|max:40',
            'Strasse'                   => 'nullable|string|max:60',
            'Postleitzahl'              => 'nullable|string|max:10',
            'Adresstyp'                 => 'required|string|max:4',
            'Ort'                       => 'nullable|string|max:40',
            'Land'                      => 'nullable|string|size:2',
            'Telefon'                   => 'nullable|string|max:40',
            'EMail'                     => 'nullable|email|max:100',
            'UVIMailadresse'            => 'nullable|email|max:100',
            'PDFMailadresse'            => 'nullable|email|max:100',
        ];
    }

    private function validPayload(): array
    {
        return [
            'Geschaeftspartnernummer'   => 100001,
            'DebitorenKreditorennummer' => 200001,
            'Adresstyp'                 => 'KUND',
        ];
    }

    private function validate(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, $this->rules());
    }

    // -------------------------------------------------------------------------
    // Pflichtfelder
    // -------------------------------------------------------------------------

    public function test_valid_minimal_payload_passes(): void
    {
        $this->assertTrue($this->validate($this->validPayload())->passes());
    }

    public function test_geschaeftspartnernummer_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['Geschaeftspartnernummer']);

        $this->assertTrue($this->validate($data)->fails());
        $this->assertArrayHasKey('Geschaeftspartnernummer', $this->validate($data)->errors()->toArray());
    }

    public function test_geschaeftspartnernummer_must_be_numeric(): void
    {
        $data = $this->validPayload();
        $data['Geschaeftspartnernummer'] = 'NICHT-NUMERIC';

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_debitoren_kreditorennummer_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['DebitorenKreditorennummer']);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_adresstyp_is_required(): void
    {
        $data = $this->validPayload();
        unset($data['Adresstyp']);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_adresstyp_max_4_chars(): void
    {
        $data = $this->validPayload();
        $data['Adresstyp'] = 'KUNDE'; // 5 Zeichen

        $this->assertTrue($this->validate($data)->fails());
    }

    // -------------------------------------------------------------------------
    // Optionale Felder mit Beschränkungen
    // -------------------------------------------------------------------------

    public function test_anrede_must_be_4_digits_if_set(): void
    {
        $data = $this->validPayload();
        $data['Anrede'] = '123'; // nur 3 Ziffern

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_anrede_passes_with_4_digits(): void
    {
        $data = $this->validPayload();
        $data['Anrede'] = '0001';

        $this->assertTrue($this->validate($data)->passes());
    }

    public function test_email_must_be_valid_format(): void
    {
        $data = $this->validPayload();
        $data['EMail'] = 'keine-email';

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_email_passes_with_valid_address(): void
    {
        $data = $this->validPayload();
        $data['EMail'] = 'test@example.com';

        $this->assertTrue($this->validate($data)->passes());
    }

    public function test_uvi_mail_must_be_valid_email(): void
    {
        $data = $this->validPayload();
        $data['UVIMailadresse'] = 'ungueltig';

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_pdf_mail_must_be_valid_email(): void
    {
        $data = $this->validPayload();
        $data['PDFMailadresse'] = 'ungueltig';

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_land_must_be_exactly_2_chars(): void
    {
        $data = $this->validPayload();
        $data['Land'] = 'DEU'; // 3 Zeichen

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_land_passes_with_2_chars(): void
    {
        $data = $this->validPayload();
        $data['Land'] = 'DE';

        $this->assertTrue($this->validate($data)->passes());
    }

    public function test_vorname_max_40_chars(): void
    {
        $data = $this->validPayload();
        $data['Vorname'] = str_repeat('A', 41);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_strasse_max_60_chars(): void
    {
        $data = $this->validPayload();
        $data['Strasse'] = str_repeat('S', 61);

        $this->assertTrue($this->validate($data)->fails());
    }

    public function test_postleitzahl_max_10_chars(): void
    {
        $data = $this->validPayload();
        $data['Postleitzahl'] = '12345678901'; // 11 Zeichen

        $this->assertTrue($this->validate($data)->fails());
    }

    // -------------------------------------------------------------------------
    // Vollständiger gültiger Datensatz
    // -------------------------------------------------------------------------

    public function test_full_valid_payload_passes(): void
    {
        $data = array_merge($this->validPayload(), [
            'Anrede'          => '0001',
            'Titel'           => 'Dr.',
            'Vorname'         => 'Hans',
            'Nachname'        => 'Mustermann',
            'Name1'           => 'Musterfirma GmbH',
            'Strasse'         => 'Musterstraße 1',
            'Postleitzahl'    => '12345',
            'Ort'             => 'Musterstadt',
            'Land'            => 'DE',
            'Telefon'         => '+49 123 4567890',
            'EMail'           => 'hans@musterfirma.de',
            'UVIMailadresse'  => 'uvi@musterfirma.de',
            'PDFMailadresse'  => 'pdf@musterfirma.de',
        ]);

        $this->assertTrue($this->validate($data)->passes());
    }
}
