<?php

namespace App\Http\Requests\RealEstate;

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
            'sale_or_rent' => 'nullable|string',
            'order_by' => 'nullable|string',
            'ot_zastroishika' => 'nullable|string',
            'min_price' => 'nullable|string',
            'max_price' => 'nullable|string',
            'vannie_id' => 'nullable|int',
            'spalni_id' => 'nullable|int',
            'osobenost' => 'nullable|array',
            'vid_id' => 'nullable|string',
            'do_more_id' => 'nullable|string',
            'all_size' => 'nullable|string',
            'home_size' => 'nullable|string',
            'type' => 'nullable|string',
            'currency_type' => 'nullable|string',
        ];
    }
}
