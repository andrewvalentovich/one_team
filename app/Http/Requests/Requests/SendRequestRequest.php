<?php

namespace App\Http\Requests\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendRequestRequest extends FormRequest
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
            'country' => 'nullable|string|max:255',
            'locale' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:25',
            'fio' => 'nullable|string|max:255',
            'ip' => 'nullable|string|max:20',
            'utm_source' => 'nullable|string|max:255',
            'utm_medium' => 'nullable|string|max:255',
            'utm_campaign' => 'nullable|string|max:255',
            'utm_term' => 'nullable|string|max:255',
            'utm_content' => 'nullable|string|max:255',
            'referer' => 'nullable|string|max:255',
            'product_id' => 'nullable|numeric',
            'message' => 'nullable|string|max:65535',
        ];
    }
}
