<?php

namespace App\Helpers;

class RE_01_01_Validation
{
    static public function rules(): array
    {
        return [
            'slgnr' => 'required|string|max:9',
            'mdmId' => 'required|numeric|digits_between:1,10',
            'fern' => 'nullable|in:0,1',
            'fernAb' => 'nullable|date',
            'opk' => 'nullable|in:0,1',
            'opkAb' => 'nullable|date',
            'uvir' => 'nullable|in:0,1',
            'uvirAb' => 'nullable|date',
            'mdf' => 'nullable|numeric|digits_between:1,2',
            'mdfBis' => 'nullable|date',
            'lgnrExt' => 'nullable|string|max:20',
            'validfrom' => 'required|date',
            'validto' => 'nullable|date',
            'lgart' => 'required|string',

            // Adressen
            'adressen' => 'required|array',
            'adressen.*.genrCeos' => 'required|numeric',
            'adressen.*.lgStr' => 'nullable|string|max:70',
            'adressen.*.lgPlz' => 'nullable|string|max:10',
            'adressen.*.lgOrt' => 'nullable|string|max:40',
            'adressen.*.hausHeizanlage' => 'nullable|string|max:1',
            'adressen.*.tplnr' => 'nullable|string|max:30',
            'adressen.*.mdmId' => 'required|numeric',
            'adressen.*.validfrom' => 'required|date',
            'adressen.*.validto' => 'nullable|date',

            // Kunden
            'kunden' => 'required|array',
            'kunden.*.validfrom' => 'required|date',
            'kunden.*.validto' => 'nullable|date',
            'kunden.*.kunnr' => 'required|string|max:10',
            'kunden.*.kdart' => 'nullable|string|max:3',
            'kunden.*.abrfirst' => 'nullable|date',
            'kunden.*.abrlast' => 'nullable|date',
            'kunden.*.vtrCeos' => 'nullable|numeric',

            // Mietobjekte
            'mietobjekte' => 'required|array',
            'mietobjekte.*.genrCeos' => 'required|numeric',
            'mietobjekte.*.menrCeos' => 'required|numeric',
            'mietobjekte.*.mLageBez' => 'required|string',
            'mietobjekte.*.mLage' => 'nullable|string|max:60',
            'mietobjekte.*.tplnr' => 'nullable|string|max:30',
            'mietobjekte.*.mdmIdMe' => 'required|numeric',
            'mietobjekte.*.korrnrHk' => 'nullable|string|max:20',
            'mietobjekte.*.korrnrKw' => 'nullable|string|max:20',
            'mietobjekte.*.gewerblichJn' => 'required|in:0,1',
            'mietobjekte.*.garageJn' => 'required|in:0,1',
            'mietobjekte.*.wohnFl' => 'nullable|numeric',
            'mietobjekte.*.heizFl' => 'nullable|numeric',
            'mietobjekte.*.wwFl' => 'nullable|numeric',
            'mietobjekte.*.flEinheit' => 'nullable|string|max:30',
            'mietobjekte.*.validfrom' => 'required|date',
            'mietobjekte.*.validto' => 'nullable|date',

            // Mieter
            'mieter' => 'nullable|array',
            'mieter.*.genrCeos' => 'required|numeric',
            'mieter.*.menrCeos' => 'required|numeric',
            'mieter.*.partner' => 'required|numeric',
            'mieter.*.recnnr' => 'nullable|string',
            'mieter.*.mName' => 'nullable|string',
            'mieter.*.mAnrede' => 'nullable|string',
            'mieter.*.mdmIdCn' => 'required|numeric',
            'mieter.*.datumEinzug' => 'required|date',
            'mieter.*.datumAuszug' => 'nullable|date',

            // Abrechnungsdaten
            'abrechnungsdaten' => 'required|array',
            'abrechnungsdaten.*.datab' => 'required|date',
            'abrechnungsdaten.*.datbi' => 'nullable|date',
            'abrechnungsdaten.*.sttHka' => 'nullable|string|max:5',
            'abrechnungsdaten.*.sttKwa' => 'nullable|string|max:5',
            'abrechnungsdaten.*.sttNka' => 'nullable|string|max:5',
            'abrechnungsdaten.*.sttSta' => 'nullable|string|max:5',
            'abrechnungsdaten.*.hka' => 'required|in:0,1',
            'abrechnungsdaten.*.kwa' => 'required|in:0,1',
            'abrechnungsdaten.*.nka' => 'required|in:0,1',
            'abrechnungsdaten.*.sta' => 'required|in:0,1',
            'abrechnungsdaten.*.abl' => 'required|in:0,1',
            'abrechnungsdaten.*.selbstableserJn' => 'required|in:0,1',
            'abrechnungsdaten.*.dta' => 'required|in:0,1',
            'abrechnungsdaten.*.bkb' => 'required|in:0,1',
            'abrechnungsdaten.*.rwm' => 'required|in:0,1',
            'abrechnungsdaten.*.hwabr' => 'required|in:0,1',
            'abrechnungsdaten.*.ww' => 'required|in:0,1',
        ];
    }


    static public function messages(): array
    {
        return [
            'required' => 'Das Feld ":attribute" ist erforderlich.',
            'nullable' => 'Das Feld ":attribute" ist optional.',
            'string' => 'Das Feld ":attribute" muss ein Text sein.',
            'max' => 'Das Feld ":attribute" darf maximal :max Zeichen enthalten.',
            'min' => 'Das Feld ":attribute" muss mindestens :min Elemente enthalten.',
            'size' => 'Das Feld ":attribute" muss genau :size Zeichen lang sein.',
            'numeric' => 'Das Feld ":attribute" muss ein nummer sein.',
            'boolean' => 'Das Feld ":attribute" muss entweder true oder false sein.',
            'integer' => 'Das Feld ":attribute" muss eine ganze Zahl sein.',
            'array' => 'Das Feld ":attribute" muss ein Array sein.',
            'date' => 'Das Feld ":attribute" muss ein gültiges Datum sein.',
        ];
    }
}
