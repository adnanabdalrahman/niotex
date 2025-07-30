<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class MM_2201_SAPStockRequest extends FormRequest
{

    public function prepareForValidation(): void
    {
        Log::info('MM_2201_SAPStock Received Payload', [
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
            'artikelnummer' => 'required',
            'lager' => 'required|string|size:4|in:H001',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Das Feld ":attribute" ist erforderlich.',
            'string' => 'Das Feld ":attribute" muss ein Text sein.',
            'size' => 'Das Feld ":attribute" muss genau :size Zeichen lang sein.',
            'in' => 'Das Feld ":attribute" muss den Wert :values haben.',
        ];
    }
}
