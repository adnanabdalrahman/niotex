<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationFailedException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SD_0101_beauftragungRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'header' => 'required|array',
            'header.vbeln' => 'required|string|max:10', // Verkaufsbeleg Vorgang.VorIndividualC1
            'header.auart' => 'required|string|max:4', // Vorgang.VorIndividualC2
            'header.kunnr' => ['required', 'numeric', 'integer', 'min:0', 'max:2147483647'],
            'header.vdatu' => 'required|date', // Wunschlieferdatum Vorgang.VorLieferung-WunschDatum
            'header.zzlgsnr' => 'nullable|string|max:9', // Liegenschaftsnummer Vorgang.VorIndividualC3
            'header.genrCeos' => 'nullable|integer',// Vorgang.VorIndividualD4
            'header.txtZ012' => 'nullable|string', //Bemerkung zur Liegenschaft Vorgang2TextService.VorNotiz
            'header.txtZ013' => 'nullable|string',// Vorgang.VorStichwort für Reparaturaufträge Ausstattung / Austauschgrund
            'header.augru' => 'required|string',// Vorgruppe

            'positions' => 'required|array|min:1',
            'positions.*.matnr' => 'required|string|max:18',
            'positions.*.kondm' => 'nullable|string|max:2',
            'positions.*.kwmeng' => 'required|numeric',
            'positions.*.vrkme' => 'required|string|max:6',
            'positions.*.kwmengO' => 'nullable|numeric',
            'positions.*.aufnr' => 'required|string|max:18',
            'positions.*.txtZ002' => 'nullable|string',
            'positions.*.txtZ009' => 'nullable|string',
            'positions.*.txtZ010' => 'nullable|string',
            'positions.*.posnr' => 'required|integer',
            'positions.*.posErl' => 'nullable|Boolean', // 1 erledigt ,2 teilweise erledigt
//          'positions.*.Kontierungsobjekt' => 'required|string|max:12',
//          'positions.*.Vorgangsnummer' => 'nullable|integer',
            'positions.*.montagedatum' => 'nullable|string',
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
