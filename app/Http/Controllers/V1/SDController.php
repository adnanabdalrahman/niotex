<?php

namespace App\Http\Controllers\V1;

use App\Exceptions\DBSaveException;
use App\Exceptions\InvalidJsonException;
use App\Exceptions\InvalidSapResponseException;
use App\Exceptions\ResourceNotFoundException;
use App\Helpers\SD_01_01_Validation;
use App\Helpers\SD_02_01_Validation;
use App\Http\Controllers\Controller;
use App\Http\Requests\SD_0102_beauftragungRueckmeldungRequest;
use App\Http\Requests\SD_0302_fakturiertedienstleistungsrechnungRequest;
use App\Services\SDServices;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;


class SDController extends Controller
{

    use ApiResponses;

    protected SDServices\SD_0101_Services $sd0101Services;
    protected SDServices\SD_0102_Services $sd0102Services;
    protected SDServices\SD_0201_Services $sd0201Services;
    protected SDServices\SD_03_01_Services $sd0301Services;
    protected SDServices\SD_03_02_Services $sd0302Services;

    public function __construct(
        SDServices\SD_0101_Services  $sd0101Services,
        SDServices\SD_0102_Services  $sd0102Services,
        SDServices\SD_0201_Services  $sd0201Services,
        SDServices\SD_03_01_Services $sd0301Services,
        SDServices\SD_03_02_Services $sd0302Services,
    )
    {
        $this->sd0101Services = $sd0101Services;
        $this->sd0102Services = $sd0102Services;
        $this->sd0201Services = $sd0201Services;
        $this->sd0301Services = $sd0301Services;
        $this->sd0302Services = $sd0302Services;
    }

    // SD-01-01: SAP-->CEOS, in SAP wird ein Kundenauftrag angelegt -
    // dieser wird auf Unvollständigkeit geprüft und danach wird CEOS mit den Daten positionsgenau beauftragt

    /**
     * SD-01-01 Beauftragung
     * Sap --> CEOS.
     * @param Request $request
     * @return JsonResponse
     * @throws DBSaveException
     * @throws InvalidJsonException|Throwable
     */
    public function sd_0101_beauftragung(Request $request): JsonResponse
    {
        $auftraege = $request->all();
        if (!$request->isJson() || empty($auftraege)) {
            throw new InvalidJsonException();
        }
        $report = ['success' => [], 'failed' => []];

        foreach ($auftraege as $auftrag) {
            $validator = Validator::make($auftrag, SD_01_01_Validation::rules(), SD_01_01_Validation::messages());
            $vbeln = $auftrag['header']['vbeln'] ?? 'unknown';
            if ($validator->fails()) {
                $report['failed'][] = [
                    'vbeln' => $vbeln,
                    'message' => $validator->errors()->toArray()
                ];
                continue;
            }
            try {
                $result = $this->sd0101Services->sd_0101_beauftragung($auftrag);
                if ($result) {
                    $report['success'][] = [
                        'vbeln' => $vbeln,
                        'data' => $result,
                        'message' => "Beauftragung $vbeln erfolgreich verarbeitet",
                    ];
                } else {
                    $report['failed'][] = [
                        'vbeln' => $vbeln,
                        'data' => $result,
                        'message' => "Beauftragung $vbeln konnte nicht verarbeitet werden",
                    ];
                }
            } catch (Throwable $e) {
                $errors = [];
                if (method_exists($e, 'getErrors')) {
                    $errors = $e->getErrors();
                }
                $report['failed'][] = [
                    'vbeln' => $vbeln,
                    'data' => $errors,
                    'message' => $e->getMessage(),
                ];
            }
        }
        return match (true) {
            empty($report['failed']) =>
            $this->successResponse('Alle Beauftragungen erfolgreich verarbeitet', $report, 202),

            empty($report['success']) =>
            $this->errorResponse('Keine Beauftragung konnte verarbeitet werden', $report, 400),

            default =>
            $this->multiStatusResponse('Einige Beauftragungen wurden nicht verarbeitet', $report),
        };
    }

    /**
     * @throws Throwable
     * @throws InvalidSapResponseException
     * @throws ResourceNotFoundException
     */
    public function sd_01_02_beauftragungRueckmeldung(SD_0102_beauftragungRueckmeldungRequest $request): JsonResponse
    {
        $response = $this->sd0102Services->sd_0102_beauftragung_rueckmeldung($request->validated());
        return $this->successResponse('Auftrag Status erfolgreich geändert', $response, 202);
    }

