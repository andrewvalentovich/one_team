<?php

namespace App\Http\Requests\Admin\Locale;

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
            'code' => 'nullable|string|max:2',
            'icon'      => ['nullable', 'file', 'mimes:png,jpg,jpeg,webp,svg'],
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'code.string' => 'Данное поле должно быть строкой',
            'code.max' => 'Данное поле должно содержать не более :max символов',
            'icon.file' => 'Данное поле должно быть файлом',
            'icon.mimes' => 'Файл должен иметь расширение - png,jpg,jpeg,webp или svg',
        ];
    }
}
