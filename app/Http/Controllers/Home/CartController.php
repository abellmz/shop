<?php

namespace App\Http\Controllers\Home;

use App\Models\Cart;
use App\Models\Good;
use App\Models\Spec;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends CommonController
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[],
        ]);
//执行父级构造函数，防止被当前构造函数覆盖
        parent:: __construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        获取当前用户购物车所有数据 toArray 会使对象中所有变成数组
//   all（）外层是数组，内层是对象，all()之后用不了toArray,why??
        $carts=Cart::where('user_id',auth()->id())->get();
//        dd($carts->all());
        foreach($carts as $k=>$cart){
//            dump('');//塞进去一个checked属性
            $carts[$k]['checked']=false;
        }
//        dd($carts->toArray());
        return view('home.cart.index',compact('carts'));
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
    public function store(Request $request,Cart $cart)
    {
//        dd($request->all());
        $good=Good::find($request->id);
        $spec=Spec::find($request->spec);
        $newCart=Cart::where('user_id',auth()->id())->where('good_id',$request->id)->where('spec_id',$request->spec)->first();
//        dd(Cart::where('user_id',auth()->id())->get());
//        dd($good->list_pic);
        if (!$newCart){
            $cart->pic=$good->list_pic;
            $cart->good_id=$request->id;
            $cart->title=$good->title;
            $cart->spec   =$spec->spec;
            $cart->price  =$good->price;
            $cart->num    =$request->num;
            $cart->user_id=auth()->id();
            $cart->spec_id=$request->spec;
            $cart->save();
        }else{
            $newCart->num=(int)$newCart['num']+(int)$request->num;
            $newCart->save();
        }
        return ['code'=>1,'msg'=>'添加成功'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
//        dd($request->num);
        $cart->num=$request->num;
        $cart->save();
        return ['code'=>200,'msg'=>'更新成功'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        dd($cart->toArray());
            $cart->delete();
            return ['code'=>200,'msg'=>'删除成功'];
    }
}
