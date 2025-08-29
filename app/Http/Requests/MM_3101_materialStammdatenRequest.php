<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class MM_3101_materialStammdatenRequest extends FormRequest
{
    public function prepareForValidation(): void
    {
        Log::info('MM_3101_materialStammdaten Received Payload', [
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

    public function messages(): array
    {
        return [
            'required' => 'Das Feld ":attribute" ist erforderlich.',
            'numeric' => 'Das Feld ":attribute" muss eine Zahl sein.',
            'string' => 'Das Feld ":attribute" muss ein Text sein.',
            'max' => 'Das Feld ":attribute" darf maximal :max Zeichen enthalten.',
            'digits' => 'Das Feld ":attribute" muss genau :digits Ziffern enthalten.',
        ];
    }
}
