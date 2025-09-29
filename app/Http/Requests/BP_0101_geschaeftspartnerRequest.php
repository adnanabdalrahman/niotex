<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationFailedException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BP_0101_geschaeftspartnerRequest extends FormRequest
{

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
            'Geschaeftspartnernummer' => 'required|numeric',
            'DebitorenKreditorennummer' => 'required|numeric',
            'Anrede' => 'nullable|digits:4',
            'Titel' => 'nullable|string|max:20',
            'Vorname' => 'nullable|string|max:40',
            'Nachname' => 'nullable|string|max:40',
            'Name1' => 'nullable|string|max:40',
            'Name2' => 'nullable|string|max:40',
            'Name3' => 'nullable|string|max:40',
            'Suchbegriff1' => 'nullable|string|max:40',
            'Suchbegriff2' => 'nullable|string',
            'Strasse' => 'nullable|string|max:60',
            'Postleitzahl' => 'nullable|string|max:10',
            'PostleitzahlPostfach' => 'nullable|string|max:10',
            'Adresstyp' => 'required|string|max:4',
            'Ort' => 'nullable|string|max:40',
            'Land' => 'nullable|string|size:2',
            'Postfach' => 'nullable|string|max:10',
            'OrtPostfach' => 'nullable|string|max:40',
            'Telefon' => 'nullable|string|max:40',
            'Mobiltelefon' => 'nullable|string|max:40',
            'Fax' => 'nullable|string|max:40',
            'EMail' => 'nullable|email|max:100',
            'AutoWEAbr' => 'nullable|string|max:1',
            'Sperrkennzeichen' => 'nullable|string|max:1',
            'Loeschvormerkung' => 'nullable|string|max:1',
            'Kundengruppe' => 'nullable|string|max:2',
            'Kundengruppe1' => 'nullable|string|max:3',
            'UVIMailadresse' => 'nullable|email|max:100',
            'PDFMailadresse' => 'nullable|email|max:100',
            'GueltigVon' => 'nullable|date',
            'GueltigBis' => 'nullable|date|after_or_equal:GueltigVon',
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
        $message = "BP creation validation failed.";
        throw new ValidationFailedException($message, $errors, 422,);
    }

    /**
     * @throws ValidationFailedException
     */
    protected function getValidatorInstance(): Validator
    {
        $content = $this->getContent();

        json_decode($content);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ValidationFailedException(
                'Ungültiges JSON: ' . json_last_error_msg(),
                [],
                400
            );
        }
        return parent::getValidatorInstance();
    }
}
