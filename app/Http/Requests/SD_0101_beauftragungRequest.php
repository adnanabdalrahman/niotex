<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SD_0101_beauftragungRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'header' => 'required|array',
            'header.auart' => 'required|string|max:10',
            'header.genrCeos' => 'required|integer',
            'header.kunnr' => 'required|string|max:20',
            'header.txtZ012' => 'nullable|string',
            'header.txtZ013' => 'nullable|string',
            'header.vbeln' => 'required|string|max:20',
            'header.vdatu' => 'required|date',
            'header.zzlgsnr' => 'nullable|string',
    
            'positions' => 'required|array|min:1',
            'positions.*.aufnr' => 'required|string|max:20',
            'positions.*.kondm' => 'required|string|max:10',
            'positions.*.kwmeng' => 'required|numeric|min:0',
            'positions.*.kwmengO' => 'nullable|numeric|min:0',
            'positions.*.matnr' => 'required|string|max:40',
            'positions.*.posErl' => 'nullable|integer',
            'positions.*.posnr' => 'required|integer',
            'positions.*.txtZ002' => 'nullable|string',
            'positions.*.txtZ009' => 'nullable|string',
            'positions.*.txtZ010' => 'nullable|string',
            'positions.*.vorgn' => 'nullable|integer',
            'positions.*.vrkme' => 'required|string|max:5',
        ];
    }

    public function messages(): array
    {
        return [
            'header.auart.required' => 'Das Feld "auart" (Bestellart) ist erforderlich.',
            'header.genrCeos.required' => 'Das Feld "genrCeos" ist erforderlich.',
            'header.kunnr.required' => 'Die Kundennummer ("kunnr") ist erforderlich.',
            'header.vbeln.required' => 'Die Verkaufsbelegnummer ("vbeln") ist erforderlich.',
            'header.vdatu.required' => 'Das Bestelldatum ("vdatu") ist erforderlich.',
            'header.vdatu.date' => 'Das Bestelldatum ("vdatu") muss ein gültiges Datum sein.',
            
            'positions.required' => 'Die Liste der Positionen ("positions") ist erforderlich.',
            'positions.array' => 'Die Positionen ("positions") müssen ein Array sein.',
            'positions.*.aufnr.required' => 'Die Auftragsnummer ("aufnr") ist für jede Position erforderlich.',
            'positions.*.kondm.required' => 'Der Konditionstyp ("kondm") ist für jede Position erforderlich.',
            'positions.*.kwmeng.required' => 'Die Menge ("kwmeng") ist für jede Position erforderlich.',
            'positions.*.kwmeng.numeric' => 'Die Menge ("kwmeng") muss eine Zahl sein.',
            'positions.*.matnr.required' => 'Die Materialnummer ("matnr") ist für jede Position erforderlich.',
            'positions.*.matnr.string' => 'Die Materialnummer ("matnr") muss ein String sein.',
            'positions.*.posnr.required' => 'Die Positionsnummer ("posnr") ist für jede Position erforderlich.',
            'positions.*.posnr.integer' => 'Die Positionsnummer ("posnr") muss eine ganze Zahl sein.',
            'positions.*.vrkme.required' => 'Die Maßeinheit ("vrkme") ist für jede Position erforderlich.',
            'positions.*.vrkme.string' => 'Die Maßeinheit ("vrkme") muss ein String sein.',
        ];
    }
    
}
