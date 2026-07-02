<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;

/**
 * Feature Tests für MMController.
 *
 * Testet HTTP-Validierung, Response-Struktur und Fehlerfälle
 * ohne echte DB-Verbindung (Mocking der Services).
 */
class MMControllerTest extends TestCase
{
    private string $sapToken = 'test-sap-token';
    private string $ceosToken = 'test-ceos-token';

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('sap.api_token', $this->sapToken);
        Config::set('ceosweb.api_token', $this->ceosToken);
    }

    private function sapHeaders(): array
    {
        return ['X-SAP-Token' => $this->sapToken];
    }

    private function ceosHeaders(): array
    {
        return ['Ceos-Web-Token' => $this->ceosToken];
    }

    // =========================================================================
    // MM-31-01: Materialstammdaten (SAP → CEOS)
    // =========================================================================

    public function test_mm3101_returns_400_for_empty_array(): void
    {
        $response = $this->postJson(
            '/api/v1/mm/3101/materialstammdaten',
            [],
            $this->sapHeaders()
        );

        // Leeres Array → kein Material → alle failed → 400
        $response->assertStatus(400);
    }

    public function test_mm3101_returns_400_when_material_field_missing(): void
    {
        $response = $this->postJson(
            '/api/v1/mm/3101/materialstammdaten',
            [
                [
                    // Material fehlt absichtlich
                    'Materialkurztext'   => 'Test',
                    'Warengruppe'        => 'WG01',
                    'Bezeichnung1'       => 'Bezeichnung',
                    'Basismengeneinheit' => 'ST',
                    'CEOSWarengruppe'    => 'WG',
                    'CEOSArtikelgruppe'  => 'AG',
                    'Basisempfindlichkeit' => 5,
                ]
            ],
            $this->sapHeaders()
        );

        $response->assertStatus(400);
        $json = $response->json();
        $this->assertArrayHasKey('data', $json);
        $this->assertNotEmpty($json['data']['failed']);
    }

    public function test_mm3101_response_has_correct_structure(): void
    {
        $response = $this->postJson(
            '/api/v1/mm/3101/materialstammdaten',
            [
                [
                    'Material' => '000000000000012345', // 18-stellig
                    'Materialkurztext'   => 'Test Material',
                    'Warengruppe'        => 'WG01',
                    'Bezeichnung1'       => 'Bezeichnung 1',
                    'Basismengeneinheit' => 'ST',
                    'CEOSWarengruppe'    => 'WG',
                    'CEOSArtikelgruppe'  => 'AG',
                    'Basisempfindlichkeit' => 5,
                ]
            ],
            $this->sapHeaders()
        );

        $json = $response->json();

        // Response-Struktur muss immer status, message, data enthalten
        $this->assertArrayHasKey('status', $json);
        $this->assertArrayHasKey('message', $json);
        $this->assertArrayHasKey('data', $json);
    }

    public function test_mm3101_failed_items_contain_material_and_message(): void
    {
        $response = $this->postJson(
            '/api/v1/mm/3101/materialstammdaten',
            [['ungueltig' => 'daten']],
            $this->sapHeaders()
        );

        $json = $response->json();
        $this->assertNotEmpty($json['data']['failed']);
        $failed = $json['data']['failed'][0];
        $this->assertArrayHasKey('Material', $failed);
        $this->assertArrayHasKey('message', $failed);
    }

    // =========================================================================
    // MM-37-01: NU Leistungspositionen (SAP → CEOS)
    // =========================================================================

    public function test_mm3701_returns_422_without_header(): void
    {
        $response = $this->postJson(
            '/api/v1/mm/3701/nuleistungspositionen',
            ['positions' => []],
            $this->sapHeaders()
        );

        $response->assertStatus(422);
    }

    public function test_mm3701_returns_422_when_positions_empty(): void
    {
        $response = $this->postJson(
            '/api/v1/mm/3701/nuleistungspositionen',
            [
                'header' => [
                    'kontraktnummer' => 'K-001',
                    'kreditor'       => 'KRED-001',
                    'gueltigVon'     => '2025-01-01',
                    'gueltigBis'     => '2025-12-31',
                ],
                'positions' => [], // min:1 → muss fehlschlagen
            ],
            $this->sapHeaders()
        );

        $response->assertStatus(422);
    }

    public function test_mm3701_returns_422_when_date_format_wrong(): void
    {
        $response = $this->postJson(
            '/api/v1/mm/3701/nuleistungspositionen',
            [
                'header' => [
                    'kontraktnummer' => 'K-001',
                    'kreditor'       => 'KRED-001',
                    'gueltigVon'     => '01.01.2025',  // falsches Format (muss Y-m-d)
                    'gueltigBis'     => '31.12.2025',
                ],
                'positions' => [
                    [
                        'kontraktnummer'    => 'K-001',
                        'kontraktposition'  => 1,
                        'materialnummer'    => 'MAT-001',
                        'preis'             => 99.99,
                        'preismengeneinheit'=> 1,
                    ]
                ],
            ],
            $this->sapHeaders()
        );

        $response->assertStatus(422);
    }

    public function test_mm3701_returns_422_when_gueltigbis_before_von(): void
    {
        $response = $this->postJson(
            '/api/v1/mm/3701/nuleistungspositionen',
            [
                'header' => [
                    'kontraktnummer' => 'K-001',
                    'kreditor'       => 'KRED-001',
                    'gueltigVon'     => '2025-12-31',
                    'gueltigBis'     => '2025-01-01',  // vor Von → Fehler
                ],
                'positions' => [
                    [
                        'kontraktnummer'    => 'K-001',
                        'kontraktposition'  => 1,
                        'materialnummer'    => 'MAT-001',
                        'preis'             => 99.99,
                        'preismengeneinheit'=> 1,
                    ]
                ],
            ],
            $this->sapHeaders()
        );

        $response->assertStatus(422);
    }

    // =========================================================================
    // MM-34-02: Status Umlagerungsreservierung (SAP → CEOS)
    // =========================================================================

    public function test_mm3402_returns_422_without_required_fields(): void
    {
        $response = $this->postJson(
            '/api/v1/mm/3402/statusumlagerungsreservierung',
            [],
            $this->sapHeaders()
        );

        $response->assertStatus(422);
    }

    // =========================================================================
    // MM-22-01: Lagerbestände (CEOSWEB → CEOS → SAP)
    // =========================================================================

    public function test_mm2201_returns_422_without_artikelnummer(): void
    {
        $response = $this->postJson(
            '/api/v1/mm/2201/lagerbestaende',
            ['lager' => 'HAUPTLAGER'],
            $this->ceosHeaders()
        );

        $response->assertStatus(422);
    }

    public function test_mm2201_returns_422_without_lager(): void
    {
        $response = $this->postJson(
            '/api/v1/mm/2201/lagerbestaende',
            ['artikelnummer' => ['12345']],
            $this->ceosHeaders()
        );

        $response->assertStatus(422);
    }

    // =========================================================================
    // MM-34-01: Umlagerungsreservierung (CEOSWEB → CEOS → SAP)
    // =========================================================================

    public function test_mm3401_returns_422_without_vorgangnummer(): void
    {
        $response = $this->postJson(
            '/api/v1/mm/3401/umlagerungsreservierung',
            [
                'VorGruppe' => 'VG1',
                'tourId'    => 'T001',
                'tourDate'  => '2025-06-01',
            ],
            $this->ceosHeaders()
        );

        $response->assertStatus(422);
    }

    public function test_mm3401_returns_422_with_invalid_date(): void
    {
        $response = $this->postJson(
            '/api/v1/mm/3401/umlagerungsreservierung',
            [
                'Vorgangnummer' => 'V001',
                'VorGruppe'     => 'VG1',
                'tourId'        => 'T001',
                'tourDate'      => 'kein-datum',  // ungültiges Datum
            ],
            $this->ceosHeaders()
        );

        $response->assertStatus(422);
    }

    // =========================================================================
    // MM-35-02: Materialverbrauch (CEOSWEB → CEOS → SAP)
    // =========================================================================

    public function test_mm3502_returns_422_when_required_fields_missing(): void
    {
        $response = $this->postJson(
            '/api/v1/mm/3502/materialverbrauch',
            [],
            $this->ceosHeaders()
        );

        $response->assertStatus(422);
    }
}
