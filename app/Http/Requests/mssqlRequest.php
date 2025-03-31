<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SAPStockRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'materials' => 'required|array|min:1',
            'materials.*' => 'string|size:8', // Each material must be 8 characters
            'plant' => 'required|string|size:4',
            'storage_location' => 'required|string|size:4|in:H001', // Only Hauptlager supported
        ];
    }

    public function messages(): array
    {
        return [
            'materials.required' => 'At least one material number is required.',
            'materials.*.size' => 'Each material number must be exactly 8 characters.',
            'plant.size' => 'Plant must be exactly 4 characters.',
            'storage_location.in' => 'Only "H001" (Hauptlager) is supported.',
        ];
    }
}
