<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class CO_0101_ZeiteinheitenRequest extends FormRequest
{

    public function prepareForValidation(): void
    {
        Log::info('CO_0101_ZeiteinheitenRequest Received Payload', [
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
            'InterneVorgangsnummer' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Das Feld ":attribute" ist erforderlich.',
            'string' => 'Das Feld ":attribute" muss ein Text sein.',
            'numeric' => 'Das Feld ":attribute" muss eine Zahl sein.',
            'in' => 'Das Feld ":attribute" muss einen gültigen Wert enthalten.',
            'date' => 'Das Feld ":attribute" muss ein gültiges Datum sein.',
            'max' => 'Das Feld ":attribute" darf maximal :max Zeichen haben.',
            'digits_between' => 'Das Feld ":attribute" muss zwischen :min und :max Ziffern enthalten.',
            'array' => 'Das Feld ":attribute" muss ein Array sein.',
        ];
    }
}
