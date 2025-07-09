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
            'header.txtZ012' => 'nullable|string', //Bemerkung zur Liegenschaft Vorgang2Text.VorNotiz
            'header.txtZ013' => 'nullable|string',// Vorgang.VorStichwort für Reparaturaufträge Ausstattung / Austauschgrund
            'header.augru' => 'required|string',// Vorgruppe

            'positions' => 'required|array|min:1',
            'positions.*.kondm' => 'required|string|max:2', //Materialgruppe PosIndividualC3
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
            'header.required' => 'Das Feld "header" ist erforderlich.',
            'header.array' => 'Das Feld "header" muss ein gültiges Array sein.',

            'header.vbeln.required' => 'Die Verkaufsbelegnummer (vbeln) ist erforderlich.',
            'header.vbeln.string' => 'Die Verkaufsbelegnummer (vbeln) muss ein Text sein.',
            'header.vbeln.max' => 'Die Verkaufsbelegnummer (vbeln) darf maximal 10 Zeichen lang sein.',

            'header.auart.required' => 'Der Auftragstyp (auart) ist erforderlich.',
            'header.auart.string' => 'Der Auftragstyp (auart) muss ein Text sein.',
            'header.auart.max' => 'Der Auftragstyp (auart) darf maximal 4 Zeichen lang sein.',

            'header.kunnr.required' => 'Die Kundennummer ist erforderlich.',
            'header.kunnr.numeric' => 'Die Kundennummer muss eine Zahl sein.',
            'header.kunnr.integer' => 'Die Kundennummer darf keine Dezimalstelle haben.',
            'header.kunnr.min' => 'Die Kundennummer darf nicht negativ sein.',
            'header.kunnr.max' => 'Die Kundennummer darf maximal :max sein.',

            'header.vdatu.required' => 'Das gewünschte Lieferdatum (vdatu) ist erforderlich.',
            'header.vdatu.date' => 'Das gewünschte Lieferdatum (vdatu) muss ein gültiges Datum sein.',

            'header.zzlgsnr.string' => 'Die Zusatznummer (zzlgsnr) muss ein Text sein.',
            'header.zzlgsnr.max' => 'Die Zusatznummer (zzlgsnr) darf maximal 9 Zeichen lang sein.',

            'header.genrCeos.integer' => 'Der Wert von genrCeos muss eine ganze Zahl sein.',
            'positions.required' => 'Die Liste der Positionen ("positions") ist erforderlich.',
            'positions.*.PosNr.required' => 'Die Positionsnummer ("PosNr") ist für jede Position erforderlich.',
            'positions.*.PosNr.integer' => 'Die Positionsnummer ("PosNr") muss eine ganze Zahl sein.',
            'positions.array' => 'Die Positionen ("positions") müssen ein Array sein.',
            'positions.*.aufnr.required' => 'Die Auftragsnummer ("aufnr") ist für jede Position erforderlich.',
            'positions.*.kondm.required' => 'Der Konditionstyp ("kondm") ist für jede Position erforderlich.',
            'positions.*.kwmeng.required' => 'Die Menge ("kwmeng") ist für jede Position erforderlich.',
            'positions.*.kwmeng.numeric' => 'Die Menge ("kwmeng") muss eine Zahl sein.',
            'positions.*.matnr.required' => 'Die Materialnummer ("matnr") ist für jede Position erforderlich.',
            'positions.*.matnr.string' => 'Die Materialnummer ("matnr") muss ein String sein.',
            'positions.*.vrkme.required' => 'Die Maßeinheit ("vrkme") ist für jede Position erforderlich.',
            'positions.*.vrkme.string' => 'Die Maßeinheit ("vrkme") muss ein String sein.',
        ];
    }

}
