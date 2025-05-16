<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Log;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

use App\OpenApi\Requests\MaterialstammdatenRequest;
use App\Http\Requests\MM_2201_SAPStockRequest;
use App\Http\Requests\MM_3101_materialStammdatenRequest;

use App\Services\MMServices;
use Illuminate\Http\JsonResponse;
use App\OpenApi\Responses\Success202;
use Illuminate\Validation\ValidationException;
#[OpenApi\PathItem]
class MMController extends Controller
{
    protected MMServices $mmServices;
    public function __construct(MMServices $mmServices)
    {
        $this->mmServices = $mmServices;
    }


    #[OpenApi\Operation(tags: ['MM'], method: 'POST')]
    #[OpenApi\RequestBody(factory: MaterialstammdatenRequest::class)]
    #[OpenApi\Response(factory: Success202::class)]

    /**
     * MM-31-1 Materialstammdaten
     * Receive material data from SAP.
     *
     * @param MM_3101_materialStammdatenRequest $request
     * @return JsonResponse
     */

    public function materialstammdaten(MM_3101_materialStammdatenRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            Log::info('Received SAP Material Data:', $validated);
            // Process the material data asynchronously

            // ProcessMaterialData::dispatch($validated);
            $data = $this->mmServices->mm_31_01_materialstammdaten($validated);

            return response()->json(['message' => 'Material erfolgreich gespeichert.', 'data' => $data], 202);
        } catch (ValidationException $e) {
            Log::error('Validation error:', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 400);
        }
    }


    /**
     * MM_34_01 Umlagerungsreservierung
     * CEOSWEB-->CEOS-->SAP
     *
     * @return JsonResponse
     */

    public function umlagerungsreservierung(): JsonResponse
    {
        try {
            // ProcessMaterialData::dispatch($validated);
            $data =  $this->mmServices->mm_34_01_umlagerungsreservierung();
            return response()->json(['data' => $data], 202);
        }  catch (\Exception $e) {
            Log::error('Internal error:', ['errors' => $e->getMessage()]);
            return response()->json(['message' => 'Internal error', 'errors' => $e->getMessage()], 500);
        }

    }


    public function materialverbrauch (): JsonResponse
    {
        try {
            return $this->mmServices->mm_35_02_materialverbrauch();
        } catch (\Exception $e) {
            Log::error('Internal error:', ['errors' => $e->getMessage()]);
            return response()->json(['message' => 'Internal error', 'errors' => $e->getMessage()], 500);
        }
    }




    /**
     * MM-22-1 Abfrage nach Lagerbestände
     * Get stock Level from SAP.
     *
     * @param MM_2201_SAPStockRequest $request
     * @return JsonResponse
     * @throws ConnectionException
     */
    public function lagerbestaende(MM_2201_SAPStockRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = $this->mmServices->mm_22_01_lagerbestaende(
            $validated['materials'],
            $validated['storage']
        );

        return response()->json($data);
    }
}
