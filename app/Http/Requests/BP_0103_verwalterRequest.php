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
            'Adressnummer' => 'required|string|max:30',
            'LVorm' => 'nullable|string',
            'Titel' => 'nullable|string',
            'Anrede' => 'nullable|string',
            'Vorname' => 'required|string|max:40',
            'Nachname' => 'nullable|string|max:40',
            'Strasse' => 'required|string|max:40', //todo muss max 70
            'Postleitzahl' => 'required|string|max:10',
            'Ort' => 'required|string|max:40',
            'Telefon' => 'nullable|string|max:40',
            'Mobiltelefon' => 'nullable|string|max:40',
            'Fax' => 'nullable|string|max:40',
            'EMail' => 'nullable|email|max:80',
            'GueltigVon' => 'nullable|string',
            'GueltigBis' => 'nullable|string',
            'Ansprechpartner1' => 'nullable|string|max:10',
            'Ansprechpartner2' => 'nullable|string|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            // Header
            'header.required' => 'Der Header-Bereich ist erforderlich.',
            'header.kontraktnummer.required' => 'Das Feld "Vertragsnummer" ist erforderlich.',
            'header.kontraktnummer.string' => 'Die Vertragsnummer muss ein Text sein.',
            'header.kreditor.required' => 'Das Feld "Kreditor" ist erforderlich.',
            'header.gueltigVon.required' => 'Das Feld "Gültig von" ist erforderlich.',
            'header.gueltigVon.date_format' => 'Das Feld "Gültig von" muss im Format JJJJ-MM-TT vorliegen.',
            'header.gueltigBis.required' => 'Das Feld "Gültig bis" ist erforderlich.',
            'header.gueltigBis.date_format' => 'Das Feld "Gültig bis" muss im Format JJJJ-MM-TT vorliegen.',
            'header.gueltigBis.after_or_equal' => 'Das Feld "Gültig bis" muss gleich oder nach "Gültig von" liegen.',

            // Positions
            'positions.required' => 'Mindestens eine Position ist erforderlich.',
            'positions.array' => 'Die Positionen müssen ein Array sein.',
            'positions.*.kontraktnummer.required' => 'Die Vertragsnummer in jeder Position ist erforderlich.',
            'positions.*.kontraktposition.required' => 'Die Positionsnummer ist erforderlich.',
            'positions.*.kontraktposition.integer' => 'Die Positionsnummer muss eine ganze Zahl sein.',
            'positions.*.materialkurztext.required' => 'Der Materialkurztext ist erforderlich.',
            'positions.*.materialkurztext.string' => 'Der Materialkurztext muss ein Text sein.',
            'positions.*.preis.required' => 'Der Preis ist erforderlich.',
            'positions.*.preis.numeric' => 'Der Preis muss eine Zahl sein.',
            'positions.*.preismengeneinheit.required' => 'Die Mengeneinheit für den Preis ist erforderlich.',
            'positions.*.preismengeneinheit.numeric' => 'Die Mengeneinheit für den Preis muss eine Zahl sein.',
            'positions.*.loeschkennzeichen.in' => 'Das Löschkennzeichen muss entweder leer oder "L" sein.',
        ];
    }
}
