<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;

/**
 * Feature Tests für die Authentication Middleware.
 *
 * VerifySapToken   → Header: X-SAP-Token
 * VerifyCeosWebToken → Header: Ceos-Web-Token
 *
 * Testet: fehlender Token, falscher Token, korrekter Token.
 */
class MiddlewareAuthTest extends TestCase
{
    // =========================================================================
    // VerifySapToken — SAP → CEOS Routen
    // =========================================================================

    protected function setUp(): void
    {
        parent::setUp();

        // Tokens in der Config setzen (werden normalerweise aus .env geladen)
        Config::set('sap.api_token', 'valid-sap-token-1234');
        Config::set('ceosweb.api_token', 'valid-ceosweb-token-5678');
    }

    public function test_sap_route_returns_401_without_token(): void
    {
        $response = $this->postJson('/api/v1/mm/3101/materialstammdaten', []);

        $response->assertStatus(401);
        $response->assertJson(['error' => 'Unauthorized']);
    }

    public function test_sap_route_returns_401_with_wrong_token(): void
    {
        $response = $this->postJson(
            '/api/v1/mm/3101/materialstammdaten',
            [],
            ['X-SAP-Token' => 'wrong-token']
        );

        $response->assertStatus(401);
    }

    public function test_sap_route_passes_middleware_with_valid_token(): void
    {
        // Mit korrektem Token wird die Middleware passiert.
        // Die Route selbst schlägt mit 422/400 fehl (leere Daten),
        // aber NICHT mit 401 — das beweist, die Middleware hat durchgelassen.
        $response = $this->postJson(
            '/api/v1/mm/3101/materialstammdaten',
            [[]],  // leerer Datensatz → Validierungsfehler erwartet, aber kein Auth-Fehler
            ['X-SAP-Token' => 'valid-sap-token-1234']
        );

        $response->assertStatus(fn($status) => $status !== 401);
        $this->assertNotEquals(401, $response->getStatusCode());
    }

    public function test_sap_route_bp_returns_401_without_token(): void
    {
        $response = $this->postJson('/api/v1/bp/0101/geschaeftspartner', []);

        $response->assertStatus(401);
    }

    public function test_sap_route_sd_returns_401_without_token(): void
    {
        $response = $this->postJson('/api/v1/sd/0101/beauftragung', []);

        $response->assertStatus(401);
    }

    public function test_sap_route_re_returns_401_without_token(): void
    {
        $response = $this->postJson('/api/v1/re/0101/liegenschaften', []);

        $response->assertStatus(401);
    }

    // =========================================================================
    // VerifyCeosWebToken — CEOSWEB → CEOS → SAP Routen
    // =========================================================================

    public function test_ceosweb_route_returns_401_without_token(): void
    {
        $response = $this->postJson('/api/v1/mm/2201/lagerbestaende', []);

        $response->assertStatus(401);
    }

    public function test_ceosweb_route_returns_401_with_wrong_token(): void
    {
        $response = $this->postJson(
            '/api/v1/mm/2201/lagerbestaende',
            [],
            ['Ceos-Web-Token' => 'wrong-token']
        );

        $response->assertStatus(401);
    }

    public function test_ceosweb_route_passes_middleware_with_valid_token(): void
    {
        $response = $this->postJson(
            '/api/v1/mm/2201/lagerbestaende',
            [],
            ['Ceos-Web-Token' => 'valid-ceosweb-token-5678']
        );

        // Middleware hat durchgelassen – Validierungsfehler oder anderes, aber kein 401
        $this->assertNotEquals(401, $response->getStatusCode());
    }

    public function test_ceosweb_route_se_returns_401_without_token(): void
    {
        $response = $this->postJson('/api/v1/se/2601/reparaturauftrag', []);

        $response->assertStatus(401);
    }

    public function test_ceosweb_route_sd_0102_returns_401_without_token(): void
    {
        $response = $this->postJson('/api/v1/sd/0102/beauftragungRueckmeldung', []);

        $response->assertStatus(401);
    }

    public function test_ceosweb_route_co_returns_401_without_token(): void
    {
        $response = $this->postJson('/api/v1/co/0101/zeiteinheiten ', []);

        $response->assertStatus(401);
    }

    // =========================================================================
    // Sicherstellen: SAP-Token funktioniert NICHT auf CEOSWEB-Routen
    // =========================================================================

    public function test_sap_token_does_not_work_on_ceosweb_routes(): void
    {
        // SAP-Token auf eine CEOSWEB-Route → muss 401 zurückgeben
        $response = $this->postJson(
            '/api/v1/mm/2201/lagerbestaende',
            [],
            ['X-SAP-Token' => 'valid-sap-token-1234'] // falscher Header-Name
        );

        $response->assertStatus(401);
    }

    public function test_ceosweb_token_does_not_work_on_sap_routes(): void
    {
        // CeosWeb-Token auf eine SAP-Route → muss 401 zurückgeben
        $response = $this->postJson(
            '/api/v1/mm/3101/materialstammdaten',
            [],
            ['Ceos-Web-Token' => 'valid-ceosweb-token-5678'] // falscher Header-Name
        );

        $response->assertStatus(401);
    }
}