    // SD-02-01: SAP-->CEOS, Übergabe Werte aus Mietvertragsrechnungen an die CEOS

    /**
     * SD-02-01 Mietvertragsrechnungen
     * Receive rental contract invoice data from SAP.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws InvalidJsonException|Throwable
     */
    public function sd_02_01_mietvertragsrechnungen(Request $request): JsonResponse
    {
        $auftraege = $request->all();
        if (!$request->isJson() || empty($auftraege)) {
            throw new InvalidJsonException();
        }
        $report = ['success' => [], 'failed' => []];
        foreach ($auftraege as $auftrag) {
            $validator = Validator::make($auftrag, SD_02_01_Validation::rules(), SD_02_01_Validation::messages());
            $validator->sometimes(
                ['header.datumvon', 'header.datumbis'],
                'nullable|date',
                function ($input) {
                    return data_get($input, 'header.vbeln') === data_get($input, 'header.zuonr');
                }
            );
            $validator->sometimes(
                'header.datumvon',
                'required|date',
                function ($input) {
                    return data_get($input, 'header.vbeln') !== data_get($input, 'header.zuonr');
                }
            );
            $validator->sometimes(
                'header.datumbis',
                'required|date|after_or_equal:header.datumvon',
                function ($input) {
                    return data_get($input, 'header.vbeln') !== data_get($input, 'header.zuonr');
                }
            );
            $vbeln = $auftrag['header']['vbeln'] ?? 'unknown';
            if ($validator->fails()) {
                $report['failed'][] = [
                    'vbeln' => $vbeln,
                    'message' => $validator->errors()->all()
                ];
                continue;
            }
            try {
                $result = $this->sd0201Services->sd_0201_mietvertragsrechnungen($validator->validated());
                if ($result) {
                    // add Verkaufsbeleg to header & positions
                    $result['header']['Verkaufsbeleg'] = $vbeln;
                    foreach ($result['positions'] as &$pos) {
                        $pos['Verkaufsbeleg'] = $vbeln;
                    }
                    $report['success'][] = [
                        'vbeln' => $vbeln,
                        'data' => $result,
                        'message' => "Beauftragung $vbeln erfolgreich verarbeitet",
                    ];
                } else {
                    $report['failed'][] = [
                        'vbeln' => $vbeln,
                        'data' => $result,
                        'message' => "Beauftragung $vbeln konnte nicht verarbeitet werden",
                    ];
                }
                unset($pos);

            } catch (Throwable $e) {
                $errors = method_exists($e, 'getErrors') ? $e->getErrors() : [];
                $report['failed'][] = [
                    'vbeln' => $vbeln,
                    'data' => $errors,
                    'message' => $e->getMessage(),
                ];
            }
        }
        return match (true) {
            empty($report['failed']) =>
            $this->successResponse('Alle Beauftragungen erfolgreich verarbeitet', $report, 202),
            empty($report['success']) =>
            $this->errorResponse('Keine Beauftragung konnte verarbeitet werden', $report, 400),
            default =>
            $this->multiStatusResponse('Einige Beauftragungen wurden nicht verarbeitet', $report),
        };
    }

    /*
     *  SD-03-01 CEOS --> SAP
     *  Dienstleistungsrechnung
     */
    /**
     * @throws ResourceNotFoundException|Throwable
     */
    public function sd_03_01_dienstleistungsrechnung(Request $request)
    {
        $request->validate([
            'InterneVorgangsnummer' => 'required'
        ]);
        $response = $this->sd0301Services->sd_0301_dienstleistungsrechnung($request);
        return $this->successResponse("Dienstleistungsrechnung erfolgreich übernommen");
    }

    /**
     * SD-03-02 Fakturierte Dienstleistungsrechnung
     * SAP --> CEOS
     *
     * @param SD_0302_fakturiertedienstleistungsrechnungRequest $request
     * @return JsonResponse
     * @throws ResourceNotFoundException
     * @throws Throwable
     * /
     */
    public function sd_03_02_fakturiertedienstleistungsrechnung(SD_0302_fakturiertedienstleistungsrechnungRequest $request): JsonResponse
    {
        $response = $this->sd0302Services->sd_03_02_fakturiertedienstleistungsrechnung($request->validated());
        return $this->successResponse('Fakturierte Dienstleistungsrechnung erfolgreich verarbeitet.', $response);
    }
}



