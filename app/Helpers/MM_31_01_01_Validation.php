<?php

namespace App\Helpers;

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
            'required' => 'Das Feld ":attribute" ist erforderlich.',
            'nullable' => 'Das Feld ":attribute" ist optional.',
            'string' => 'Das Feld ":attribute" muss ein Text sein.',
            'max' => 'Das Feld ":attribute" darf maximal :max Zeichen enthalten.',
            'min' => 'Das Feld ":attribute" muss mindestens :min Elemente enthalten.',
            'size' => 'Das Feld ":attribute" muss genau :size Zeichen lang sein.',
            'numeric' => 'Das Feld ":attribute" muss ein nummer sein.',
            'boolean' => 'Das Feld ":attribute" muss entweder true oder false sein.',
            'integer' => 'Das Feld ":attribute" muss eine ganze Zahl sein.',
            'array' => 'Das Feld ":attribute" muss ein Array sein.',
            'date' => 'Das Feld ":attribute" muss ein gültiges Datum sein.',
        ];
    }


}
