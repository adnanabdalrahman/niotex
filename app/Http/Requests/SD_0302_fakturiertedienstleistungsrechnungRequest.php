<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SD_0302_fakturiertedienstleistungsrechnungRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // todo ask christian to change to Camelcase
        return [
            'Auart' => 'required|string|max:4', // Vorgang.VorIndividualC2
            'Kunnr' => 'required|string|max:10', // Adresse.AdressNummer(was empfangene nummer) -> Adresse.InterneAdressnummer(zu speichernde nummer in: Vorgang.VorAuftraggeber)
            'Zzlgsnr' => 'nullable|string|max:9', // Liegenschaftsnummer Vorgang.VorIndividualC3
            'Abr_von' => 'required|date',
            'Abr_bis' => 'required|date|after_or_equal:header.datumvon',
            'Vorgn' => 'required|string',
            'Vorgn_int' => 'required|string',

            'to_ServItems' => 'required|array|min:1',
            'to_ServItems.*.Matnr' => 'required|string|max:18',
            'to_ServItems.*.Kwmeng' => 'required|numeric',
            'to_ServItems.*.Vrkme' => 'required|string|max:6',
            'to_ServItems.*.Vorgn' => 'required|integer',
            'to_ServItems.*.Vorgn_int' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'Auart.required' => 'Der Auftragstyp (Auart) ist erforderlich.',
            'Auart.string' => 'Der Auftragstyp (Auart) muss ein Text sein.',
            'Auart.max' => 'Der Auftragstyp (Auart) darf maximal 4 Zeichen lang sein.',

            'Kunnr.required' => 'Die Kundennummer (Kunnr) ist erforderlich.',
            'Kunnr.string' => 'Die Kundennummer (Kunnr) muss ein Text sein.',
            'Kunnr.max' => 'Die Kundennummer (Kunnr) darf maximal 10 Zeichen lang sein.',

            'zzlgsnr.string' => 'Die Zusatznummer (zzlgsnr) muss ein Text sein.',
            'zzlgsnr.max' => 'Die Zusatznummer (zzlgsnr) darf maximal 9 Zeichen lang sein.',

            'Abr_von.required' => 'Feld "Abr_von" ist erforderlich.',
            'Abr_von.date' => '"Abr_von" muss ein gültiges Datum sein.',

            'Abr_bis.required' => 'Feld "Abr_bis" ist erforderlich.',
            'Abr_bis.date' => '"Abr_bis" muss ein gültiges Datum sein.',
            'Abr_bis.after_or_equal' => '"Abr_bis" muss gleich oder nach "Abr_von" sein.',

            'Vorgn.required' => 'Feld "Vorgn" ist erforderlich.',
            'Vorgn.integer' => '"Vorgn" muss eine ganze Zahl sein.',
            'Vorgn_int.required' => 'Feld "Vorgn_int" ist erforderlich.',


            'to_ServItems.required' => 'Die Liste der Positionen ("positions") ist erforderlich.',
            'to_ServItems.array' => 'Die Positionen ("positions") müssen ein Array sein.',

            'to_ServItems.*.Matnr.required' => 'Die Materialnummer ("Matnr") ist für jede Position erforderlich.',
            'to_ServItems.*.Matnr.string' => 'Die Materialnummer ("Matnr") muss ein String sein.',

            'to_ServItems.*.Kwmeng.required' => 'Die Menge ("Kwmeng") ist für jede Position erforderlich.',
            'to_ServItems.*.Kwmeng.numeric' => 'Die Menge ("Kwmeng") muss eine Zahl sein.',

            'to_ServItems.*.Vrkme.required' => 'Die Maßeinheit ("Vrkme") ist für jede Position erforderlich.',
            'to_ServItems.*.Vrkme.string' => 'Die Maßeinheit ("Vrkme") muss ein String sein.',

            'to_ServItems.*.Vorgn.required' => 'Feld "vorgn" in einer Position ist erforderlich.',
            'to_ServItems.*.Vorgn_int.required' => 'Feld "vorgnInt" in einer Position ist erforderlich.',

        ];
    }
}
