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
            'artikelnummer' => 'artikelnummer is required.',
            'lager' => 'Only "H001" (Hauptlager) is supported.',
        ];
    }
}
