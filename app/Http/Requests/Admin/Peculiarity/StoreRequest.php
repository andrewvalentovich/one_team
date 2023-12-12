<?php

namespace App\Http\Requests\Admin\Peculiarity;

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
            'name'      => 'required|string|max:255',
            'type'      => 'required|string|max:255',
            'slug'      => ['nullable', 'string', 'unique:peculiarities,slug'],
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
            'type.required' => 'Данное поле является обязательным для заполнения',
            'type.string' => 'Данное поле должно быть строкой',
            'slug.unique' => 'Данное поле должно уникальным',
            'slug.string' => 'Данное поле должно быть строкой',
        ];
    }
}
