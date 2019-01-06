<?php

namespace App\Http\Controllers\Home;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends CommonController
{
    public function __construct()
    {//用户可以没有不能用的方法
        $this->middleware('auth',[
            'except'=>[],
        ]);
        parent:: __construct();
    }

    public function index(Request $request)
    {
//        dd($request);
//      通过$request获取地址栏的ids
        $ids=$request->ids;
//        dd(explode(',',$ids));
        $orders=Cart::whereIn('id',explode(',',$ids))->get();
//        dd($orders);
//        总价
        $totalPrice=0;
        foreach ($orders as $order){
            $totalPrice +=$order['num']*$order['price'];
        }
        //获取当前用户所有收货地址
        $addresses=Address::where('user_id',auth()->id())->get();
        //获取当前用户默认地址
        $defaultAddress=Address::where('user_id',auth()->id())->where('is_default',1)->first();
        return view('home.order.index',compact('orders','totalPrice','addresses','defaultAddress'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Order $order)
    {
//        dd($request->toArray());
        $ids=$request->ids;
//根据购物车 ids 获取所有数据
        $cartData=Cart::whereIn('id',explode(',',$ids))->get();
        $total_price=0;
        foreach ($cartData as $v){
            $total_price +=$v['num']*$v['price'];
        }
//        事物        一旦运行错误就会回滚
        \DB::beginTransaction();
//       count、str_random这个方法乍回事？
        $order->number = time().str_random(6);//订单号
        $order->total_price = $total_price;//总价
        $order->total_num = count($cartData);//总数量
        $order->user_id = auth()->id();//使用者
        $order->address_id = $request->address_id;//传入的地址
        $order->status = 1;//购物状态
        $order->save();
// 将购物车下单的数据      循环备份给订单详情
        foreach($cartData as $v){
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;//对应订单表中的id
            $orderDetail->title = $v['title'];
            $orderDetail->price = $v['price'];
            $orderDetail->pic = $v['pic'];
            $orderDetail->num = $v['num'];
            $orderDetail->spec = $v['spec'];
            $orderDetail->good_id = $v['good_id'];
            $orderDetail->spec_id = $v['spec_id'];
            $orderDetail->save();
        }
        //清除购物车     已下单数据
        Cart::whereIn('id',explode(',',$ids))->where('user_id',auth()->id())->delete();
        \DB::commit();
        return ['code'=>1,'mag'=>'提交成功','number'=>$order->number];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('home.order.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
