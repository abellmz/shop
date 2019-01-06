<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeLoginRequest extends FormRequest
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
            'account' => 'required',
            'password' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'account.required' => '请输入邮箱号或手机号',
            'password.required' => '请输入密码'
        ];
    }
}
