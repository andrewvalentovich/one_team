<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdatePasswordRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6|confirmed',
            'newpassword_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'oldpassword.required' => 'Старый пароль обязательное поле',
            'newpassword.required' => 'Новый пароль обязательное поле',
            'newpassword.min6' => 'Новый пароль должен состоять из 6 символов',
            'newpassword.confirmed' => 'Пароли не совпадают',
            'newpassword_confirmation.required' => 'Подтверждение пароля обязательное поле',

        ];
    }
}
