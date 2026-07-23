<?php

namespace App\Http\Requests\InfluxDb;

use Illuminate\Foundation\Http\FormRequest;

class QueryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dtwin_title' => ['required', 'string'],
            'state_identifier' => ['required', 'string'],
            'from' => ['required', 'date'],
            'to' => ['required', 'date', 'after_or_equal:from'],
        ];
    }
}
