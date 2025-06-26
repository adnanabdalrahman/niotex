<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class SD_0302_fakturiertedienstleistungsrechnungRequest extends FormRequest
{
    public function prepareForValidation(): void
    {
        Log::info('SD_0302_fakturiertedienstleistungsrechnung Received Payload', [
            'data' => $this->all()
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'header' => 'required|array',
            'header.fakturanummer' => 'required|string', // VBELN VorIndividualC1
            'header.liegenschaft' => 'nullable|string', // ZZLGSNR
            'header.vorgangsnummer' => 'required|int', //VORGN
            'header.vorgangsnummerInt' => 'required|int', //interneVorgangsnummer
            'header.vorlagebeleg' => 'nullable|numeric', //zuonr VorIndividualC7
            'header.nettowert' => 'required|numeric', //NETWR
            'header.gesamtsteuerbetrag' => 'required|numeric', //MWSBK
            'header.kunnr' => 'required|string|max:10',
            'header.datumvon' => 'required|date',
            'header.datumbis' => 'required|date|after_or_equal:header.datumvon',


            'positions' => 'required|array|min:1',
            'positions.*.vorgangsnummer' => 'required|integer',
            'positions.*.positionsnummer' => 'required|integer',
            'positions.*.material' => 'required|string|max:18',
            'positions.*.menge' => 'required|numeric',
            'positions.*.nettowertposition' => 'required|numeric',
            'positions.*.steuerwertposition' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'header.required' => 'Das Header-Feld ist erforderlich.',
            'header.fakturanummer.required' => 'Feld "fakturanummer" ist erforderlich.',
            'header.vorgangsnummerInt.required' => 'Feld "vorgangsnummerInt" ist erforderlich.',
            'header.liegenschaft.required' => 'Feld "liegenschaft" ist erforderlich.',

            'header.vorgangsnummer.required' => 'Feld "vorgn" ist erforderlich.',
            'header.vorgangsnummer.integer' => '"vorgn" muss eine ganze Zahl sein.',
            'header.vorgnInt.required' => 'Feld "vorgnInt" ist erforderlich.',
            'header.vorlagebeleg.required' => 'Feld "vorlageBeleg" ist erforderlich.',

            'header.nettowert.required' => 'Feld "netwr" ist erforderlich.',
            'header.nettowert.numeric' => '"netwr" muss eine Zahl sein.',
            'header.gesamtsteuerbetrag.required' => 'Feld "mwsbk" ist erforderlich.',
            'header.gesamtsteuerbetrag.numeric' => '"mwsbk" muss eine Zahl sein.',

            'header.kunnr.required' => 'Die Kundennummer (kunnr) ist erforderlich.',
            'header.kunnr.string' => 'Die Kundennummer (kunnr) muss ein Text sein.',
            'header.kunnr.max' => 'Die Kundennummer (kunnr) darf maximal 10 Zeichen lang sein.',

            'header.datumvon.required' => 'Feld "datumvon" ist erforderlich.',
            'header.datumvon.date' => '"datumvon" muss ein gültiges Datum sein.',
            'header.datumbis.required' => 'Feld "datumbis" ist erforderlich.',
            'header.datumbis.date' => '"datumbis" muss ein gültiges Datum sein.',
            'header.datumbis.after_or_equal' => '"datumbis" muss gleich oder nach "datumvon" sein.',


            'positions.required' => 'Die Liste der Positionen ("positions") ist erforderlich.',
            'positions.array' => 'Die Positionen ("positions") müssen ein Array sein.',

            'positions.*.vorgangsnummer.required' => 'Feld "vorgangsnummer" in einer Position ist erforderlich.',
            'positions.*.vorgnInt.required' => 'Feld "vorgnInt" in einer Position ist erforderlich.',
            'positions.*.positionsnummer.required' => 'Feld "positionsnummer" in einer Position ist erforderlich.',
            'positions.*.material.required' => 'Die Materialnummer ("Matnr") ist für jede Position erforderlich.',
            'positions.*.material.string' => 'Die Materialnummer ("Matnr") muss ein String sein.',
            'positions.*.menge.required' => 'Die Menge ("Kwmeng") ist für jede Position erforderlich.',
            'positions.*.menge.numeric' => 'Die Menge ("Kwmeng") muss eine Zahl sein.',
            'positions.*.nettowertposition.required' => 'Feld "nettowertposition" in einer Position ist erforderlich.',
            'positions.*.steuerwertposition.required' => 'Feld "steuerwertposition" in einer Position ist erforderlich.',
        ];
    }
}
