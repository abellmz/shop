<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $role=$this->route('role');
        //route（）是个方法，用于得到路由请求解析出的请求数据
        dd($role->toArray());//得到请求的数据
        return [
            'title'=>'required|unique:roles,title,' . $role[ 'id' ] ,
            'name' =>'required|alpha|unique:roles,name,' . $role[ 'id' ] ,
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'请输入角色中文名称' ,
            'title.unique' =>'角色已存在' ,
            'name.required' =>'请输入角色英文标识' ,
            'name.unique'  =>'角色已存在' ,
            'name.alpha'    =>'角色标识只能为字母' ,
        ];
    }
}
