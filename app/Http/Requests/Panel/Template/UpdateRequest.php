<?php

namespace App\Http\Requests\Panel\Template;

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
            'name' => 'nullable|string|max:255',
            'path' => 'nullable|string|max:255',
            'token' => 'nullable|string|max:255',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'name.string' => 'Данное поле должно быть строкой',
            'name.max' => 'Максимальная длина данного поля - :max',
            'path.string' => 'Данное поле должно быть строкой',
            'path.max' => 'Максимальная длина данного поля - :max',
            'token.string' => 'Данное поле должно быть строкой',
            'token.max' => 'Максимальная длина данного поля - :max',
        ];
    }
}
