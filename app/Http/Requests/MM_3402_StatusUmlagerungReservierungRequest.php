<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationFailedException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class MM_3402_StatusUmlagerungReservierungRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            '*.header' => 'required|array',
            '*.header.tourId' => 'required|string|max:20',
            '*.header.reservNo' => 'required',
            '*.header.checkstatus' => 'required|string|max:1',

            '*.materials' => 'required|array|min:1',
            '*.materials.*.material' => 'required|string|max:20',
            '*.materials.*.entryQnt' => 'required|numeric',
            '*.materials.*.entryUom' => 'required|string|max:2',
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

    /**
     * @throws ValidationFailedException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();
        $message = "Validierung fehlgeschlagen.";
        throw new ValidationFailedException($message, $errors, 422,);
    }

    /**
     * @throws ValidationFailedException
     */
    protected function getValidatorInstance(): Validator
    {
        $content = $this->getContent();

        json_decode($content);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ValidationFailedException(
                'Ungültiges JSON: ' . json_last_error_msg(),
                [],
                400
            );
        }
        return parent::getValidatorInstance();
    }
}
