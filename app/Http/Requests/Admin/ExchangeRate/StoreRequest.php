<?php

namespace App\Http\Requests\Admin\ExchangeRate;

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
            'direct_val' => 'required|string',
            'relative_val' => 'required|string',
            'sell_val' => 'required|string',
            'buy_val' => 'required|string',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'direct_val.required' => 'Данное поле является обязательным для заполнения',
            'direct_val.string' => 'Данное поле должно быть строкой',
            'relative_val.required' => 'Данное поле является обязательным для заполнения',
            'relative_val.string' => 'Данное поле должно быть строкой',
            'sell_val.required' => 'Данное поле является обязательным для заполнения',
            'sell_val.string' => 'Данное поле должно быть строкой',
            'buy_val.required' => 'Данное поле является обязательным для заполнения',
            'buy_val.string' => 'Данное поле должно быть строкой',
        ];
    }
}
