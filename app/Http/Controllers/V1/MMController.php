<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Jobs\MM\ProcessMaterialData;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

use App\OpenApi\Requests\MaterialstammdatenRequest;
use App\Http\Requests\MM_221_SAPStockRequest;
use App\Services\SAPService;
use Illuminate\Http\JsonResponse;


#[OpenApi\PathItem]
class MMController extends Controller
{

    protected SAPService $sapService;

    public function __construct(SAPService $sapService)
    {
        $this->sapService = $sapService;
    }
    
    #[OpenApi\Operation(tags: ['MM'], method: 'POST')]
    #[OpenApi\RequestBody(factory: MaterialstammdatenRequest::class)]
    #[OpenApi\Response(factory: \App\OpenApi\Responses\Success202::class)]
    public function Materialstammdaten(Request $request)
    {
        try {
            $validated = $request->validate([
                'material'   => 'required|numeric|digits_between:1,18',
                'bezeichnung1' => 'required|String',
                'lvorm'          => 'required|boolean', 
            ]);  
    
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
     * @param MM_221_SAPStockRequest $request
     * @return JsonResponse
     */
    public function lagerbestaende(MM_221_SAPStockRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = $this->sapService->mm221_getStockLevels(
            $validated['materials'],
            $validated['storage']
        );

        return response()->json($data);
    }
}
