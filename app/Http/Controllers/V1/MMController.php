<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Jobs\MM\ProcessMaterialData;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

use App\OpenApi\Requests\MaterialstammdatenRequest;
use App\Http\Requests\MM_2201_SAPStockRequest;
use App\Http\Requests\MM_3101_materialStammdatenRequest;

use App\Services\MMServices;
use Illuminate\Http\JsonResponse;


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
    #[OpenApi\Response(factory: \App\OpenApi\Responses\Success202::class)]

    /**
     * MM-31-1 Materialstammdaten
     * Receive material data from SAP.
     *
     * @param MM_3101_materialStammdatenRequest $request
     * @return JsonResponse
     */

    public function Materialstammdaten(MM_3101_materialStammdatenRequest $request)
    {
        try {
            $validated = $request->validated();

            Log::info('Received SAP Material Data:', $validated);
            // Process the material data asynchronously

            ProcessMaterialData::dispatch($validated);
            
            return response()->json(['message' => 'Material data received and queued'], 202);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 400);
        }
    }


    /**
     * MM-22-1 Abfrage nach Lagerbestände
     * Get stock Level from SAP.
     *
     * @param MM_2201_SAPStockRequest $request
     * @return JsonResponse
     */
    public function lagerbestaende(MM_2201_SAPStockRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = $this->mmServices->mm_2201_getLagerbestaende(
            $validated['materials'],
            $validated['storage']
        );

        return response()->json($data);
    }
}
