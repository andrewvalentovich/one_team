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
            'country_id' => 'nullable|numeric',
            'city_id' => 'nullable|numeric',
            'country' => 'nullable|string',
            'city' => 'nullable|string',

            'user_id' => 'nullable|numeric|min:1',
            'top_left' => 'nullable|array',
            'bottom_right' => 'nullable|array',
            'page' => 'nullable|numeric',
            'sale_or_rent' => 'nullable|string',
            'is_secondary' => 'nullable|string',
            'price' => 'nullable|array',
            'bedrooms' => 'nullable',
            'bathrooms' => 'nullable',
            'peculiarities' => 'nullable|array',
            'view' => 'nullable|string',
            'to_sea' => 'nullable|string',
            'size' => 'nullable|array',
            'type' => 'nullable|string',
            'type_id' => 'nullable|numeric',
        ];
    }
}
