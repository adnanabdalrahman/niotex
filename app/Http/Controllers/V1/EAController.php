<?php

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\EA_0201_FileListRequest;
use App\Services\EAServices\EA_02_01_ListDokumente;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;


class EAController extends Controller
{
    protected EA_02_01_ListDokumente $ea0201ListDokumente;

    public function __construct(
        EA_02_01_ListDokumente $ea0201ListDokumente
    )
    {
        $this->ea0201ListDokumente = $ea0201ListDokumente;
    }

    // EA-02-01: CEOS-->SAP, Reparaturauftrag
    public function EA_02_01_listDokumenten(EA_0201_FileListRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $response = $this->ea0201ListDokumente->EA_02_01_ListDokumente($validated);

        if ($response !== null) {
            Log::info('EA_02_01_listDokumenten erfolgreich gesendet');
            return response()->json([
                'status' => 'success',
                'message' => 'Menge erfolgreich gespeichert',
                'data' => $response
            ]);
        }
        return response()->json(['message' => 'Menge speichern fehlgeschlagen'], 400);
    }


}
