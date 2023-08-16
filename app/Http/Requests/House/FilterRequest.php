<?php

namespace App\Http\Requests\House;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'user_id' => 'filled|numeric|min:1',
            'top_left' => 'nullable|array',
            'bottom_right' => 'nullable|array',
            'page' => 'filled|numeric|min:1',
            'sale_or_rent' => 'nullable|string',
            'order_by' => 'nullable|string',
            'price' => 'nullable|array',
            'bedrooms' => 'nullable|string',
            'bathrooms' => 'nullable|string',
            'osobenost' => 'nullable|array',
            'view' => 'nullable|string',
            'to_sea' => 'nullable|string',
            'size' => 'nullable|string',
            'size_home' => 'nullable|string',
            'type' => 'nullable|string',
            'ot_zastroishika' => 'nullable|string',
        ];
    }
}
