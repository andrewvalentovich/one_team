<?php

namespace App\Http\Requests\Admin\ExchangeRate;

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
            'direct_val' => 'nullable|string',
            'relative_val' => 'nullable|string',
            'sell_val' => 'nullable|string',
            'buy_val' => 'nullable|string',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'direct_val.string' => 'Данное поле должно быть строкой',
            'relative_val.string' => 'Данное поле должно быть строкой',
            'sell_val.string' => 'Данное поле должно быть строкой',
            'buy_val.string' => 'Данное поле должно быть строкой',
        ];
    }
}
