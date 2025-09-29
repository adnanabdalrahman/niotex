<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationFailedException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SD_0302_fakturiertedienstleistungsrechnungRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'header' => 'required|array',
            'header.fakturanummer' => 'required|string', // VBELN VorIndividualC1
            'header.liegenschaft' => 'nullable|string', // ZZLGSNR
            'header.vorgangsnummer' => 'required|int', //VORGN
            'header.vorgangsnummerInt' => 'required|int', //interneVorgangsnummer
            'header.vorlagebeleg' => 'nullable|numeric', //zuonr VorIndividualC7
            'header.nettowert' => 'required|numeric', //NETWR
            'header.gesamtsteuerbetrag' => 'required|numeric', //MWSBK
            'header.kunnr' => 'required|string|max:10',
            'header.datumvon' => 'required|date',
            'header.datumbis' => 'required|date|after_or_equal:header.datumvon',


            'positions' => 'required|array|min:1',
            'positions.*.vorgangsnummer' => 'required|integer',
            'positions.*.positionsnummer' => 'required|integer',
            'positions.*.material' => 'required|string|max:18',
            'positions.*.menge' => 'required|numeric',
            'positions.*.nettowertposition' => 'required|numeric',
            'positions.*.steuerwertposition' => 'required|numeric',
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
