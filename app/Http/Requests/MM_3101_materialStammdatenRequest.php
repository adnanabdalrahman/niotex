<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationFailedException;
use Illuminate\Contracts\Validation\Validator;
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
            'nullable' => 'Das Feld ":attribute" ist optional.',
            'string' => 'Das Feld ":attribute" muss ein Text sein.',
            'max' => 'Das Feld ":attribute" darf maximal :max Zeichen enthalten.',
            'min' => 'Das Feld ":attribute" muss mindestens :min Elemente enthalten.',
            'size' => 'Das Feld ":attribute" muss genau :size Zeichen lang sein.',
            'numeric' => 'Das Feld ":attribute" muss ein nummer sein.',
            'email' => 'Das Feld ":attribute" muss eine gültige E-Mail-Adresse sein.',
            'in' => 'Das Feld ":attribute" muss einen gültigen Wert enthalten.',
            'date' => 'Das Feld ":attribute" muss ein gültiges Datum sein.',
            'digits_between' => 'Das Feld ":attribute" muss zwischen :min und :max Ziffern enthalten.',
            'array' => 'Das Feld ":attribute" muss ein Array sein.',
            'digits' => 'Das Feld :attribute muss genau :digits Ziffern enthalten.',
            'after_or_equal' => 'Das Feld :attribute muss nach oder gleich dem Feld :date liegen.',
            'date_format' => 'Das Feld ":attribute" muss im Format :format vorliegen.',
            'boolean' => 'Das Feld ":attribute" muss entweder true oder false sein.',
            'integer' => 'Das Feld ":attribute" muss eine ganze Zahl sein.',
        ];
    }

    /**
     * @throws ValidationFailedException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();
        $message = "Validierung fehlgeschlagen.";
        throw new ValidationFailedException($message, $errors, 422,);
    }
}
