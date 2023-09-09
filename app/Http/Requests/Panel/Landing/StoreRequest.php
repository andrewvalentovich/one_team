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

            'filter_country' => 'nullable|numeric|min:1',
            'filter_region' => 'nullable|numeric|min:1',
            'filter_complex' => 'nullable|numeric|min:1',

            'phone' => 'nullable|string|min:1|max:20',

            'main_location' => 'nullable|string|max:255',
            'main_title' => 'nullable|string|max:255',
            'main_subtitle' => 'nullable|string|max:255',
            'main_content' => 'nullable|string|max:8192',
            'main_photo' => 'nullable', 'file', 'mimes:jpeg,jpg,bmp,webp,png',

            'main_lists' => 'nullable|array',
            'main_lists.*' => 'nullable',

            'objects_title' => 'nullable|string|max:255',

            'about_title' => 'nullable|string|max:255',
            'about_subtitle' => 'nullable|string|max:255',
            'about_description' => 'nullable|array',
            'about_description.*' => 'nullable',

            'territory' => 'nullable', 'file', 'mimes:jpeg,jpg,bmp,webp,png',

            'map' => 'nullable|string|max:8192',

            'purchase_terms' => 'nullable|array',
            'purchase_terms.*' => 'nullable',

            'vnj_title' => 'nullable|string|max:255',
            'vnj_content' => 'nullable|string|max:8192',

            'sight_title' => 'nullable|string|max:255',
            'sight_cards' => 'nullable|array',
            'sight_cards.*' => 'nullable',

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
