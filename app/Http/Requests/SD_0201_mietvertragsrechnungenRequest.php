<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class SD_0201_mietvertragsrechnungenRequest extends FormRequest
{
    public function prepareForValidation(): void
    {
        Log::info('SD_0201_mietvertragsrechnungen Received Payload', [
            'data' => $this->all()
        ]);
    }

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
            'string' => 'Das Feld ":attribute" muss ein Text sein.',
            'numeric' => 'Das Feld ":attribute" muss eine Zahl sein.',
            'integer' => 'Das Feld ":attribute" muss eine Ganzzahl sein.',
            'date' => 'Das Feld ":attribute" muss ein gültiges Datum sein.',
            'array' => 'Das Feld ":attribute" muss ein Array sein.',
            'min' => 'Das Feld ":attribute" muss mindestens :min Elemente enthalten.',
        ];
    }
}
