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
        return [
            'Material' => 'required|numeric|digits:18',
            'Materialkurztext' => 'required|string|max:40',
            'Warengruppe' => 'required|string|max:9',
            'Bezeichnung1' => 'required|string|max:100',
            'Bezeichnung2' => 'nullable|string|max:50',
            'Basismengeneinheit' => 'required|string|max:3',
            'LVorm' => 'nullable|boolean',
            'BKSchluessel' => 'nullable|string|max:3',
            'CEOSWarengruppe' => 'required|string|max:4',
            'CEOSArtikelgruppe' => 'required|string|max:10',
            'CEOSArtikeluntergruppe' => 'nullable|string|max:10',
            'MappingHIBE_HAWA1' => 'nullable|string|max:18',
            'MappingHIBE_HAWA2' => 'nullable|string|max:18',
            'MappingHIBE_HAWA3' => 'nullable|string|max:18',
            'Produktgruppe' => 'nullable|string|max:4',
            'Basisempfindlichkeit' => 'required|numeric',
            'Hersteller' => 'nullable|string|max:10',
            'Herstellerteilenummer' => 'nullable|string|max:40',
            'EANNummerSAP' => 'nullable|string|max:16',
            'Langtext' => 'nullable|string|max:1000',
            //todo Matchcode not exist in Doc
            'Matchcode' => 'nullable|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            [
                'Material.required' => 'Das Feld "Material" ist erforderlich.',
                'Material.numeric' => 'Das Feld "Material" muss eine Zahl sein.',
                'Material.digits' => 'Das Feld "Material" muss genau 18 Stellen haben.',

                'Materialkurztext.required' => 'Das Feld "Materialkurztext" ist erforderlich.',
                'Materialkurztext.string' => 'Das Feld "Materialkurztext" muss eine Zeichenkette sein.',
                'Materialkurztext.max' => 'Das Feld "Materialkurztext" darf maximal 40 Zeichen lang sein.',

                'Warengruppe.required' => 'Das Feld "Warengruppe" ist erforderlich.',
                'Warengruppe.string' => 'Das Feld "Warengruppe" muss eine Zeichenkette sein.',
                'Warengruppe.max' => 'Das Feld "Warengruppe" darf maximal 9 Zeichen lang sein.',

                'Bezeichnung1.required' => 'Das Feld "Bezeichnung1" ist erforderlich.',
                'Bezeichnung1.string' => 'Das Feld "Bezeichnung1" muss eine Zeichenkette sein.',
                'Bezeichnung1.max' => 'Das Feld "Bezeichnung1" darf maximal 100 Zeichen lang sein.',

                'Bezeichnung2.string' => 'Das Feld "Bezeichnung2" muss eine Zeichenkette sein.',
                'Bezeichnung2.max' => 'Das Feld "Bezeichnung2" darf maximal 50 Zeichen lang sein.',

                'Basismengeneinheit.required' => 'Das Feld "Basismengeneinheit" ist erforderlich.',
                'Basismengeneinheit.string' => 'Das Feld "Basismengeneinheit" muss eine Zeichenkette sein.',
                'Basismengeneinheit.max' => 'Das Feld "Basismengeneinheit" darf maximal 3 Zeichen lang sein.',

                'LVorm.boolean' => 'Das Feld "LVorm" muss true oder false sein.',

                'BKSchluessel.required' => 'Das Feld "BKSchluessel" ist erforderlich.',
                'BKSchluessel.string' => 'Das Feld "BKSchluessel" muss eine Zeichenkette sein.',
                'BKSchluessel.max' => 'Das Feld "BKSchluessel" darf maximal 3 Zeichen lang sein.',

                'CEOSWarengruppe.required' => 'Das Feld "CEOSWarengruppe" ist erforderlich.',
                'CEOSWarengruppe.string' => 'Das Feld "CEOSWarengruppe" muss eine Zeichenkette sein.',
                'CEOSWarengruppe.max' => 'Das Feld "CEOSWarengruppe" darf maximal 4 Zeichen lang sein.',

                'CEOSArtikelgruppe.required' => 'Das Feld "CEOSArtikelgruppe" ist erforderlich.',
                'CEOSArtikelgruppe.string' => 'Das Feld "CEOSArtikelgruppe" muss eine Zeichenkette sein.',
                'CEOSArtikelgruppe.max' => 'Das Feld "CEOSArtikelgruppe" darf maximal 10 Zeichen lang sein.',

                'CEOSArtikeluntergruppe.string' => 'Das Feld "CEOSArtikeluntergruppe" muss eine Zeichenkette sein.',
                'CEOSArtikeluntergruppe.max' => 'Das Feld "CEOSArtikeluntergruppe" darf maximal 10 Zeichen lang sein.',

                'MappingHIBE_HAWA1.string' => 'Das Feld "MappingHIBE_HAWA1" muss eine Zeichenkette sein.',
                'MappingHIBE_HAWA1.max' => 'Das Feld "MappingHIBE_HAWA1" darf maximal 18 Zeichen lang sein.',

                'MappingHIBE_HAWA2.string' => 'Das Feld "MappingHIBE_HAWA2" muss eine Zeichenkette sein.',
                'MappingHIBE_HAWA2.max' => 'Das Feld "MappingHIBE_HAWA2" darf maximal 18 Zeichen lang sein.',

                'MappingHIBE_HAWA3.string' => 'Das Feld "MappingHIBE_HAWA3" muss eine Zeichenkette sein.',
                'MappingHIBE_HAWA3.max' => 'Das Feld "MappingHIBE_HAWA3" darf maximal 18 Zeichen lang sein.',

                'Produktgruppe.string' => 'Das Feld "Produktgruppe" muss eine Zeichenkette sein.',
                'Produktgruppe.max' => 'Das Feld "Produktgruppe" darf maximal 4 Zeichen lang sein.',

                'Basisempfindlichkeit.required' => 'Das Feld "Basisempfindlichkeit" ist erforderlich.',
                'Basisempfindlichkeit.numeric' => 'Das Feld "Basisempfindlichkeit" muss eine Zahl sein.',

                'Hersteller.string' => 'Das Feld "Hersteller" muss eine Zeichenkette sein.',
                'Hersteller.max' => 'Das Feld "Hersteller" darf maximal 10 Zeichen lang sein.',

                'Herstellerteilenummer.string' => 'Das Feld "Herstellerteilenummer" muss eine Zeichenkette sein.',
                'Herstellerteilenummer.max' => 'Das Feld "Herstellerteilenummer" darf maximal 40 Zeichen lang sein.',

                'EANNummerSAP.string' => 'Das Feld "EANNummerSAP" muss eine Zeichenkette sein.',
                'EANNummerSAP.max' => 'Das Feld "EANNummerSAP" darf maximal 16 Zeichen lang sein.',
            ]
        ];
    }
}
