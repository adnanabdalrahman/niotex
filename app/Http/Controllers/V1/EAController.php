<?php

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\EA_0201_FileExchangeRequest;
use App\Http\Requests\EA_0201_FileListRequest;
use App\Services\EAServices\EA_01_01_FileExchange;
use App\Services\EAServices\EA_02_01_ListDokumente;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;


class EAController extends Controller
{
    protected EA_02_01_ListDokumente $ea0201ListDokumente;
    protected EA_01_01_FileExchange $ea0101FileExchange;

    public function __construct(
        EA_02_01_ListDokumente $ea0201ListDokumente,
        EA_01_01_FileExchange  $ea0101FileExchange
    )
    {
        $this->ea0201ListDokumente = $ea0201ListDokumente;
        $this->ea0101FileExchange = $ea0101FileExchange;
    }

    // EA-02-01: CEOS-->SAP, Reparaturauftrag
    public function EA_02_01_listFiles(EA_0201_FileListRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $response = $this->ea0201ListDokumente->EA_02_01_ListDokumente($validated);

        if ($response !== null) {
            Log::info('EA_02_01_listDokumenten erfolgreich gesendet');
            return response()->json([
                'status' => 'success',
                'message' => 'List erfolgreich angekommen',
                'data' => $response
            ]);
        }
        return response()->json(['message' => 'Liste erhalten fehlgeschlagen'], 400);
    }


    // EA-02-01: CEOS-->SAP, Reparaturauftrag
    public function EA_01_01_FileExchange(EA_0201_FileExchangeRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $response = $this->ea0101FileExchange->EA_01_01_FileExchange($validated);

        if ($response !== null) {
            Log::info('EA_02_01_listDokumenten erfolgreich gesendet');
            return response()->json([
                'status' => 'success',
                'message' => 'List erfolgreich angekommen',
                'data' => $response
            ]);
        }
        return response()->json(['message' => 'Liste erhalten fehlgeschlagen'], 400);
    }


}
