<?php

namespace Tests\Unit;

use App\Exceptions\DBSaveException;
use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\ValidationFailedException;
use App\Exceptions\InvalidJsonException;
use App\Exceptions\CreationFailedException;
use App\Exceptions\InvalidSapResponseException;
use App\Exceptions\InvalidTaxRateException;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

/**
 * Unit Tests für alle Custom Exceptions.
 *
 * Prüft Default-Werte, Überschreibungen, render()-Ausgabe
 * und die getErrorCode()-Implementierung.
 */
class ExceptionsTest extends TestCase
{
    // =========================================================================
    // ValidationFailedException
    // =========================================================================

    public function test_validationFailed_default_values(): void
    {
        $ex = new ValidationFailedException();

        $this->assertEquals(422, $ex->getCode());
        $this->assertEquals('VALIDATION_FAILED', $ex->getErrorCode());
        $this->assertStringContainsString('ungültig', strtolower($ex->getMessage()));
    }

    public function test_validationFailed_custom_message_and_errors(): void
    {
        $errors = ['name' => ['Pflichtfeld']];
        $ex = new ValidationFailedException('Fehler!', $errors, 422);

        $this->assertEquals('Fehler!', $ex->getMessage());
        $this->assertEquals($errors, $ex->getErrors());
    }

    public function test_validationFailed_render_returns_json_response(): void
    {
        $ex = new ValidationFailedException('Ungültig', ['f' => ['e']], 422);
        $response = $ex->render();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $json = $response->getData(true);

        $this->assertEquals('error', $json['status']);
        $this->assertEquals('VALIDATION_FAILED', $json['code']);
        $this->assertEquals(422, $response->getStatusCode());
    }

    // =========================================================================
    // ResourceNotFoundException
    // =========================================================================

    public function test_resourceNotFound_default_values(): void
    {
        $ex = new ResourceNotFoundException();

        $this->assertEquals(404, $ex->getCode());
        $this->assertEquals('RESOURCE_NOT_FOUND', $ex->getErrorCode());
    }

    public function test_resourceNotFound_custom_message(): void
    {
        $ex = new ResourceNotFoundException('Artikel 12345 nicht gefunden');

        $this->assertEquals('Artikel 12345 nicht gefunden', $ex->getMessage());
        $this->assertEquals(404, $ex->getCode());
    }

    public function test_resourceNotFound_render_returns_404(): void
    {
        $ex = new ResourceNotFoundException();
        $response = $ex->render();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('RESOURCE_NOT_FOUND', $response->getData(true)['code']);
    }

    // =========================================================================
    // DBSaveException
    // =========================================================================

    public function test_dbSave_default_values(): void
    {
        $ex = new DBSaveException();

        $this->assertEquals(500, $ex->getCode());
        $this->assertEquals('RESOURCE_NOT_SAVED', $ex->getErrorCode());
    }

    public function test_dbSave_custom_message(): void
    {
        $ex = new DBSaveException('DB Verbindungsfehler');

        $this->assertEquals('DB Verbindungsfehler', $ex->getMessage());
    }

    public function test_dbSave_render_returns_500(): void
    {
        $ex = new DBSaveException();
        $response = $ex->render();

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals('RESOURCE_NOT_SAVED', $response->getData(true)['code']);
    }

    // =========================================================================
    // InvalidJsonException
    // =========================================================================

    public function test_invalidJson_has_correct_error_code(): void
    {
        $ex = new InvalidJsonException();

        $this->assertEquals('INVALID_JSON', $ex->getErrorCode());
    }

    public function test_invalidJson_render_returns_json(): void
    {
        $ex = new InvalidJsonException();
        $response = $ex->render();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals('error', $response->getData(true)['status']);
    }

    // =========================================================================
    // CreationFailedException
    // =========================================================================

    public function test_creationFailed_has_correct_error_code(): void
    {
        $ex = new CreationFailedException();

        $this->assertEquals('CREATION_FAILED', $ex->getErrorCode());
    }

    // =========================================================================
    // InvalidSapResponseException
    // =========================================================================

    public function test_invalidSapResponse_has_correct_error_code(): void
    {
        $ex = new InvalidSapResponseException();

        $this->assertEquals('INVALID_SAP_RESPONSE', $ex->getErrorCode());
    }

    // =========================================================================
    // InvalidTaxRateException
    // =========================================================================

    public function test_invalidTaxRate_has_correct_error_code(): void
    {
        $ex = new InvalidTaxRateException();

        $this->assertEquals('INVALID_TAX_RATE', $ex->getErrorCode());
    }

    // =========================================================================
    // Gemeinsame ApiException-Struktur
    // =========================================================================

    public function test_render_always_contains_meta_fields(): void
    {
        $exceptions = [
            new ValidationFailedException(),
            new ResourceNotFoundException(),
            new DBSaveException(),
        ];

        foreach ($exceptions as $ex) {
            $json = $ex->render()->getData(true);
            $this->assertArrayHasKey('meta', $json, get_class($ex) . ' fehlt meta');
            $this->assertArrayHasKey('timestamp', $json['meta']);
            $this->assertArrayHasKey('trace_id', $json['meta']);
        }
    }

    public function test_getErrors_returns_errors_array(): void
    {
        $errors = ['feld' => ['Pflichtfeld fehlt']];
        $ex = new ValidationFailedException('msg', $errors);

        $this->assertEquals($errors, $ex->getErrors());
    }

    public function test_empty_errors_by_default(): void
    {
        $ex = new ResourceNotFoundException('nicht gefunden');

        $this->assertEquals([], $ex->getErrors());
    }
}
