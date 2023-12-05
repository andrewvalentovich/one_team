<?php

namespace App\Http\Requests\House;

use Illuminate\Foundation\Http\FormRequest;

class CatalogRequest extends FormRequest
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
            'locale' => 'nullable',
            'order_by' => 'nullable|string',
            'page' => 'nullable',
            'country_id' => 'nullable|numeric',
            'city_id' => 'nullable|numeric',
            'country' => 'nullable|string',
            'city' => 'nullable|string',
        ];
    }
}
