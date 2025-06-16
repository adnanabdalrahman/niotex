<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SD_0302_fakturiertedienstleistungsrechnungRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'header' => 'required|array',
            'header.fakturaNummer' => 'required|string|max:4', // VBELN VorIndividualC1
            'header.liegenschaft' => 'nullable|string|max:9', // ZZLGSNR
            'header.vorgangsnummer' => 'required|string', //VORGN
            'header.VorgnInt' => 'required|string', //interneVorgangsnummer
            'header.vorlageBeleg' => 'nullable|numeric', //zuonr VorIndividualC7
            'header.nettoWert' => 'required|numeric', //NETWR
            'header.gesamtSteuerbetrag' => 'required|numeric', //MWSBK
            'header.kunnr' => 'required|string|max:10',

            'positions' => 'required|array|min:1',
            'positions.*.vorgangsnummer' => 'required|integer',
            'positions.*.positionsNummer' => 'required|integer',
            'positions.*.material' => 'required|string|max:18',
            'positions.*.menge' => 'required|numeric',
            'positions.*.nettoWertPosition' => 'required|numeric',
            'positions.*.steuerWertPosition' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'header.required' => 'Das Header-Feld ist erforderlich.',
            'header.fakturaNummer.required' => 'Feld "fakturaNummer" ist erforderlich.',
            'header.liegenschaft.required' => 'Feld "liegenschaft" ist erforderlich.',

            'header.vorgangsnummer.required' => 'Feld "vorgn" ist erforderlich.',
            'header.vorgangsnummer.integer' => '"vorgn" muss eine ganze Zahl sein.',
            'header.vorgnInt.required' => 'Feld "vorgnInt" ist erforderlich.',
            'header.vorlageBeleg.required' => 'Feld "vorlageBeleg" ist erforderlich.',

            'header.nettoWert.required' => 'Feld "netwr" ist erforderlich.',
            'header.nettoWert.numeric' => '"netwr" muss eine Zahl sein.',
            'header.gesamtSteuerbetrag.required' => 'Feld "mwsbk" ist erforderlich.',
            'header.gesamtSteuerbetrag.numeric' => '"mwsbk" muss eine Zahl sein.',

            'header.kunnr.required' => 'Die Kundennummer (kunnr) ist erforderlich.',
            'header.kunnr.string' => 'Die Kundennummer (kunnr) muss ein Text sein.',
            'header.kunnr.max' => 'Die Kundennummer (kunnr) darf maximal 10 Zeichen lang sein.',

            'positions.required' => 'Die Liste der Positionen ("positions") ist erforderlich.',
            'positions.array' => 'Die Positionen ("positions") müssen ein Array sein.',

            'positions.*.vorgangsnummer.required' => 'Feld "vorgangsnummer" in einer Position ist erforderlich.',
            'positions.*.vorgnInt.required' => 'Feld "vorgnInt" in einer Position ist erforderlich.',
            'positions.*.positionsNummer.required' => 'Feld "positionsNummer" in einer Position ist erforderlich.',
            'positions.*.material.required' => 'Die Materialnummer ("Matnr") ist für jede Position erforderlich.',
            'positions.*.material.string' => 'Die Materialnummer ("Matnr") muss ein String sein.',
            'positions.*.menge.required' => 'Die Menge ("Kwmeng") ist für jede Position erforderlich.',
            'positions.*.menge.numeric' => 'Die Menge ("Kwmeng") muss eine Zahl sein.',
            'positions.*.nettoWertPosition.required' => 'Feld "nettoWertPosition" in einer Position ist erforderlich.',
            'positions.*.steuerWertPosition.required' => 'Feld "steuerWertPosition" in einer Position ist erforderlich.',
        ];
    }
}
