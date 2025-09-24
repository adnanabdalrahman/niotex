<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SD_0201_mietvertragsrechnungenRequest extends FormRequest
{
    public function withValidator($validator)
    {
        $validator->sometimes(['header.datumvon', 'header.datumbis'], 'nullable|date', function ($input) {
            return $input->header['vbeln'] === $input->header['zuonr'];
        });

        $validator->sometimes('header.datumvon', 'required|date', function ($input) {
            return $input->header['vbeln'] !== $input->header['zuonr'];
        });

        $validator->sometimes('header.datumbis', 'required|date|after_or_equal:header.datumvon', function ($input) {
            return $input->header['vbeln'] !== $input->header['zuonr'];
        });
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
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

            'positions' => 'required|array|min:1',
            'positions.*.vorgn' => 'required|integer',
            'positions.*.vorgnInt' => 'required|integer',
            'positions.*.posnr' => 'required|integer',
            'positions.*.matnr' => 'required|string',
            'positions.*.fkimg' => 'required|numeric',
            'positions.*.netwr' => 'required|numeric',
            'positions.*.mwsbp' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Das Feld ":attribute" ist erforderlich.',
            'nullable' => 'Das Feld ":attribute" ist optional.',
            'string' => 'Das Feld ":attribute" muss ein Text sein.',
            'max' => 'Das Feld ":attribute" darf maximal :max Zeichen enthalten.',
            'min' => 'Das Feld ":attribute" muss mindestens :min Elemente enthalten.',
            'size' => 'Das Feld ":attribute" muss genau :size Zeichen lang sein.',
            'numeric' => 'Das Feld ":attribute" muss ein nummer sein.',
            'email' => 'Das Feld ":attribute" muss eine gültige E-Mail-Adresse sein.',
            'in' => 'Das Feld ":attribute" muss einen gültigen Wert enthalten.',
            'date' => 'Das Feld ":attribute" muss ein gültiges Datum sein.',
            'digits_between' => 'Das Feld ":attribute" muss zwischen :min und :max Ziffern enthalten.',
            'array' => 'Das Feld ":attribute" muss ein Array sein.',
            'digits' => 'Das Feld :attribute muss genau :digits Ziffern enthalten.',
            'after_or_equal' => 'Das Feld :attribute muss nach oder gleich dem Feld :date liegen.',
            'date_format' => 'Das Feld ":attribute" muss im Format :format vorliegen.',
            'boolean' => 'Das Feld ":attribute" muss entweder true oder false sein.',
            'integer' => 'Das Feld ":attribute" muss eine ganze Zahl sein.',
        ];
    }
}
