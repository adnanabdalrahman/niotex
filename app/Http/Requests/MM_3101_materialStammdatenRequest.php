<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MM_3101_materialStammdatenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'material'   => 'required|numeric|digits_between:1,18',
            'bezeichnung1' => 'required|String',
            'lvorm'          => 'required|boolean', 
        ];
    }

    public function messages(): array
    {
        return [
            'material.required' => 'Material number is required.',
            'material.numeric' => 'Material number must be numeric.',
            'material.digits_between' => 'Material number must be between 1 and 18 digits.',
            'bezeichnung1.required' => 'Description is required.',
            'lvorm.required' => 'Lvorm is required.',
            'lvorm.boolean' => 'Lvorm must be true or false.',
        ];
    }
}
