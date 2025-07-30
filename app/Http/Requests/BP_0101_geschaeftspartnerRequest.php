<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class BP_0101_geschaeftspartnerRequest extends FormRequest
{

    public function prepareForValidation(): void
    {
        Log::info('BP_0101_geschaeftspartner Received Payload', [
            'data' => $this->all()
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Geschaeftspartnernummer' => 'required',
            'DebitorenKreditorennummer' => 'required',
            'Anrede' => 'nullable|string',
            'Titel' => 'nullable|string',
            'Vorname' => 'nullable|string|max:40',
            'Nachname' => 'nullable|string|max:40',
            'Name1' => 'nullable|string|max:40',
            'Name2' => 'nullable|string|max:40',
            'Name3' => 'nullable|string|max:40',
            'Suchbegriff1' => 'nullable|string',
            'Suchbegriff2' => 'nullable|string',
            'Strasse' => 'nullable|string|max:60', // handled in PHP to split if over 40
            'Postleitzahl' => 'nullable|string|max:10',
            'Adresstyp' => 'required|string|max:4',
            'Ort' => 'nullable|string|max:40',
            'Land' => 'nullable|string|size:2',
            'Postfach' => 'nullable|string|max:10',
            'PostleitzahlPostfach' => 'nullable|string|max:10',
            'OrtPostfach' => 'nullable|string|max:40',
            'Telefon' => 'nullable|string|max:40',
            'Mobiltelefon' => 'nullable|string|max:40',
            'Fax' => 'nullable|string|max:40',
            'EMail' => 'nullable',
            'AutoWEAbr' => 'nullable|string',
            'Sperrkennzeichen' => 'nullable|string',
            'Kundengruppe' => 'nullable|string|max:2',
            'Kundengruppe1' => 'nullable|string|max:3',
            'UVIMailadresse' => 'nullable',
            'PDFMailadresse' => 'nullable',
            'Loeschvormerkung' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Das Feld ":attribute" ist erforderlich.',
            'nullable' => 'Das Feld ":attribute" ist optional.',
            'string' => 'Das Feld ":attribute" muss ein Text sein.',
            'max' => 'Das Feld ":attribute" darf maximal :max Zeichen enthalten.',
            'size' => 'Das Feld ":attribute" muss genau :size Zeichen lang sein.',
        ];
    }
}
