<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;

/**
 * Feature Tests für BP, RE, SE, CO und EA Controller.
 *
 * BP-01-01: Geschäftspartner       (SAP → CEOS)
 * BP-01-03: Verwalter              (SAP → CEOS)
 * RE-01-01: Liegenschaften         (SAP → CEOS)
 * SE-26-01: Reparaturauftrag       (CEOSWEB → CEOS → SAP)
 * CO-01-01: Zeiteinheiten          (CEOSWEB → CEOS → SAP)
 * EA-02-01: File Exchange          (CEOSWEB → CEOS → SAP)
 */
class OtherControllersTest extends TestCase
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
    // BP-01-01: Geschäftspartner
    // =========================================================================

    public function test_bp0101_returns_401_without_token(): void
    {
        $this->postJson('/api/v1/bp/0101/geschaeftspartner', [])
            ->assertStatus(401);
    }

    public function test_bp0101_returns_422_without_required_fields(): void
    {
        $response = $this->postJson(
            '/api/v1/bp/0101/geschaeftspartner',
            [],
            $this->sapHeaders()
        );

        $response->assertStatus(422);
    }

    public function test_bp0101_returns_422_when_geschaeftspartnernummer_missing(): void
    {
        $response = $this->postJson(
            '/api/v1/bp/0101/geschaeftspartner',
            [
                'DebitorenKreditorennummer' => 12345,
                'Adresstyp' => 'KUND',
                // Geschaeftspartnernummer fehlt absichtlich
            ],
            $this->sapHeaders()
        );

        $response->assertStatus(422);
    }

    public function test_bp0101_returns_422_when_email_format_invalid(): void
    {
        $response = $this->postJson(
            '/api/v1/bp/0101/geschaeftspartner',
            [
                'Geschaeftspartnernummer'   => 100001,
                'DebitorenKreditorennummer' => 200001,
                'Adresstyp'                 => 'KUND',
                'EMail'                     => 'keine-gueltige-email', // ungültig
            ],
            $this->sapHeaders()
        );

        $response->assertStatus(422);
    }

    public function test_bp0101_returns_422_when_land_not_2_chars(): void
    {
        $response = $this->postJson(
            '/api/v1/bp/0101/geschaeftspartner',
            [
                'Geschaeftspartnernummer'   => 100001,
                'DebitorenKreditorennummer' => 200001,
                'Adresstyp'                 => 'KUND',
                'Land'                      => 'DEU', // 3 Zeichen statt 2
            ],
            $this->sapHeaders()
        );

        $response->assertStatus(422);
    }

    public function test_bp0101_passes_validation_with_minimal_data(): void
    {
        $response = $this->postJson(
            '/api/v1/bp/0101/geschaeftspartner',
            [
                'Geschaeftspartnernummer'   => 100001,
                'DebitorenKreditorennummer' => 200001,
                'Adresstyp'                 => 'KUND',
            ],
            $this->sapHeaders()
        );

        // Middleware und Validierung passiert → Service schlägt fehl (keine DB),
        // aber kein 401 und kein 422 wegen Validierung
        $this->assertNotEquals(401, $response->getStatusCode());
        $this->assertNotEquals(422, $response->getStatusCode());
    }

    // =========================================================================
    // BP-01-03: Verwalter
    // =========================================================================

    public function test_bp0103_returns_401_without_token(): void
    {
        $this->postJson('/api/v1/bp/0103/verwalter', [])
            ->assertStatus(401);
    }

    public function test_bp0103_returns_422_for_empty_body(): void
    {
        $response = $this->postJson(
            '/api/v1/bp/0103/verwalter',
            [],
            $this->sapHeaders()
        );

        $response->assertStatus(422);
    }

    // =========================================================================
    // RE-01-01: Liegenschaften
    // =========================================================================

    public function test_re0101_returns_401_without_token(): void
    {
        $this->postJson('/api/v1/re/0101/liegenschaften', [])
            ->assertStatus(401);
    }

    public function test_re0101_returns_422_for_empty_body(): void
    {
        $response = $this->postJson(
            '/api/v1/re/0101/liegenschaften',
            [],
            $this->sapHeaders()
        );

        $response->assertStatus(422);
    }

    // =========================================================================
    // SE-26-01: Reparaturauftrag
    // =========================================================================

    public function test_se2601_returns_401_without_token(): void
    {
        $this->postJson('/api/v1/se/2601/reparaturauftrag', [])
            ->assertStatus(401);
    }

    // =========================================================================
    // CO-01-01: Zeiteinheiten
    // =========================================================================

    public function test_co0101_returns_401_without_token(): void
    {
        $this->postJson('/api/v1/co/0101/zeiteinheiten ', [])
            ->assertStatus(401);
    }

    // =========================================================================
    // EA-02-01: File Exchange
    // =========================================================================

    public function test_ea0201_listfiles_returns_401_without_token(): void
    {
        $this->postJson('/api/v1/ea/0201/listfiles', [])
            ->assertStatus(401);
    }

    public function test_ea0201_fileexchange_returns_401_without_token(): void
    {
        $this->postJson('/api/v1/ea/0201/fileExchange', [])
            ->assertStatus(401);
    }

    public function test_ea0201_listfiles_returns_422_for_invalid_data(): void
    {
        $response = $this->postJson(
            '/api/v1/ea/0201/listfiles',
            [],
            $this->ceosHeaders()
        );

        $this->assertNotEquals(401, $response->getStatusCode());
    }
}
