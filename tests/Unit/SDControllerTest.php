<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;

/**
 * Feature Tests für SDController.
 *
 * Deckt alle SD-Endpunkte ab:
 * SD-01-01 Beauftragung      (SAP → CEOS)
 * SD-01-02 Rückmeldung       (CEOSWEB → CEOS → SAP)
 * SD-02-01 Mietvertragsrechnung (SAP → CEOS)
 * SD-03-01 Dienstleistungsrechnung (CEOSWEB → CEOS → SAP)
 * SD-03-02 Fakturierte Rechnung (SAP → CEOS)
 */
class SDControllerTest extends TestCase
{
    private string $sapToken  = 'test-sap-token';
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
    // SD-01-01: Beauftragung (SAP → CEOS)
    // =========================================================================

    public function test_sd0101_returns_401_without_token(): void
    {
        $response = $this->postJson('/api/v1/sd/0101/beauftragung', []);

        $response->assertStatus(401);
    }

    public function test_sd0101_returns_400_for_empty_json(): void
    {
        $response = $this->postJson(
            '/api/v1/sd/0101/beauftragung',
            [],
            $this->sapHeaders()
        );

        // Leeres Array → InvalidJsonException oder 400
        $response->assertStatus(400);
    }

    public function test_sd0101_failed_items_contain_vbeln(): void
    {
        $response = $this->postJson(
            '/api/v1/sd/0101/beauftragung',
            [
                ['ungueltig' => 'daten'] // header fehlt → vbeln = unknown
            ],
            $this->sapHeaders()
        );

        $json = $response->json();
        $this->assertArrayHasKey('data', $json);

        if (!empty($json['data']['failed'])) {
            $this->assertArrayHasKey('vbeln', $json['data']['failed'][0]);
            $this->assertArrayHasKey('message', $json['data']['failed'][0]);
        }
    }

    public function test_sd0101_response_structure_always_has_required_keys(): void
    {
        $response = $this->postJson(
            '/api/v1/sd/0101/beauftragung',
            [['header' => ['vbeln' => 'TEST-001']]],
            $this->sapHeaders()
        );

        $json = $response->json();
        $this->assertArrayHasKey('status', $json);
        $this->assertArrayHasKey('message', $json);
        $this->assertArrayHasKey('data', $json);
    }

    public function test_sd0101_with_multiple_auftraege_returns_report(): void
    {
        $response = $this->postJson(
            '/api/v1/sd/0101/beauftragung',
            [
                ['header' => ['vbeln' => 'V001']],
                ['header' => ['vbeln' => 'V002']],
            ],
            $this->sapHeaders()
        );

        $json = $response->json();
        $this->assertArrayHasKey('data', $json);
        $this->assertArrayHasKey('failed', $json['data']);
        $this->assertArrayHasKey('success', $json['data']);
    }

    // =========================================================================
    // SD-02-01: Mietvertragsrechnungen (SAP → CEOS)
    // =========================================================================

    public function test_sd0201_returns_401_without_token(): void
    {
        $response = $this->postJson('/api/v1/sd/0201/mietvertragsrechnungen', []);

        $response->assertStatus(401);
    }

    public function test_sd0201_returns_400_for_empty_body(): void
    {
        $response = $this->postJson(
            '/api/v1/sd/0201/mietvertragsrechnungen',
            [],
            $this->sapHeaders()
        );

        $response->assertStatus(400);
    }

    public function test_sd0201_failed_item_has_vbeln_and_message(): void
    {
        $response = $this->postJson(
            '/api/v1/sd/0201/mietvertragsrechnungen',
            [
                [
                    'header' => ['vbeln' => 'RENT-001'],
                    // Pflichtfelder fehlen absichtlich
                ]
            ],
            $this->sapHeaders()
        );

        $json = $response->json();
        if (!empty($json['data']['failed'])) {
            $this->assertArrayHasKey('vbeln', $json['data']['failed'][0]);
        }
        $this->assertContains($response->getStatusCode(), [400, 207]);
    }

    public function test_sd0201_validates_date_fields(): void
    {
        $response = $this->postJson(
            '/api/v1/sd/0201/mietvertragsrechnungen',
            [
                [
                    'header' => [
                        'vbeln'    => 'RENT-002',
                        'zuonr'    => 'OTHER-002', // vbeln != zuonr → datumvon/bis required
                        'datumvon' => 'kein-datum',
                        'datumbis' => 'kein-datum',
                    ],
                ]
            ],
            $this->sapHeaders()
        );

        // Datum ungültig → failed
        $json = $response->json();
        $this->assertContains($response->getStatusCode(), [400, 207, 422]);
    }

    // =========================================================================
    // SD-01-02: Beauftragung Rückmeldung (CEOSWEB → CEOS → SAP)
    // =========================================================================

    public function test_sd0102_returns_401_without_ceos_token(): void
    {
        $response = $this->postJson('/api/v1/sd/0102/beauftragungRueckmeldung', []);

        $response->assertStatus(401);
    }

    // =========================================================================
    // SD-03-01: Dienstleistungsrechnung (CEOSWEB → CEOS → SAP)
    // =========================================================================

    public function test_sd0301_returns_401_without_token(): void
    {
        $response = $this->postJson('/api/v1/sd/0301/dienstleistungsrechnung ', []);

        $response->assertStatus(401);
    }

    public function test_sd0301_returns_422_without_interne_vorgangsnummer(): void
    {
        $response = $this->postJson(
            '/api/v1/sd/0301/dienstleistungsrechnung ',
            [],
            $this->ceosHeaders()
        );

        $response->assertStatus(422);
    }

    // =========================================================================
    // SD-03-02: Fakturierte Dienstleistungsrechnung (SAP → CEOS)
    // =========================================================================

    public function test_sd0302_returns_401_without_token(): void
    {
        $response = $this->postJson('/api/v1/sd/0302/fakturiertedienstleistungsrechnung', []);

        $response->assertStatus(401);
    }

    public function test_sd0302_returns_422_for_invalid_data(): void
    {
        $response = $this->postJson(
            '/api/v1/sd/0302/fakturiertedienstleistungsrechnung',
            [],
            $this->sapHeaders()
        );

        $response->assertStatus(422);
    }
}
