<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class SD_0302_fakturiertedienstleistungsrechnungRequest extends FormRequest
{
    public function prepareForValidation(): void
    {
        Log::info('SD_0302_fakturiertedienstleistungsrechnung Received Payload', [
            'data' => $this->all()
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'header' => 'required|array',
            'header.fakturanummer' => 'required|string', // VBELN VorIndividualC1
            'header.liegenschaft' => 'nullable|string', // ZZLGSNR
            'header.vorgangsnummer' => 'required|int', //VORGN
            'header.vorgangsnummerInt' => 'required|int', //interneVorgangsnummer
            'header.vorlagebeleg' => 'nullable|numeric', //zuonr VorIndividualC7
            'header.nettowert' => 'required|numeric', //NETWR
            'header.gesamtsteuerbetrag' => 'required|numeric', //MWSBK
            'header.kunnr' => 'required|string|max:10',
            'header.datumvon' => 'required|date',
            'header.datumbis' => 'required|date|after_or_equal:header.datumvon',


            'positions' => 'required|array|min:1',
            'positions.*.vorgangsnummer' => 'required|integer',
            'positions.*.positionsnummer' => 'required|integer',
            'positions.*.material' => 'required|string|max:18',
            'positions.*.menge' => 'required|numeric',
            'positions.*.nettowertposition' => 'required|numeric',
            'positions.*.steuerwertposition' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Das Feld ":attribute" ist erforderlich.',
            'string' => 'Das Feld ":attribute" muss ein Text sein.',
            'integer' => 'Das Feld ":attribute" muss eine ganze Zahl sein.',
            'int' => 'Das Feld ":attribute" muss eine ganze Zahl sein.', // for 'int' alias
            'numeric' => 'Das Feld ":attribute" muss eine Zahl sein.',
            'date' => 'Das Feld ":attribute" muss ein gültiges Datum sein.',
            'after_or_equal' => 'Das Feld ":attribute" muss ein Datum nach oder gleich :date sein.',
            'max' => 'Das Feld ":attribute" darf maximal :max Zeichen enthalten.',
            'min' => 'Das Feld ":attribute" muss mindestens :min Eintrag(e) enthalten.',
        ];
    }
}
