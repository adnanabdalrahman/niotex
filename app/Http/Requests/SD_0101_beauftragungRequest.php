<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class SD_0101_beauftragungRequest extends FormRequest
{
    public function prepareForValidation(): void
    {
        Log::info('SD_0101_beauftragung Received Payload', [
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
            'header.vbeln' => 'required|string|max:10', // Verkaufsbeleg Vorgang.VorIndividualC1
            'header.auart' => 'required|string|max:4', // Vorgang.VorIndividualC2
            'header.kunnr' => ['required', 'numeric', 'integer', 'min:0', 'max:2147483647'],
            'header.vdatu' => 'required|date', // Wunschlieferdatum Vorgang.VorLieferung-WunschDatum
            'header.zzlgsnr' => 'nullable|string|max:9', // Liegenschaftsnummer Vorgang.VorIndividualC3
            'header.genrCeos' => 'nullable|integer',// Vorgang.VorIndividualD4
            'header.txtZ012' => 'nullable|string', //Bemerkung zur Liegenschaft Vorgang2TextService.VorNotiz
            'header.txtZ013' => 'nullable|string',// Vorgang.VorStichwort für Reparaturaufträge Ausstattung / Austauschgrund
            'header.augru' => 'required|string',// Vorgruppe

            'positions' => 'required|array|min:1',
            'positions.*.kwmeng' => 'required|numeric',
            'positions.*.kwmengO' => 'nullable|numeric',
            'positions.*.posnr' => 'required|integer',
            'positions.*.matnr' => 'required|string|max:18',
            'positions.*.vrkme' => 'required|string|max:6',
            'positions.*.posErl' => 'nullable|Boolean', // 1 erledigt ,2 teilweise erledigt
//            'positions.*.Kontierungsobjekt' => 'required|string|max:12',
            'positions.*.txtZ002' => 'nullable|string',
//            'positions.*.Vorgangsnummer' => 'nullable|integer',
            'positions.*.txtZ009' => 'nullable|string',
            'positions.*.txtZ010' => 'nullable|string',
            'positions.*.montagedatum' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Das Feld ":attribute" ist erforderlich.',
            'string' => 'Das Feld ":attribute" muss ein Text sein.',
            'numeric' => 'Das Feld ":attribute" muss eine Zahl sein.',
            'integer' => 'Das Feld ":attribute" muss eine Ganzzahl sein.',
            'max' => 'Das Feld ":attribute" darf maximal :max Zeichen enthalten.',
            'min' => 'Das Feld ":attribute" muss mindestens :min betragen.',
            'array' => 'Das Feld ":attribute" muss ein Array sein.',
            'date' => 'Das Feld ":attribute" muss ein gültiges Datum sein.',
            'boolean' => 'Das Feld ":attribute" muss entweder true oder false sein.',
        ];
    }

}
