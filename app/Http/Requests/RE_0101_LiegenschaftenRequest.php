<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationFailedException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RE_0101_LiegenschaftenRequest extends FormRequest
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
            '*.liegenschaft' => 'required|array',
            '*.liegenschaft.slgnr' => 'required|string|max:9',
            '*.liegenschaft.mdmId' => 'required|numeric|digits_between:1,10',
            '*.liegenschaft.fern' => 'nullable|in:0,1',
            '*.liegenschaft.fernAb' => 'nullable|date',
            '*.liegenschaft.opk' => 'nullable|in:0,1',
            '*.liegenschaft.opkAb' => 'nullable|date',
            '*.liegenschaft.uvir' => 'nullable|in:0,1',
            '*.liegenschaft.uvirAb' => 'nullable|date',
            '*.liegenschaft.mdf' => 'nullable|numeric|digits_between:1,2',
            '*.liegenschaft.mdfBis' => 'nullable|date',
            '*.liegenschaft.lgnrExt' => 'nullable|string|max:20',
            '*.liegenschaft.validfrom' => 'required|date',
            '*.liegenschaft.validto' => 'nullable|date',
            '*.liegenschaft.lgart' => 'required|string',

            // Adressen
            '*.liegenschaft.adressen' => 'required|array',
            '*.liegenschaft.adressen.*.genrCeos' => 'required|numeric',
            '*.liegenschaft.adressen.*.lgStr' => 'nullable|string|max:70',
            '*.liegenschaft.adressen.*.lgPlz' => 'nullable|string|max:10',
            '*.liegenschaft.adressen.*.lgOrt' => 'nullable|string|max:40',
            '*.liegenschaft.adressen.*.hausHeizanlage' => 'nullable|string|max:1',
            '*.liegenschaft.adressen.*.tplnr' => 'nullable|string|max:30',
            '*.liegenschaft.adressen.*.mdmId' => 'required|numeric',
            '*.liegenschaft.adressen.*.validfrom' => 'required|date',
            '*.liegenschaft.adressen.*.validto' => 'nullable|date',

            // Kunden
            '*.liegenschaft.kunden' => 'required|array',
            '*.liegenschaft.kunden.*.validfrom' => 'required|date',
            '*.liegenschaft.kunden.*.validto' => 'nullable|date',
            '*.liegenschaft.kunden.*.kunnr' => 'required|string|max:10',
            '*.liegenschaft.kunden.*.kdart' => 'nullable|string|max:3',
            '*.liegenschaft.kunden.*.abrfirst' => 'nullable|date',
            '*.liegenschaft.kunden.*.abrlast' => 'nullable|date',
            '*.liegenschaft.kunden.*.vtrCeos' => 'nullable|numeric',

            // Mietobjekte
            '*.liegenschaft.mietobjekte' => 'required|array',
            '*.liegenschaft.mietobjekte.*.genrCeos' => 'required|numeric',
            '*.liegenschaft.mietobjekte.*.menrCeos' => 'required|numeric',
            '*.liegenschaft.mietobjekte.*.mLageBez' => 'required|string',
            '*.liegenschaft.mietobjekte.*.mLage' => 'nullable|string|max:60',
            '*.liegenschaft.mietobjekte.*.tplnr' => 'nullable|string|max:30',
            '*.liegenschaft.mietobjekte.*.mdmIdMe' => 'required|numeric',
            '*.liegenschaft.mietobjekte.*.korrnrHk' => 'nullable|string|max:20',
            '*.liegenschaft.mietobjekte.*.korrnrKw' => 'nullable|string|max:20',
            '*.liegenschaft.mietobjekte.*.gewerblichJn' => 'required|in:0,1',
            '*.liegenschaft.mietobjekte.*.garageJn' => 'required|in:0,1',
            '*.liegenschaft.mietobjekte.*.wohnFl' => 'required|numeric',
            '*.liegenschaft.mietobjekte.*.heizFl' => 'required|numeric',
            '*.liegenschaft.mietobjekte.*.wwFl' => 'required|numeric',
            '*.liegenschaft.mietobjekte.*.flEinheit' => 'required|string|max:30',
            '*.liegenschaft.mietobjekte.*.validfrom' => 'required|date',
            '*.liegenschaft.mietobjekte.*.validto' => 'nullable|date',

            // Mieter
            '*.liegenschaft.mieter' => 'nullable|array',
            '*.liegenschaft.mieter.*.genrCeos' => 'required|numeric',
            '*.liegenschaft.mieter.*.menrCeos' => 'required|numeric',
            '*.liegenschaft.mieter.*.partner' => 'required|numeric',
            '*.liegenschaft.mieter.*.recnnr' => 'nullable|string',
            '*.liegenschaft.mieter.*.mName' => 'nullable|string',
            '*.liegenschaft.mieter.*.mAnrede' => 'nullable|string',
            '*.liegenschaft.mieter.*.mdmIdCn' => 'required|numeric',
            '*.liegenschaft.mieter.*.datumEinzug' => 'required|date',
            '*.liegenschaft.mieter.*.datumAuszug' => 'nullable|date',

            // Abrechnungsdaten
            '*.liegenschaft.abrechnungsdaten' => 'required|array',
            '*.liegenschaft.abrechnungsdaten.*.datab' => 'required|date',
            '*.liegenschaft.abrechnungsdaten.*.datbi' => 'nullable|date',
            '*.liegenschaft.abrechnungsdaten.*.sttHka' => 'nullable|string|max:5',
            '*.liegenschaft.abrechnungsdaten.*.sttKwa' => 'nullable|string|max:5',
            '*.liegenschaft.abrechnungsdaten.*.sttNka' => 'nullable|string|max:5',
            '*.liegenschaft.abrechnungsdaten.*.sttSta' => 'nullable|string|max:5',
            '*.liegenschaft.abrechnungsdaten.*.hka' => 'required|in:0,1',
            '*.liegenschaft.abrechnungsdaten.*.kwa' => 'required|in:0,1',
            '*.liegenschaft.abrechnungsdaten.*.nka' => 'required|in:0,1',
            '*.liegenschaft.abrechnungsdaten.*.sta' => 'required|in:0,1',
            '*.liegenschaft.abrechnungsdaten.*.abl' => 'required|in:0,1',
            '*.liegenschaft.abrechnungsdaten.*.selbstableserJn' => 'required|in:0,1',
            '*.liegenschaft.abrechnungsdaten.*.dta' => 'required|in:0,1',
            '*.liegenschaft.abrechnungsdaten.*.bkb' => 'required|in:0,1',
            '*.liegenschaft.abrechnungsdaten.*.rwm' => 'required|in:0,1',
            '*.liegenschaft.abrechnungsdaten.*.hwabr' => 'required|in:0,1',
            '*.liegenschaft.abrechnungsdaten.*.ww' => 'required|in:0,1',
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
