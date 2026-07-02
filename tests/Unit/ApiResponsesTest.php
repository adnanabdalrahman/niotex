<?php

namespace Tests\Unit;

use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

/**
 * Unit Tests für den ApiResponses Trait.
 *
 * Testet alle Response-Methoden auf korrekte Struktur,
 * HTTP-Status-Codes und JSON-Felder.
 */
class ApiResponsesTest extends TestCase
{
    // Anonyme Klasse, die den Trait einbindet
    private object $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new class {
            use ApiResponses;
        };
    }

    // -------------------------------------------------------------------------
    // successResponse
    // -------------------------------------------------------------------------

    public function test_successResponse_returns_200_by_default(): void
    {
        $response = $this->subject->successResponse('Alles gut');

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_successResponse_contains_expected_fields(): void
    {
        $response = $this->subject->successResponse('Alles gut', ['key' => 'value']);
        $json = $response->getData(true);

        $this->assertEquals('success', $json['status']);
        $this->assertEquals(200, $json['status_code']);
        $this->assertEquals('OK', $json['code']);
        $this->assertEquals('Alles gut', $json['message']);
        $this->assertEquals(['key' => 'value'], $json['data']);
        $this->assertArrayHasKey('meta', $json);
        $this->assertArrayHasKey('timestamp', $json['meta']);
        $this->assertArrayHasKey('trace_id', $json['meta']);
    }

    public function test_successResponse_with_custom_status_code(): void
    {
        $response = $this->subject->successResponse('Erstellt', [], 202);

        $this->assertEquals(202, $response->getStatusCode());
        $this->assertEquals(202, $response->getData(true)['status_code']);
    }

    public function test_successResponse_data_can_be_null(): void
    {
        $response = $this->subject->successResponse('OK');
        $json = $response->getData(true);

        $this->assertNull($json['data']);
    }

    // -------------------------------------------------------------------------
    // errorResponse
    // -------------------------------------------------------------------------

    public function test_errorResponse_returns_422_by_default(): void
    {
        $response = $this->subject->errorResponse('Fehler');

        $this->assertEquals(422, $response->getStatusCode());
    }

    public function test_errorResponse_contains_expected_fields(): void
    {
        $errors = ['field' => ['Pflichtfeld']];
        $response = $this->subject->errorResponse('Validierung fehlgeschlagen', $errors, 422);
        $json = $response->getData(true);

        $this->assertEquals('error', $json['status']);
        $this->assertEquals(422, $json['status_code']);
        $this->assertEquals('ERROR', $json['code']);
        $this->assertEquals('Validierung fehlgeschlagen', $json['message']);
        $this->assertEquals($errors, $json['errors']);
    }

    public function test_errorResponse_with_400(): void
    {
        $response = $this->subject->errorResponse('Ungültige Daten', [], 400);

        $this->assertEquals(400, $response->getStatusCode());
    }

    // -------------------------------------------------------------------------
    // multiStatusResponse
    // -------------------------------------------------------------------------

    public function test_multiStatusResponse_returns_207(): void
    {
        $response = $this->subject->multiStatusResponse('Teilweise erfolgreich', [
            'success' => [['id' => 1]],
            'failed'  => [['id' => 2]],
        ]);

        $this->assertEquals(207, $response->getStatusCode());
    }

    public function test_multiStatusResponse_contains_partial_status(): void
    {
        $response = $this->subject->multiStatusResponse('Teilweise erfolgreich');
        $json = $response->getData(true);

        $this->assertEquals('partial', $json['status']);
        $this->assertEquals('PARTIAL', $json['code']);
        $this->assertEquals(207, $json['status_code']);
    }

    // -------------------------------------------------------------------------
    // ok (shortcut)
    // -------------------------------------------------------------------------

    public function test_ok_returns_200(): void
    {
        $response = $this->subject->ok('Fertig');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', $response->getData(true)['status']);
    }

    // -------------------------------------------------------------------------
    // meta structure
    // -------------------------------------------------------------------------

    public function test_meta_contains_path_and_timestamp(): void
    {
        $response = $this->subject->successResponse('Test');
        $meta = $response->getData(true)['meta'];

        $this->assertArrayHasKey('path', $meta);
        $this->assertArrayHasKey('timestamp', $meta);
        $this->assertArrayHasKey('trace_id', $meta);
    }

    public function test_trace_id_is_unique_per_call(): void
    {
        $r1 = $this->subject->successResponse('A');
        $r2 = $this->subject->successResponse('B');

        $this->assertNotEquals(
            $r1->getData(true)['meta']['trace_id'],
            $r2->getData(true)['meta']['trace_id']
        );
    }
}
