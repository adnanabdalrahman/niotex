<?php

namespace App\Helpers;

class SD_02_01_Validation
{
    static public function rules(): array
    {
        return [
            'header' => 'required|array',
            'header.vbeln' => 'required|string',
            'header.fkdat' => 'required|date',
            'header.vorgn' => 'required|integer',
            'header.vorgnInt' => 'required|integer',
            'header.kunnr' => 'required|string',

            'header.zuonr' => 'required|string',
            'header.netwr' => 'required|numeric',
            'header.mwsbk' => 'required|numeric',
            'header.zzlgsnr' => 'required|string',
            'header.zzbukrs' => 'nullable|string',
            'header.datumvon' => 'nullable|string',
            'header.datumbis' => 'nullable|string',
            'header.zzstproz' => 'required|numeric',

            'positions' => 'required|array|min:1',
            'positions.*.vorgn' => 'required|integer',
            'positions.*.vorgnInt' => 'required|integer',
            'positions.*.posnr' => 'required|integer',
            'positions.*.matnr' => 'required|string',
            'positions.*.fkimg' => 'required|numeric',
            'positions.*.netwr' => 'required|numeric',
            'positions.*.mwsbp' => 'required|numeric',
            'positions.*.zzstproz' => 'required|numeric',
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
