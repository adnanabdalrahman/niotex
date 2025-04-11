<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Jobs\MM\ProcessMaterialData;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

use App\OpenApi\Requests\MaterialstammdatenRequest;



#[OpenApi\PathItem]
class MMController extends Controller
{
    
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
     * @OpenAPI\Post(
     *     path="/v1/mm/lagerbestaende",
     *     summary="CEOS to SAP: Stock Query",
     *     description="Request stock data from CEOS to SAP.",
     *     operationId="lagerbestaende",
     *     tags={"MM"},
     *     @OpenAPI\RequestBody(
     *         required=true,
     *         @OpenAPI\JsonContent(
     *             required={"material", "plant", "sloc"},
     *             @OpenAPI\Property(property="material", type="integer", example=12345),
     *             @OpenAPI\Property(property="plant", type="string", example="Plant 1"),
     *             @OpenAPI\Property(property="sloc", type="string", example="Main Warehouse")
     *         )
     *     ),
     *     @OpenAPI\Response(
     *         response=200,
     *         description="Stock data received successfully",
     *         @OpenAPI\JsonContent(
     *             @OpenAPI\Property(property="message", type="string", example="Stock data received successfully")
     *         )
     *     )
     * )
     */
    public function lagerbestaende(Request $request)
    {
        $validated = $request->validate([
            'material'   => 'required|numeric|digits_between:1,18',
            'plant'      => 'required|String',
            'sloc'       => 'required|String',
        ]);

        Log::info('Received CEOS Stock Data:', $validated);

        return response()->json(['message' => 'Stock data received successfully'], 200);
    }
}
