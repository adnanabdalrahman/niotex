<?php

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\SE_2601_ReparaturauftragRequest;
use App\Services\SEServices;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Throwable;


class SEController extends Controller
{
    use ApiResponses;

    protected SEServices\SE_26_01_Services $se2601Services;

    public function __construct(SEServices\SE_26_01_Services $se2601Services)
    {
        $this->se2601Services = $se2601Services;
    }

    // SE-26-01: CEOSWeb--> Ceos -> SAP, Reparaturauftrag

    /**
     * @throws Throwable
     */
    public function se_26_01_Reparaturauftrag(SE_2601_ReparaturauftragRequest $request): JsonResponse
    {
        $response = $this->se2601Services->se_26_01_Reparaturauftrag($request->validated());
        return $this->successResponse('se_26_01_Reparaturauftrag erfolgreich gesendet', $response, 202);
    }

}
