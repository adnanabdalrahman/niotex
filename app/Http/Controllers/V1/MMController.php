<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Jobs\MM\ProcessMaterialData;

class MMController extends Controller
{
    /**
     *mm-31-1: SAP-->CEOS, Materialstammdaten
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Materialstammdaten(Request $request)
    {
        $validated = $request->validate([
            'material'   => 'required|numeric|digits_between:1,18',
            'bezeichnung1' => 'required|String',
            'lvorm'          => 'required|boolean', 
        ]);        

        Log::info('Received SAP Material Data:', $validated);

        ProcessMaterialData::dispatch($validated);

        return response()->json(['message' => 'Material data received and queued'], 202);
    }



    /**
     * MM-22-1 CEOS → SAP (Abfrage Lagerbestände) 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
