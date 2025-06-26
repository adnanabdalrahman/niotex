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
            'Geschaeftspartnernummer.required' => 'Die Geschäftspartnernummer ist erforderlich.',
            'DebitorenKreditorennummer.required' => 'Adressnummer (DebitorenKreditorennummer) ist erforderlich.',

            'Anrede.string' => 'Die Anrede muss ein Text sein.',
            'Titel.string' => 'Der Titel muss ein Text sein.',

            'Vorname.string' => 'Der Vorname muss ein Text sein.',
            'Vorname.max' => 'Der Vorname darf maximal 40 Zeichen lang sein.',

            'Nachname.string' => 'Der Nachname muss ein Text sein.',
            'Nachname.max' => 'Der Nachname darf maximal 40 Zeichen lang sein.',

            'Name1.string' => 'Name1 muss ein Text sein.',
            'Name1.max' => 'Name1 darf maximal 40 Zeichen lang sein.',

            'Name2.string' => 'Name2 muss ein Text sein.',
            'Name2.max' => 'Name2 darf maximal 40 Zeichen lang sein.',

            'Name3.string' => 'Name3 muss ein Text sein.',
            'Name3.max' => 'Name3 darf maximal 40 Zeichen lang sein.',

            'Suchbegriff1.string' => 'Suchbegriff 1 muss ein Text sein.',
            'Suchbegriff1.max' => 'Suchbegriff 1 darf maximal 10 Zeichen lang sein.',

            'Suchbegriff2.string' => 'Suchbegriff 2 muss ein Text sein.',
            'Suchbegriff2.max' => 'Suchbegriff 2 darf maximal 10 Zeichen lang sein.',

            'Strasse.string' => 'Die Straße muss ein Text sein.',
            'Strasse.max' => 'Die Straße darf maximal 60 Zeichen lang sein.',

            'Postleitzahl.string' => 'Die Postleitzahl muss ein Text sein.',
            'Postleitzahl.max' => 'Die Postleitzahl darf maximal 10 Zeichen lang sein.',

            'Ort.string' => 'Der Ort muss ein Text sein.',
            'Ort.max' => 'Der Ort darf maximal 40 Zeichen lang sein.',

            'Land.string' => 'Das Land muss ein Text sein.',
            'Land.size' => 'Der Ländercode muss genau 2 Zeichen lang sein.',

            'Postfach.string' => 'Das Postfach muss ein Text sein.',
            'Postfach.max' => 'Das Postfach darf maximal 10 Zeichen lang sein.',

            'PostleitzahlPostfach.string' => 'Die Postleitzahl zum Postfach muss ein Text sein.',
            'PostleitzahlPostfach.max' => 'Die Postleitzahl zum Postfach darf maximal 10 Zeichen lang sein.',

            'OrtPostfach.string' => 'Der Ort zum Postfach muss ein Text sein.',
            'OrtPostfach.max' => 'Der Ort zum Postfach darf maximal 40 Zeichen lang sein.',

            'Telefon.string' => 'Die Telefonnummer muss ein Text sein.',
            'Telefon.max' => 'Die Telefonnummer darf maximal 40 Zeichen lang sein.',

            'Mobiltelefon.string' => 'Die Mobiltelefonnummer muss ein Text sein.',
            'Mobiltelefon.max' => 'Die Mobiltelefonnummer darf maximal 40 Zeichen lang sein.',

            'Fax.string' => 'Die Faxnummer muss ein Text sein.',
            'Fax.max' => 'Die Faxnummer darf maximal 40 Zeichen lang sein.',

            'EMail.email' => 'Die E-Mail-Adresse muss gültig sein.',

            'AutoWEAbr.boolean' => 'Das Feld "Automatische WE-Abrechnung" muss ein Wahrheitswert (true/false) sein.',

            'Kundengruppe.string' => 'Die Kundengruppe muss ein Text sein.',
            'Kundengruppe.max' => 'Die Kundengruppe darf maximal 2 Zeichen lang sein.',

            'Kundengruppe1.string' => 'Die Kundengruppe1 muss ein Text sein.',
            'Kundengruppe1.max' => 'Die Kundengruppe1 darf maximal 3 Zeichen lang sein.',
            'Loeschvormerkung.string' => 'Das Feld "Lieferform" muss ein Text sein.',
        ];
    }
}
