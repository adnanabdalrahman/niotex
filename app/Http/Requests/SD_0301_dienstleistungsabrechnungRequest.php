<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SD_0301_dienstleistungsabrechnungRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'header' => 'required|array',
            'header.Verkaufsbelegart' => 'required|string|max:4',
            'header.Auftraggeber' => 'required|string|max:10',
            'header.Liegenschaftsnummer' => 'required|string|max:9',
            'header.Vorgangsnummer' => 'required|string|max:20',
            'header.Vorgangsnummer_intern' => 'required|string|max:20',
            'header.Abrechnungszeitraum_von' => 'required|date_format:Y-m-d',
            'header.Abrechnungszeitraum_bis' => 'required|date_format:Y-m-d|after_or_equal:Abrechnungszeitraum_von',

            'positions' => 'required|array|min:1',
            'positions.*.vorgangsnummer' => 'required|string|max:20',
            'positions.*.material' => 'required|string|max:40',
            'positions.*.menge' => 'required|numeric|min:0',
            'positions.*.Verkaufsmengeneinheit' => 'required|string|max:3',
            'positions.*.Absagegrund' => 'required|string|max:2',
            'positions.*.Vorgangsnummer_intern' => 'required|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'header.required' => 'Der Header-Bereich ist erforderlich.',
            'header.array' => 'Der Header muss ein Array sein.',

            'header.Verkaufsbelegart.required' => 'Das Feld "Verkaufsbelegart" ist erforderlich.',
            'header.Verkaufsbelegart.size' => 'Das Feld "Verkaufsbelegart" muss genau 4 Zeichen lang sein.',

            'header.Auftraggeber.required' => 'Das Feld "Auftraggeber" ist erforderlich.',
            'header.Auftraggeber.size' => 'Das Feld "Auftraggeber" muss genau 10 Zeichen lang sein.',

            'header.Liegenschaftsnummer.required' => 'Das Feld "Liegenschaftsnummer" ist erforderlich.',
            'header.Liegenschaftsnummer.size' => 'Das Feld "Liegenschaftsnummer" muss genau 9 Zeichen lang sein.',

            'header.Vorgangsnummer.required' => 'Das Feld "Vorgangsnummer" ist erforderlich.',
            'header.Vorgangsnummer.digits' => 'Das Feld "Vorgangsnummer" muss genau 20 Ziffern enthalten.',

            'header.Vorgangsnummer_intern.required' => 'Das Feld "Vorgangsnummer_intern" ist erforderlich.',
            'header.Vorgangsnummer_intern.digits' => 'Das Feld "Vorgangsnummer_intern" muss genau 20 Ziffern enthalten.',

            'header.Abrechnungszeitraum_von.required' => 'Das Feld "Abrechnungszeitraum_von" ist erforderlich.',
            'header.Abrechnungszeitraum_von.date_format' => 'Das Feld "Abrechnungszeitraum_von" muss im Format JJJJMMTT (z. B. 20250516) sein.',

            'header.Abrechnungszeitraum_bis.required' => 'Das Feld "Abrechnungszeitraum_bis" ist erforderlich.',
            'header.Abrechnungszeitraum_bis.date_format' => 'Das Feld "Abrechnungszeitraum_bis" muss im Format JJJJMMTT (z. B. 20250516) sein.',
            'header.Abrechnungszeitraum_bis.after_or_equal' => 'Das Feld "Abrechnungszeitraum_bis" muss gleich oder nach "Abrechnungszeitraum_von" sein.',

            'positions.required' => 'Der Bereich "positions" ist erforderlich.',
            'positions.array' => 'Die "positions" müssen ein Array sein.',
            'positions.min' => 'Mindestens eine Position ist erforderlich.',

            'positions.*.vorgangsnummer.required' => 'Das Feld "vorgangsnummer" in jeder Position ist erforderlich.',
            'positions.*.vorgangsnummer.max' => 'Das Feld "vorgangsnummer" darf maximal 20 Zeichen enthalten.',

            'positions.*.material.required' => 'Das Feld "material" in jeder Position ist erforderlich.',
            'positions.*.material.max' => 'Das Feld "material" darf maximal 40 Zeichen enthalten.',

            'positions.*.menge.required' => 'Das Feld "menge" in jeder Position ist erforderlich.',
            'positions.*.menge.numeric' => 'Das Feld "menge" muss eine Zahl sein.',
            'positions.*.menge.min' => 'Das Feld "menge" darf nicht negativ sein.',

            'positions.*.Verkaufsmengeneinheit.required' => 'Das Feld "Verkaufsmengeneinheit" in jeder Position ist erforderlich.',
            'positions.*.Verkaufsmengeneinheit.size' => 'Das Feld "Verkaufsmengeneinheit" muss genau 3 Zeichen lang sein.',

            'positions.*.Absagegrund.required' => 'Das Feld "Absagegrund" in jeder Position ist erforderlich.',
            'positions.*.Absagegrund.size' => 'Das Feld "Absagegrund" muss genau 2 Zeichen lang sein.',

            'positions.*.Vorgangsnummer_intern.required' => 'Das Feld "Vorgangsnummer_intern" in jeder Position ist erforderlich.',
            'positions.*.Vorgangsnummer_intern.digits' => 'Das Feld "Vorgangsnummer_intern" muss genau 20 Ziffern enthalten.',
        ];
    }
}
