<?php

namespace App\Http\Requests\Admin\CountryAndCity;

use App\Models\CountryAndCity;
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
            'id'                    => 'nullable|numeric',
            'metric_id'             => 'nullable|string|max:255',
            'parent_id'             => 'nullable|numeric|min:1',
            'name'                  => 'nullable|array',
            'inverse_credit_ratio'  => 'nullable|numeric',
            'div'                   => 'nullable|array',
            'photo'                 => 'nullable',
            'flag'                  => 'nullable',
            'lat'                   => 'nullable|string|max:255',
            'long'                  => 'nullable|string|max:255',
            'slug'                  => 'nullable|string|max:255',
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
