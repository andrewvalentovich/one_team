<?php

namespace App\Http\Requests\Panel\Landing;

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
            'subdomain' => 'required|string|max:255',
            'domain' => 'nullable|string|max:255',
            'template_id' => 'required|numeric|min:1',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'subdomain.required' => 'Данное поле является обязательным для заполнения',
            'subdomain.string' => 'Данное поле должно быть строкой',
            'subdomain.max' => 'Максимальная длина данного поля - :max',
            'domain.required' => 'Данное поле является обязательным для заполнения',
            'domain.string' => 'Данное поле должно быть строкой',
            'domain.max' => 'Максимальная длина данного поля - :max',
            'template_id.required' => 'Данное поле является обязательным для заполнения',
            'template_id.numeric' => 'Данное поле должно быть числом',
            'template_id.min' => 'Значение поля должно быть больше :min',
        ];
    }
}
