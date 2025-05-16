<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MM_3101_materialStammdatenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {


        /*
            'KZArtikelgruppe' => 'required|string',
            'KZWarengruppe' => 'required|string',
            'Artikelnummer' => 'required|string',
            'NRPreisbasis' => 'required|integer',
            'MwstNummer' => 'required|integer',
            'ArtVerkaufspreis1' => 'required|numeric',
            'ArtMaterialkosten' => 'required|numeric',
            'ArtSondereinzelkosten' => 'required|numeric',
            'ArtFertigungskosten' => 'required|numeric',
            'ArtStkAuftragLagerbuchung' => 'required|integer',
        */


        return [
            'Material' => 'required|numeric|digits:18',
            'Materialkurztext' => 'required|numeric|min:0',
            'Basismengeneinheit' => 'required|string|size:2',
            'Bezeichnung1' => 'required|string|max:255',
            'Bezeichnung2' => 'nullable|string|max:255',
            'Ean' => 'nullable|string|max:50',
            'Erloescode' => 'required|integer|min:0',
            'Langtext' => 'nullable|string|max:1000',
            'LVorm' => 'nullable|boolean',
            'Matchcode' => 'nullable|string|max:100',
            'Mfrpn' => 'nullable|string|max:100',
            'Produktgruppe' => 'nullable|string|max:100',
            'Warengruppe' => 'nullable|string|max:100',
            /*
            Material 960000016

            Materialkurztext
            Warengruppe
            Bezeichnung1
            Bezeichnung2
            Basismengeneinheit
            Loeschvormerkung
            BK_Schluessel
            CEOS–Warengruppe
            CEOS_Artikelgruppe
            CEOS_Artikeluntergruppe
            MappingHIBE_HAWA1
            MappingHIBE_HAWA2
            MappingHIBE_HAWA3
            Produktgruppe CEOS
            Basisempfindlichkeit
            Hersteller
            Herstellerteilenummer
            EAN
            */

        ];
    }

    public function messages(): array
    {
        return [
            'Material.required' => 'Material number is required.',
            'Material.numeric' => 'Material number must be numeric.',
            'Material.digits' => 'Material number must be exactly 18 digits.',

            'Basisempfindlichkeit.required' => 'Basisempfindlichkeit is required.',
            'Basisempfindlichkeit.numeric' => 'Basisempfindlichkeit must be a number.',
            'Basisempfindlichkeit.min' => 'Basisempfindlichkeit must be a positive number.',

            'Basismengeneinheit.required' => 'Base unit is required.',
            'Basismengeneinheit.string' => 'Base unit must be a string.',
            'Basismengeneinheit.size' => 'Base unit must be exactly 2 characters.',

            'Bezeichnung1.required' => 'Primary description is required.',
            'Bezeichnung1.string' => 'Primary description must be a string.',
            'Bezeichnung1.max' => 'Primary description may not be greater than 255 characters.',

            'Bezeichnung2.string' => 'Secondary description must be a string.',
            'Bezeichnung2.max' => 'Secondary description may not be greater than 255 characters.',

            'Ean.string' => 'EAN must be a string.',
            'Ean.max' => 'EAN may not be greater than 50 characters.',

            'Erloescode.required' => 'Revenue code is required.',
            'Erloescode.integer' => 'Revenue code must be an integer.',
            'Erloescode.min' => 'Revenue code must be at least 0.',

            'Langtext.string' => 'Long text must be a string.',
            'Langtext.max' => 'Long text may not be greater than 1000 characters.',

            'LVorm.boolean' => 'LVorm must be true or false.',

            'Matchcode.string' => 'Matchcode must be a string.',
            'Matchcode.max' => 'Matchcode may not be greater than 100 characters.',

            'Mfrpn.string' => 'Manufacturer part number must be a string.',
            'Mfrpn.max' => 'Manufacturer part number may not be greater than 100 characters.',

            'Produktgruppe.string' => 'Product group must be a string.',
            'Produktgruppe.max' => 'Product group may not be greater than 100 characters.',

            'Warengruppe.string' => 'Material group must be a string.',
            'Warengruppe.max' => 'Material group may not be greater than 100 characters.',
        ];
    }
}
