<?php

namespace App\Http\Requests\Admin\Products;

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
            'complex_or_not' => 'nullable|numeric',
            'city_id' => 'nullable|numeric|min:1',
            'country_id' => 'nullable|numeric|min:1',
            'sale_or_rent' => 'nullable|string',
            'name' => 'nullable|string',
            'slug' => 'nullable|string',
            'price' => 'nullable|integer',
            'price_code' => 'nullable|string',
            'size' => 'nullable|integer',
            'size_home' => 'nullable|integer',
            'address' => 'nullable|string',
            'disposition' => 'nullable|array',
            'description' => 'nullable|array',
            'deadline' => 'nullable|array',
            'parking' => 'nullable|numeric',
            'cryptocurrency' => 'nullable|numeric',
            'is_secondary' => 'nullable|boolean',
            'is_commercial' => 'nullable|boolean',
            'vnj' => 'nullable|numeric',
            'citizenship' => 'nullable|numeric',
            'commissions' => 'nullable|numeric',
            'lat' => 'nullable|string',
            'long' => 'nullable|string',
            'option_id' => 'nullable|numeric',
            'layouts' => 'nullable|array',
            'photo' => ['nullable'],
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
        ];
    }
}
