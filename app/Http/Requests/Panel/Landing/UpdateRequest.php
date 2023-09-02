<?php

namespace App\Http\Requests\Panel\Landing;

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
            'subdomain' => 'nullable|string|max:255',
            'domain' => 'nullable|string|max:255',
            'template_id' => 'nullable|numeric|min:1',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'subdomain.string' => 'Данное поле должно быть строкой',
            'subdomain.max' => 'Максимальная длина данного поля - :max',
            'domain.string' => 'Данное поле должно быть строкой',
            'domain.max' => 'Максимальная длина данного поля - :max',
            'template_id.numeric' => 'Данное поле должно быть числом',
            'template_id.min' => 'Значение поля должно быть больше :min',
        ];
    }
}
