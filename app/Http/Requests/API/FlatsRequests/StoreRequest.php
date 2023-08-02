<?php

namespace App\Http\Requests\API\FlatsRequests;

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
            'type' => 'nullable|string|max:2048',
            'date-to-buy' => 'nullable|string|max:2048',
            'questions[]' => 'nullable|array',
            'questions.*' => 'nullable|string|max:2048',
            'myQuestion' => 'nullable|string|max:2048',
            'budget' => 'nullable|string|max:2048',
            'name' => 'nullable|string|max:2048',
            'phone' => 'required|string|max:2048',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'type.string' => 'Данное поле должно быть строкой',
            'type.max' => 'Максимальная длина данного поля :max',
            'date-to-buy.string' => 'Данное поле должно быть строкой',
            'questions[].array' => 'Данное поле должно быть массивом',
            'date-to-buy.max' => 'Максимальная длина данного поля :max',
            'questions.*.string' => 'Данное поле должно быть строкой',
            'questions.*.max' => 'Максимальная длина данного поля :max',
            'myQuestion.string' => 'Данное поле должно быть строкой',
            'myQuestion.max' => 'Максимальная длина данного поля :max',
            'budget.string' => 'Данное поле должно быть строкой',
            'budget.max' => 'Максимальная длина данного поля :max',
            'name.string' => 'Данное поле должно быть строкой',
            'name.max' => 'Максимальная длина данного поля :max',
            'phone.required' => 'Данное поле является обязательным для заполнения',
            'phone.string' => 'Данное поле должно быть строкой',
            'phone.max' => 'Максимальная длина данного поля :max',
        ];
    }
}
