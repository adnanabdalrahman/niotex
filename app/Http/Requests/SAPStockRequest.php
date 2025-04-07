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
            'materials' => 'required',
            'plant' => 'required|string|size:4',
            'storage_location' => 'required|string|size:4|in:H001',
        ];
    }

    public function messages(): array
    {
        return [
            'materials.required' => 'At least one material number is required.',
            'plant.size' => 'Plant must be exactly 4 characters.',
            'storage_location.in' => 'Only "H001" (Hauptlager) is supported.',
        ];
    }
}
