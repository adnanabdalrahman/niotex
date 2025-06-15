<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MM_3701_nuLeistungspositionenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'header' => 'required|array',
            'header.kontraktnummer' => 'required|string|max:20',
            'header.kreditor' => 'required|string|max:20',
            'header.gueltigVon' => 'required|date_format:Y-m-d',
            'header.gueltigBis' => 'required|date_format:Y-m-d|after_or_equal:header.gueltigVon',

            'positions' => 'required|array|min:1',
            'positions.*.kontraktnummer' => 'required|string|max:20',
            'positions.*.kontraktposition' => 'required|integer',
            'positions.*.materialnummer' => 'required|string|max:50',
            'positions.*.materialkurztext' => 'nullable|string|max:255',
            'positions.*.mengeneinheit' => 'nullable|string|max:10',
            'positions.*.preis' => 'required|numeric|min:0',
            'positions.*.preismengeneinheit' => 'required|numeric|min:1',
            'positions.*.loeschkennzeichen' => 'nullable|string|in:L,""',
        ];
    }

    public function messages(): array
    {
        return [
            'header.required' => 'Der Header ist erforderlich.',
            'header.array' => 'Der Header muss ein Array sein.',

            'header.kontraktnummer.required' => 'Die Kontraktnummer im Header ist erforderlich.',
            'header.kontraktnummer.string' => 'Die Kontraktnummer im Header muss eine Zeichenkette sein.',
            'header.kontraktnummer.max' => 'Die Kontraktnummer im Header darf maximal :max Zeichen lang sein.',

            'header.kreditor.required' => 'Der Kreditor im Header ist erforderlich.',
            'header.kreditor.string' => 'Der Kreditor im Header muss eine Zeichenkette sein.',
            'header.kreditor.max' => 'Der Kreditor im Header darf maximal :max Zeichen lang sein.',

            'header.gueltigVon.required' => 'Das Gültig-von-Datum im Header ist erforderlich.',
            'header.gueltigVon.date_format' => 'Das Gültig-von-Datum im Header muss im Format JJJJ-MM-TT vorliegen.',

            'header.gueltigBis.required' => 'Das Gültig-bis-Datum im Header ist erforderlich.',
            'header.gueltigBis.date_format' => 'Das Gültig-bis-Datum im Header muss im Format JJJJ-MM-TT vorliegen.',
            'header.gueltigBis.after_or_equal' => 'Das Gültig-bis-Datum muss gleich oder später als das Gültig-von-Datum sein.',

            'positions.required' => 'Mindestens eine Position ist erforderlich.',
            'positions.array' => 'Die Positionen müssen ein Array sein.',
            'positions.min' => 'Mindestens eine Position ist erforderlich.',

            'positions.*.kontraktnummer.required' => 'Die Kontraktnummer der Position ist erforderlich.',
            'positions.*.kontraktnummer.string' => 'Die Kontraktnummer der Position muss eine Zeichenkette sein.',
            'positions.*.kontraktnummer.max' => 'Die Kontraktnummer der Position darf maximal :max Zeichen lang sein.',

            'positions.*.kontraktposition.required' => 'Die Positionsnummer ist erforderlich.',
            'positions.*.kontraktposition.integer' => 'Die Positionsnummer muss eine Ganzzahl sein.',

            'positions.*.materialnummer.required' => 'Die Materialnummer ist erforderlich.',
            'positions.*.materialnummer.string' => 'Die Materialnummer muss eine Zeichenkette sein.',
            'positions.*.materialnummer.max' => 'Die Materialnummer darf maximal :max Zeichen lang sein.',

            'positions.*.materialkurztext.string' => 'Der Materialkurztext muss eine Zeichenkette sein.',
            'positions.*.materialkurztext.max' => 'Der Materialkurztext darf maximal :max Zeichen lang sein.',

            'positions.*.mengeneinheit.string' => 'Die Mengeneinheit muss eine Zeichenkette sein.',
            'positions.*.mengeneinheit.max' => 'Die Mengeneinheit darf maximal :max Zeichen lang sein.',

            'positions.*.preis.required' => 'Der Preis ist erforderlich.',
            'positions.*.preis.numeric' => 'Der Preis muss eine Zahl sein.',
            'positions.*.preis.min' => 'Der Preis darf nicht negativ sein.',

            'positions.*.preismengeneinheit.required' => 'Die Preismengeneinheit ist erforderlich.',
            'positions.*.preismengeneinheit.numeric' => 'Die Preismengeneinheit muss eine Zahl sein.',
            'positions.*.preismengeneinheit.min' => 'Die Preismengeneinheit muss mindestens :min betragen.',

            'positions.*.loeschkennzeichen.string' => 'Das Löschkennzeichen muss eine Zeichenkette sein.',
            'positions.*.loeschkennzeichen.in' => 'Das Löschkennzeichen muss entweder "L" oder leer sein.',
        ];
    }
}
