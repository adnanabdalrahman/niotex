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
            'Adressnummer' => 'required|max:30',
            'LVorm' => 'nullable|string',
            'Titel' => 'required|integer',
            'Anrede' => 'required|integer',
            'Vorname' => 'required|string|max:40',
            'Nachname' => 'required|string|max:40',
            'Strasse' => 'required|string|max:40', //todo muss max 70
            'Postleitzahl' => 'required|string|max:10',
            'Ort' => 'required|string|max:40',
            'Telefon' => 'nullable|string|max:40',
            'Mobiltelefon' => 'nullable|string|max:40',
            'Fax' => 'nullable|string|max:40',
            'Email' => 'nullable|email|max:80',
            'DatumVon' => 'required|date',
            'DatumBis' => 'required|date',
            'Ansprechpartner1' => 'nullable|string|max:10',
            'Ansprechpartner2' => 'nullable|string|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'Adressnummer.required' => 'Die Adressnummer ist erforderlich.',
            'Titel.required' => 'Der Titel ist erforderlich.',
            'Titel.integer' => 'Der Titel muss eine Zahl sein.',
            'Anrede.required' => 'Die Anrede ist erforderlich.',
            'Anrede.integer' => 'Die Anrede muss eine Zahl sein.',
            'Vorname.required' => 'Der Vorname ist erforderlich.',
            'Vorname.string' => 'Der Vorname muss ein Text sein.',
            'Vorname.max' => 'Der Vorname darf maximal 40 Zeichen lang sein.',
            'Nachname.required' => 'Der Nachname ist erforderlich.',
            'Nachname.string' => 'Der Nachname muss ein Text sein.',
            'Nachname.max' => 'Der Nachname darf maximal 40 Zeichen lang sein.',
            'Strasse.required' => 'Die Straße ist erforderlich.',
            'Strasse.string' => 'Die Straße muss ein Text sein.',
            'Strasse.max' => 'Die Straße darf maximal 60 Zeichen lang sein.',
            'Postleitzahl.required' => 'Die Postleitzahl ist erforderlich.',
            'Postleitzahl.string' => 'Die Postleitzahl muss ein Text sein.',
            'Postleitzahl.max' => 'Die Postleitzahl darf maximal 10 Zeichen lang sein.',
            'Ort.required' => 'Der Ort ist erforderlich.',
            'Ort.string' => 'Der Ort muss ein Text sein.',
            'Ort.max' => 'Der Ort darf maximal 40 Zeichen lang sein.',
            'Telefon.string' => 'Die Telefonnummer muss ein Text sein.',
            'Telefon.max' => 'Die Telefonnummer darf maximal 40 Zeichen lang sein.',
            'Mobiltelefon.string' => 'Die Mobilnummer muss ein Text sein.',
            'Mobiltelefon.max' => 'Die Mobilnummer darf maximal 40 Zeichen lang sein.',
            'Fax.string' => 'Die Faxnummer muss ein Text sein.',
            'Fax.max' => 'Die Faxnummer darf maximal 40 Zeichen lang sein.',
            'Email.email' => 'Die E-Mail-Adresse muss gültig sein.',
            'Email.max' => 'Die E-Mail-Adresse darf maximal 80 Zeichen lang sein.',
            'DatumVon.required' => 'Das Datum von ist erforderlich.',
            'DatumVon.date' => 'Das Datum von muss ein gültiges Datum sein.',
            'DatumBis.required' => 'Das Datum bis ist erforderlich.',
            'DatumBis.date' => 'Das Datum bis muss ein gültiges Datum sein.',
            'Ansprechpartner1.string' => 'Ansprechpartner 1 muss ein Text sein.',
            'Ansprechpartner1.max' => 'Ansprechpartner 1 darf maximal 10 Zeichen lang sein.',
            'Ansprechpartner2.string' => 'Ansprechpartner 2 muss ein Text sein.',
            'Ansprechpartner2.max' => 'Ansprechpartner 2 darf maximal 10 Zeichen lang sein.',
        ];
    }
}
