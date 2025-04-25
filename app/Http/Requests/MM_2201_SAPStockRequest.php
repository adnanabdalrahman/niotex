<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MM_2201_SAPStockRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'materials' => 'required',
            'storage' => 'required|string|size:4|in:H001',
        ];
    }

    public function messages(): array
    {
        return [
            'materials' => 'At least one material number is required.',
            'storage' => 'Only "H001" (Hauptlager) is supported.',
        ];
    }
}
