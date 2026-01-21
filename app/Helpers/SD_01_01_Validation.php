<?php

namespace App\Helpers;

class SD_01_01_Validation
{
    static public function rules(): array
    {
        return [
            'header' => 'required|array',

            'header.vbeln' => 'required|string|max:10',
            'header.auart' => 'required|string|max:4',
            'header.kunnr' => ['required', 'numeric', 'integer', 'min:0', 'max:2147483647'],
            'header.vdatu' => 'required|date',
            'header.zzlgsnr' => 'nullable|string|max:9',
            'header.genrCeos' => 'nullable|integer',
            'header.txtZ012' => 'nullable|string',
            'header.txtZ013' => 'nullable|string',
            'header.augru' => 'required|string',

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
            'positions.*.posErl' => 'nullable|boolean',
            'positions.*.montagedatum' => 'nullable|string',
            //'positions.*.Kontierungsobjekt' => 'required|string|max:12',
            //'positions.*.Vorgangsnummer' => 'nullable|integer',
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
