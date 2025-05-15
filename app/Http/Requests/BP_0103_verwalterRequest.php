<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BP_0103_verwalterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'Geschaeftspartnernummer' => 'required',
            'Debitoren_Kreditorennummer' => 'required',
            'Anrede' => 'required|integer',
            'Titel' => 'required|integer',
            'Vorname' => 'required|string|max:40',
            'Nachname' => 'required|string|max:40',
            'Name1' => 'required|string|max:40',
            'Name2' => 'nullable|string|max:40',
            'Name3' => 'nullable|string|max:40',
            'Suchbegriff1' => 'nullable|string|max:10',
            'Suchbegriff2' => 'nullable|string|max:10',
            'Strasse' => 'required|string|max:60', // handled in PHP to split if over 40
            'Postleitzahl' => 'required|string|max:10',
            'Ort' => 'required|string|max:40',
            'Land' => 'required|string|size:2',
            'Postfach' => 'nullable|string|max:10',
            'Postleitzahl_Postfach' => 'nullable|string|max:10',
            'Ort_Postfach' => 'nullable|string|max:40',
            'Telefon' => 'nullable|string|max:40',
            'Mobiltelefon' => 'nullable|string|max:40',
            'Fax' => 'nullable|string|max:40',
            'Email' => 'nullable|email|max:80',
            'AutoWEAbr' => 'required|boolean',
            'Sperrkennzeichen' => 'required|boolean',
            'Kundengruppe' => 'required|string|max:2',
            'Kundengruppe12' => 'nullable|string|max:3',
            'UVI_Mailadresse' => 'nullable|email|max:80',
            'PDF_Mailadresse' => 'nullable|email|max:80',
        ];
    }

    public function messages(): array
    {
        return [
            'Geschaeftspartnernummer.required' => 'Partner number is required.',
            'Geschaeftspartnernummer.integer' => 'Partner number must be an integer.',

            'Debitoren_Kreditorennummer.required' => 'Customer number is required.',
            'Debitoren_Kreditorennummer.integer' => 'Customer number must be an integer.',

            'Anrede.required' => 'Salutation code is required.',
            'Titel.required' => 'Title code is required.',

            'Vorname.required' => 'First name is required.',
            'Vorname.max' => 'First name may not be greater than 40 characters.',

            'Nachname.required' => 'Last name is required.',
            'Nachname.max' => 'Last name may not be greater than 40 characters.',

            'Name1.required' => 'Name1 is required.',
            'Name1.max' => 'Name1 may not be greater than 40 characters.',

            'Strasse.required' => 'Street is required.',
            'Strasse.max' => 'Street may not be greater than 60 characters.',

            'Postleitzahl.required' => 'Postal code is required.',
            'Ort.required' => 'City is required.',
            'Land.required' => 'Country code is required.',
            'Land.size' => 'Country code must be exactly 2 characters.',

            'Email.email' => 'Email must be a valid address.',
            'UVI_Mailadresse.email' => 'UVI email must be valid.',
            'PDF_Mailadresse.email' => 'PDF email must be valid.',

            'AutoWEAbr.boolean' => 'AutoWEAbr must be true or false.',
            'Sperrkennzeichen.boolean' => 'Sperrkennzeichen must be true or false.',

            'Kundengruppe.max' => 'Kundengruppe may not be greater than 2 characters.',
            'Kundengruppe12.max' => 'Kundengruppe12 may not be greater than 3 characters.',
        ];
    }
}
