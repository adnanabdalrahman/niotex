<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Jobs\MM\ProcessMaterialData;

class MMController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'material'   => 'required|numeric|digits_between:1,18',
            'bezeichnung1' => 'required|String',
            'lvorm'          => 'required|boolean', 
        ]);



        // $validated = $request->validate([
        //     'material_id'   => 'required|string',
        //     'type'          => 'required|in:new,update',
        //     'werk'          => 'required|string|in:1270', 
        //     'sales_channel' => 'required|string|in:02', 
        //     'material_type' => 'required|string|in:Hibe,Hawa,Dien',
        //     'deleted'       => 'boolean'
        // ]);

        // Material             String  18 Materialnummer   Immer numerisch, maximal 18 Stellen
        // Bezeichnung1         String 100 Bezeichnung Plenus
        // Bezeichnung2         String 50 Bezeichnung Plenus
        // Langtext             String Grunddatentext
        // Artikelgruppe        Integer 2 Notwendig in CEOS?
        
        // Hauptartikelgruppe   Integer  2 Notwendig in CEOS?
        // UoM                  String 3 Basismengeneinheit ISO Einheit im SAP (z.B. “ST”, “PCK”, …)
        // Erloescode           Integer 2 Materialgruppe 4  Notwendig in CEOS?
        // LVorm                Boolean  Löschvormerkung  
        // BKSchluessel         Integer 2 Materialgruppe 5
        // VKPreis              Dezimal Notwendig? Ermittlung im SAP muss definiert werden! Es gibt nicht “den” Verkaufspreis.

        

        Log::info('Received SAP Material Data:', $validated);

        ProcessMaterialData::dispatch($validated);

        return response()->json(['message' => 'Material data received and queued'], 202);
    }
}
