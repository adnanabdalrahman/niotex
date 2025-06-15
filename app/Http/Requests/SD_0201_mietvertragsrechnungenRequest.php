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
            'header.vbeln' => 'required|string',
            'header.fkdat' => 'required|date',
            'header.datumvon' => 'required|date',
            'header.datumbis' => 'required|date|after_or_equal:header.datumvon',
            'header.vorgn' => 'required|integer',
            'header.vorgnInt' => 'required|integer',

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
            'header.required' => 'Das Header-Feld ist erforderlich.',
            'header.vbeln.required' => 'Feld "vbeln" ist erforderlich.',
            'header.fkdat.required' => 'Feld "fkdat" ist erforderlich.',
            'header.fkdat.date' => '"fkdat" muss ein gültiges Datum sein.',
            'header.datumvon.required' => 'Feld "datumvon" ist erforderlich.',
            'header.datumvon.date' => '"datumvon" muss ein gültiges Datum sein.',
            'header.datumbis.required' => 'Feld "datumbis" ist erforderlich.',
            'header.datumbis.date' => '"datumbis" muss ein gültiges Datum sein.',
            'header.datumbis.after_or_equal' => '"datumbis" muss gleich oder nach "datumvon" sein.',
            'header.zuonr.required' => 'Feld "zuonr" ist erforderlich.',
            'header.netwr.required' => 'Feld "netwr" ist erforderlich.',
            'header.netwr.numeric' => '"netwr" muss eine Zahl sein.',
            'header.mwsbk.required' => 'Feld "mwsbk" ist erforderlich.',
            'header.mwsbk.numeric' => '"mwsbk" muss eine Zahl sein.',
            'header.zzlgsnr.required' => 'Feld "zzlgsnr" ist erforderlich.',
            'header.vorgn.required' => 'Feld "vorgn" ist erforderlich.',
            'header.vorgn.integer' => '"vorgn" muss eine ganze Zahl sein.',
            'header.vorgnInt.required' => 'Feld "vorgnInt" ist erforderlich.',

            'positions.required' => 'Das Positionsfeld ist erforderlich und darf nicht leer sein.',
            'positions.array' => 'Positionsdaten müssen ein Array sein.',
            'positions.*.matnr.required' => 'Feld "matnr" in einer Position ist erforderlich.',
            'positions.*.vorgn.required' => 'Feld "vorgn" in einer Position ist erforderlich.',
            'positions.*.vorgnInt.required' => 'Feld "vorgnInt" in einer Position ist erforderlich.',
            'positions.*.posnr.required' => 'Feld "posnr" in einer Position ist erforderlich.',
            'positions.*.fkimg.required' => 'Feld "fkimg" in einer Position ist erforderlich.',
            'positions.*.netwr.required' => 'Feld "netwr" in einer Position ist erforderlich.',
            'positions.*.mwsbp.required' => 'Feld "mwsbp" in einer Position ist erforderlich.',
        ];
    }
}
