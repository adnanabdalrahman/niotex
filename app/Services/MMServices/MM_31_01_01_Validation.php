<?php

namespace App\Services\MMServices;

class MM_31_01_01_Validation
{
    static public function rules(): array
    {
        return [
            'Material' => 'required|numeric|digits:18',
            'Materialkurztext' => 'required|string|max:40',
            'Warengruppe' => 'required|string|max:9',
            'Bezeichnung1' => 'required|string|max:100',
            'Bezeichnung2' => 'nullable|string|max:50',
            'Basismengeneinheit' => 'required|string|max:3',
            'LVorm' => 'nullable|string',
            'BKSchluessel' => 'nullable|string|max:3',
            'CEOSWarengruppe' => 'required|string|max:4',
            'CEOSArtikelgruppe' => 'required|string|max:10',
            'CEOSArtikeluntergruppe' => 'nullable|string|max:10',
            'CEOSHIBEzuHAWA1' => 'nullable|string|max:18',
            'CEOSHIBEzuHAWA2' => 'nullable|string|max:18',
            'CEOSHIBEzuHAWA3' => 'nullable|string|max:18',
            'Produktgruppe' => 'nullable|string|max:4',
            'Basisempfindlichkeit' => 'required|numeric',
            'Hersteller' => 'nullable|string|max:10',
            'Herstellerteilenummer' => 'nullable|string|max:40',
            'EANNummerSAP' => 'nullable|string|max:16',
            'Langtext' => 'nullable|string|max:1000',
            'Matchcode' => 'nullable|string|max:100',
        ];
    }


    static public function messages(): array
    {
        return [
            'Material.required' => 'Die Materialnummer ist erforderlich.',
            'Material.numeric' => 'Die Materialnummer muss eine Zahl sein.',
            'Material.digits' => 'Die Materialnummer muss genau 18 Ziffern enthalten.',
            'Materialkurztext.required' => 'Der Kurztext ist erforderlich.',
            'Materialkurztext.string' => 'Der Kurztext muss ein Text sein.',
            'Materialkurztext.max' => 'Der Kurztext darf maximal 40 Zeichen enthalten.',
            'Warengruppe.required' => 'Die Warengruppe ist erforderlich.',
            'Warengruppe.string' => 'Die Warengruppe muss ein Text sein.',
            'Warengruppe.max' => 'Die Warengruppe darf maximal 9 Zeichen enthalten.',
            'Bezeichnung1.required' => 'Bezeichnung1 ist erforderlich.',
            'Bezeichnung1.string' => 'Bezeichnung1 muss ein Text sein.',
            'Bezeichnung1.max' => 'Bezeichnung1 darf maximal 100 Zeichen enthalten.',
            'Bezeichnung2.string' => 'Bezeichnung2 muss ein Text sein.',
            'Bezeichnung2.max' => 'Bezeichnung2 darf maximal 50 Zeichen enthalten.',
            'Basismengeneinheit.required' => 'Basismengeneinheit ist erforderlich.',
            'Basismengeneinheit.string' => 'Basismengeneinheit muss ein Text sein.',
            'Basismengeneinheit.max' => 'Basismengeneinheit darf maximal 3 Zeichen enthalten.',
            'BKSchluessel.string' => 'BKSchluessel muss ein Text sein.',
            'BKSchluessel.max' => 'BKSchluessel darf maximal 3 Zeichen enthalten.',
            'CEOSWarengruppe.required' => 'CEOSWarengruppe ist erforderlich.',
            'CEOSWarengruppe.string' => 'CEOSWarengruppe muss ein Text sein.',
            'CEOSWarengruppe.max' => 'CEOSWarengruppe darf maximal 4 Zeichen enthalten.',
            'CEOSArtikelgruppe.required' => 'CEOSArtikelgruppe ist erforderlich.',
            'CEOSArtikelgruppe.string' => 'CEOSArtikelgruppe muss ein Text sein.',
            'CEOSArtikelgruppe.max' => 'CEOSArtikelgruppe darf maximal 10 Zeichen enthalten.',
            'CEOSArtikeluntergruppe.string' => 'CEOSArtikeluntergruppe muss ein Text sein.',
            'CEOSArtikeluntergruppe.max' => 'CEOSArtikeluntergruppe darf maximal 10 Zeichen enthalten.',
            'CEOSHIBEzuHAWA1.string' => 'CEOSHIBEzuHAWA1 muss ein Text sein.',
            'CEOSHIBEzuHAWA1.max' => 'CEOSHIBEzuHAWA1 darf maximal 18 Zeichen enthalten.',
            'CEOSHIBEzuHAWA2.string' => 'CEOSHIBEzuHAWA2 muss ein Text sein.',
            'CEOSHIBEzuHAWA2.max' => 'CEOSHIBEzuHAWA2 darf maximal 18 Zeichen enthalten.',
            'CEOSHIBEzuHAWA3.string' => 'CEOSHIBEzuHAWA3 muss ein Text sein.',
            'CEOSHIBEzuHAWA3.max' => 'CEOSHIBEzuHAWA3 darf maximal 18 Zeichen enthalten.',
            'Produktgruppe.string' => 'Produktgruppe muss ein Text sein.',
            'Produktgruppe.max' => 'Produktgruppe darf maximal 4 Zeichen enthalten.',
            'Basisempfindlichkeit.required' => 'Basisempfindlichkeit ist erforderlich.',
            'Basisempfindlichkeit.numeric' => 'Basisempfindlichkeit muss eine Zahl sein.',
            'Hersteller.string' => 'Hersteller muss ein Text sein.',
            'Hersteller.max' => 'Hersteller darf maximal 10 Zeichen enthalten.',
            'Herstellerteilenummer.string' => 'Herstellerteilenummer muss ein Text sein.',
            'Herstellerteilenummer.max' => 'Herstellerteilenummer darf maximal 40 Zeichen enthalten.',
            'EANNummerSAP.string' => 'EANNummerSAP muss ein Text sein.',
            'EANNummerSAP.max' => 'EANNummerSAP darf maximal 16 Zeichen enthalten.',
            'Langtext.string' => 'Langtext muss ein Text sein.',
            'Langtext.max' => 'Langtext darf maximal 1000 Zeichen enthalten.',
            'Matchcode.string' => 'Matchcode muss ein Text sein.',
            'Matchcode.max' => 'Matchcode darf maximal 100 Zeichen enthalten.',
        ];
    }


}
