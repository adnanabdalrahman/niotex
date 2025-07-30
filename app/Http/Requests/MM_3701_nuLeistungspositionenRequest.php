<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class MM_3701_nuLeistungspositionenRequest extends FormRequest
{

    public function prepareForValidation(): void
    {
        Log::info('MM_3701_nuLeistungspositionen Received Payload', [
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
            'header.kontraktnummer' => 'required|string|max:20',
            'header.kreditor' => 'required|string|max:20',
            'header.gueltigVon' => 'required|date_format:Y-m-d',
            'header.gueltigBis' => 'required|date_format:Y-m-d|after_or_equal:header.gueltigVon',

            'positions' => 'required|array|min:1',
            'positions.*.kontraktnummer' => 'required|string|max:20',
            'positions.*.kontraktposition' => 'required|integer',
            'positions.*.materialnummer' => 'required|string|max:50',
            'positions.*.materialkurztext' => 'nullable|string|max:255',
            'positions.*.mengeneinheit' => 'nullable|string|max:10',
            'positions.*.preis' => 'required|numeric|min:0',
            'positions.*.preismengeneinheit' => 'required|numeric|min:1',
            'positions.*.loeschkennzeichen' => 'nullable|string|in:L,""',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Das Feld ":attribute" ist erforderlich.',
            'numeric' => 'Das Feld ":attribute" muss eine Zahl sein.',
            'string' => 'Das Feld ":attribute" muss ein Text sein.',
            'max' => 'Das Feld ":attribute" darf maximal :max Zeichen enthalten.',
            'date_format' => 'Das Feld ":attribute" muss im Format :format vorliegen.',
            'after_or_equal' => 'Das Feld ":attribute" muss größer oder gleich dem Feld :date sein.',
            'in' => 'Das Feld ":attribute" enthält einen ungültigen Wert.',
        ];
    }

    public function attributes(): array
    {
        return [
            'header.kontraktnummer' => 'Kontraktnummer (Header)',
            'header.kreditor' => 'Kreditor (Header)',
            'positions.*.preis' => 'Preis (Position)',
            'positions.*.materialnummer' => 'Materialnummer (Position)',
        ];
    }


}
