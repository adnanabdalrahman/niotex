<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SD_0201_mietvertragsrechnungenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'header' => 'required|array',
            'header.fakturaNummer' => 'required|string|max:20',
            'header.fakturaDatum' => 'required|date',
            'header.abrechnungszeitraum' => 'required|array',
            'header.abrechnungszeitraum.datumVon' => 'required|date',
            'header.abrechnungszeitraum.datumBis' => 'required|date|after_or_equal:header.abrechnungszeitraum.datumVon',
            'header.vorlageBeleg' => 'required|string|max:20',
            'header.nettoWert' => 'required|numeric|min:0',
            'header.gesamtSteuerbetrag' => 'required|numeric|min:0',
            'header.liegenschaft' => 'required|string|max:20',
            'header.vorgangsnummer' => 'required|string|max:20',
            'header.haeuserGebaeude' => 'required|string|max:20',

            'positions' => 'required|array|min:1',
            'positions.*.vorgangsnummer' => 'required|string|max:20',
            'positions.*.positionsNummer' => 'required|string|max:20',
            'positions.*.material' => 'required|string|max:40',
            'positions.*.menge' => 'required|numeric|min:0',
            'positions.*.nettoWertPosition' => 'required|numeric|min:0',
            'positions.*.steuerWertPosition' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'header.required' => 'Der Header-Bereich ist erforderlich.',
            'header.fakturaNummer.required' => 'Die Fakturanummer ist erforderlich.',
            'header.fakturaNummer.max' => 'Die Fakturanummer darf maximal 20 Zeichen lang sein.',
            'header.fakturaDatum.required' => 'Das Fakturadatum ist erforderlich.',
            'header.fakturaDatum.date' => 'Das Fakturadatum muss ein gültiges Datum sein.',
            'header.abrechnungszeitraum.required' => 'Der Abrechnungszeitraum ist erforderlich.',
            'header.abrechnungszeitraum.datumVon.required' => 'Das Startdatum des Abrechnungszeitraums ist erforderlich.',
            'header.abrechnungszeitraum.datumVon.date' => 'Das Startdatum muss ein gültiges Datum sein.',
            'header.abrechnungszeitraum.datumBis.required' => 'Das Enddatum des Abrechnungszeitraums ist erforderlich.',
            'header.abrechnungszeitraum.datumBis.date' => 'Das Enddatum muss ein gültiges Datum sein.',
            'header.abrechnungszeitraum.datumBis.after_or_equal' => 'Das Enddatum muss gleich oder später als das Startdatum sein.',
            'header.vorlageBeleg.required' => 'Die Vorlagebelegnummer ist erforderlich.',
            'header.vorlageBeleg.max' => 'Die Vorlagebelegnummer darf maximal 20 Zeichen lang sein.',
            'header.nettoWert.required' => 'Der Nettowert ist erforderlich.',
            'header.nettoWert.numeric' => 'Der Nettowert muss eine Zahl sein.',
            'header.gesamtSteuerbetrag.required' => 'Der Steuerbetrag ist erforderlich.',
            'header.gesamtSteuerbetrag.numeric' => 'Der Steuerbetrag muss eine Zahl sein.',
            'header.liegenschaft.required' => 'Die Liegenschaft ist erforderlich.',
            'header.liegenschaft.max' => 'Die Liegenschaft darf maximal 20 Zeichen lang sein.',
            'header.vorgangsnummer.required' => 'Die CEOS-Vorgangsnummer ist erforderlich.',
            'header.vorgangsnummer.max' => 'Die CEOS-Vorgangsnummer darf maximal 20 Zeichen lang sein.',
            'header.haeuserGebaeude.required' => 'Die Häuser/Gebäude-Nummer ist erforderlich.',
            'header.haeuserGebaeude.max' => 'Die Häuser/Gebäude-Nummer darf maximal 20 Zeichen lang sein.',

            'positions.required' => 'Mindestens eine Position muss angegeben werden.',
            'positions.array' => 'Die Positionen müssen als Array übergeben werden.',
            'positions.*.vorgangsnummer.required' => 'Die Vorgangsnummer der Position ist erforderlich.',
            'positions.*.vorgangsnummer.max' => 'Die Vorgangsnummer darf maximal 20 Zeichen lang sein.',
            'positions.*.positionsNummer.required' => 'Die Positionsnummer ist erforderlich.',
            'positions.*.positionsNummer.max' => 'Die Positionsnummer darf maximal 20 Zeichen lang sein.',
            'positions.*.material.required' => 'Das Material ist erforderlich.',
            'positions.*.material.max' => 'Das Material darf maximal 40 Zeichen lang sein.',
            'positions.*.menge.required' => 'Die Menge ist erforderlich.',
            'positions.*.menge.numeric' => 'Die Menge muss eine Zahl sein.',
            'positions.*.nettoWertPosition.required' => 'Der Nettowert der Position ist erforderlich.',
            'positions.*.nettoWertPosition.numeric' => 'Der Nettowert der Position muss eine Zahl sein.',
            'positions.*.steuerWertPosition.required' => 'Der Steuerwert der Position ist erforderlich.',
            'positions.*.steuerWertPosition.numeric' => 'Der Steuerwert der Position muss eine Zahl sein.',
        ];
    }
}
