<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//        dd($this->route('category'));//编辑的时候做的判断
        $id=$this->route('category')?$this->route('category')->id:null;

        return [
//            要求的（不为空） 唯一的：表名 name id
            'name'=>'required|unique:categories,name,'.$id,
            'pid'=>'required',
        ];
    }
//    错误提示
    public function messages()
    {
        return [
            'name.required'=>'请输入栏目名称','name.unique'=>'栏目名称已存在','pid'=>'请输入所属栏目'
        ];
    }
}
