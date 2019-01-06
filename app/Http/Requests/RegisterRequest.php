<?php

namespace App\Http\Requests;

use App\User;
use function foo\func;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
//        dd($this->request->all());数组
        return [
            'account'    => [
                'required',function($attribute , $value , $fail)
                {
                    if (filter_var($value,FILTER_VALIDATE_EMAIL)){
                        $user=User::where('email',$value)->first();
                    }else{
                        $user=User::where('mobile',$value)->first();
                    }
                    if ($user){
                        return $fail('该账号已存在');
                    }

                },
            ] ,
            'password' => 'required|confirmed' ,
            'code'     => [
                'required' ,
                function ( $attribute , $value , $fail )
                {
                    if ( $value != session ( 'code' ) )
                    {
                        return $fail( '请输入正确的验证码' );
                    }
                } ,
            ]
        ];
    }

    public function messages ()
    {
        return [
            'account.required'     => '请输入注册邮箱号或手机号' ,
//            'account.unique'       => '该账号已注册' ,
            'password.required'  => '请输入注册密码' ,
            'password.confirmed' => '两次输入密码不一致' ,
            'code.required'      => '请输入验证码' ,
        ];
    }
}
