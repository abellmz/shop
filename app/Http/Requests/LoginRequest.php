<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
//        $v = \Validator::make($this->request->all(), [
//            'username' => 'sometimes|required|username',
//        ]);
//        dd($v);
//        dd($this->request->all()[''username]);
//        $pa = $this->request->all()['username'];可以用sometimes的规则怎么用，哭死！
//        dd($pa);

            return [
                'username' => 'required',
                'password' => 'required'
            ];

    }

    public function messages()
    {
        return [
//            'email.required' => '请输入用户名或邮箱',
            'username.required' => '请输入用户名',
            'password.required' => '请输入密码'
        ];
    }
}
