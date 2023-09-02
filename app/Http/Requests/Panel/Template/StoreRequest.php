<?php

namespace App\Http\Requests\Panel\Template;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'path' => 'required|string|max:255',
            'token' => 'required|string|max:255',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Данное поле является обязательным для заполнения',
            'name.string' => 'Данное поле должно быть строкой',
            'name.max' => 'Максимальная длина данного поля - :max',
            'path.required' => 'Данное поле является обязательным для заполнения',
            'path.string' => 'Данное поле должно быть строкой',
            'path.max' => 'Максимальная длина данного поля - :max',
            'token.required' => 'Данное поле является обязательным для заполнения',
            'token.string' => 'Данное поле должно быть строкой',
            'token.max' => 'Максимальная длина данного поля - :max',
        ];
    }
}
