<?php

namespace App\Http\Controllers\Home;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonalCenterController extends CommonController
{
    public function __construct()
    {
        $this->middleware('auth',
        ['except'=>[],]
        );
        parent::__construct();
    }

    public function index(){
        //获取当前登录用户的全部订单数据
        $orders=Order::where('user_id',auth()->id())->latest()->paginate(10);
//        dd('437');
        return view('home.personal_center.index',compact('orders'));
    }
}
