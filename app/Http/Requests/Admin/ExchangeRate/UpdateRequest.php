<?php

namespace App\Http\Requests\Admin\ExchangeRate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'direct' => 'nullable|string',
            'relative' => 'nullable|string',
            'value' => 'nullable|string',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'direct.string' => 'Данное поле должно быть строкой',
            'relative.string' => 'Данное поле должно быть строкой',
            'value.string' => 'Данное поле должно быть строкой',
        ];
    }
}
