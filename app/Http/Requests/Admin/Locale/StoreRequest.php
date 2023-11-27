<?php

namespace App\Http\Requests\Admin\Locale;

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
            'code' => 'required|string|max:2|unique:locales',
            'icon'      => ['required', 'file', 'mimes:png,jpg,jpeg,webp,svg'],
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'code.required' => 'Данное поле является обязательным для заполнения',
            'code.string' => 'Данное поле должно быть строкой',
            'code.max' => 'Данное поле должно содержать не более :max символов',
            'icon.required' => 'Данное поле является обязательным для заполнения',
            'icon.file' => 'Данное поле должно быть файлом',
            'icon.mimes' => 'Файл должен иметь расширение - png,jpg,jpeg,webp или svg',
        ];
    }
}
