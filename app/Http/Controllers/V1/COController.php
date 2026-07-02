<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CO_0101_ZeiteinheitenRequest;
use App\Services\COServices;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Throwable;

class COController extends Controller
{
    use ApiResponses;

    protected COServices\CO_01_01_Services $co0101Services;

    public function __construct(COServices\CO_01_01_Services $co0101Services)
    {
        $this->co0101Services = $co0101Services;
    }

    // CO-01-01: CEOS --> SAP, Zeiteinheiten

    /**
     * SD-01-01 Beauftragung
     * Sap --> CEOS.
     *
     * @param CO_0101_ZeiteinheitenRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function co_01_01_Zeiteinheiten(CO_0101_ZeiteinheitenRequest $request)
    {
        $response = $this->co0101Services->co_01_01_Zeiteinheiten($request->validated());
        return $this->successResponse('Zeiteinheiten erfolgreich gespeichert', $response, 202);
    }
}
