<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BeLoginRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
//    加载登录页面
    public function index()
    {
//        dd('1');
        return view('admin.login.index');
    }
//提胶登录
    public function login(LoginRequest $request)
    {
        //1.自定义守卫 config/auth.php  [guards , providers]
        //2.Admin 模型 需要继承Authenticatable类,参考默认 User 模型
        //3.必须制定看守器(看守者)       attempt比对 第一个参数中的字段和admin表对比，第二个参数用于记住我与对比无关
//        dd($request->all());
        if (\Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
//            dd('21');
            return redirect()->route('admin.index')->with('success', '登录成功');
        }
//        dd(11);
        return redirect()->back()->with('danger', '用户名或密码不正确');
    }
//退出登录
    public function logout()
    {
            \Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
    }
}
