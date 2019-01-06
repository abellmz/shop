<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\BeLoginRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends CommonController
{
    public function __construct()
    {//游客可以调用的方法
        $this->middleware('guest', [
                'only' => ['login', 'loginForm', 'register', 'store', 'passwordReset', 'passwordResetForm']
            ]
        );
        parent::__construct();
    }

//    登录
    public function login()
    {
        return view('home.user.login');
    }

//    登录表单 的数据接收
    public function loginForm(BeLoginRequest $request)
    {
//        dd($request->all());
        $data = $request->only('password');
//   dd($data);判断是否为email账号   变量      过滤器
        if (filter_var($request['account'],FILTER_VALIDATE_EMAIL)){
            $data['email']=$request['account'];
        }else{
            $data['mobile']=$request['account'];
        }
        $data['password']=$request['password'];
//        dd($data);
//        if (\Auth::attempt($credentials, $request->remember)) {
//        attempt第一参数自动与数据表数据对比，第二参数为附加参数，指记住这些数据
        if (\Auth::attempt($data, $request->remember)) {
            // 登录成功，跳转到首页  从Request类中取出存储的下标为from的值
            return redirect($request->from?:'/')->with('success', '登录成功');
        }
        return redirect()->back()->with('danger', '用户名或密码不正确');
    }
//    注册
    public function register()
    {
        return view('home.user.register');
    }
//    重置表单
    public function passwordReset()
    {

    }

//重置表单 数据接收
    public function passwordResetForm()
    {

    }

//注销登录
    public function logout()
    {
//        dd('1');
        \Auth::logout();
        return redirect()->route('home.home');
    }

//    存储注册数据
    public function store(RegisterRequest $request)
    {
//        dd($request->all());
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);//加密
        $data['name']=$data['name']?:'';//给每个用户昵称,因为数据表设置 name 不允许为空所以需要给出默认值
        $data['token']=str_random(50);//给每个注册用户随机一个字符串
       if (filter_var($data['account'],FILTER_VALIDATE_EMAIL)){
           //修改数据表中 email_verified_at 字段
           $data[ 'email_verified_at' ]=now();//now()函数获取当前时间
           $data['email'] = $data['account'];
       }else{
           $data[ 'mobile_verified_at' ]=now();//now()函数获取当前时间
           $data['mobile'] = $data['account'];
           $data['email'] = '';
       }
        //将数据写入数据表中
        $user=User::create($data);
       $user->name='豪侠'.$user['id'].'号';
       $user->save();
//        数据库填数据
//        重定向，即跳转，三村  需要模板调用才会提示
        return redirect()->route('home.login')->with('success', '注册成功');
    }

    public function edit(User $user)
    {
        return view('home.user.edit',compact('user'));
    }
}
