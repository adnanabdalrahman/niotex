<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class BP_0103_verwalterRequest extends FormRequest
{


    public function prepareForValidation(): void
    {
        Log::info('BP_0103_verwalter Received Payload', [
            'data' => $this->all()
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'Adressnummer' => 'required|string|max:30',
            'Geschaeftspartnernummer' => 'required',
            'LVorm' => 'nullable|string',
            'Titel' => 'nullable|string',
            'Anrede' => 'nullable|string',
            'Vorname' => 'required|string|max:40',
            'Nachname' => 'nullable|string|max:40',
            'Strasse' => 'required|string|max:40', //todo muss max 70
            'Postleitzahl' => 'required|string|max:10',
            'Ort' => 'required|string|max:40',
            'Telefon' => 'nullable|string|max:40',
            'Mobiltelefon' => 'nullable|string|max:40',
            'Fax' => 'nullable|string|max:40',
            'EMail' => 'nullable|email|max:80',
            'GueltigVon' => 'nullable|string',
            'GueltigBis' => 'nullable|string',
            'Ansprechpartner1' => 'nullable|string|max:10',
            'Ansprechpartner2' => 'nullable|string|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Das Feld ":attribute" ist erforderlich.',
            'string' => 'Das Feld ":attribute" muss ein Text sein.',
            'max' => 'Das Feld ":attribute" darf maximal :max Zeichen enthalten.',
            'email' => 'Das Feld ":attribute" muss eine gültige E-Mail-Adresse sein.',
        ];
    }
}
