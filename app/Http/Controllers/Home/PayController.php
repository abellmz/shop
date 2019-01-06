<?php

namespace App\Http\Controllers\Home;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

require_once public_path('') . "/org/php_sdk_v3.0.9/example/WxPay.NativePay.php";

class PayController extends CommonController
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['notify'],
        ]);
        //因为如要执行父级构造方法,运行父级构造方法,不然当前构造方法会覆盖父级构造方法
        parent::__construct();
    }

    public function index(Request $request)
    {
//        dd(public_path('WxPay.NativePay.php'));
//        根据订单号获取订单数据
        $order = Order::where('number', $request->query('number'))->first();

        if ($order['status'] != 1) {
            return redirect()->route('home.order.show', $order)->with('danger', '当前订单已支付');
        }
//        dd($order->toArray());

        ///模式二
        /**
         * 流程：
         * 1、调用统一下单，取得code_url，生成二维码
         * 2、用户扫描二维码，进行支付
         * 3、支付完成之后，微信服务器会通知支付成功
         * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
         */

        $input = new \WxPayUnifiedOrder();
//        dd(1);
        $input->SetBody("test");//配置项  如：网站名称  设置商品或支付单简要描述
        $input->SetAttach($request->query('number'));//我们看的 订单号  用于商户携带订单的自定义数据
        $input->SetOut_trade_no("sdkphp123456789" . date("YmdHis"));//别人看的 设置商户系统内部的订单号
        $input->SetTotal_fee(intval('1'));//收一分钱        设置订单总金额，只能为整数
        $input->SetTime_start(date("YmdHis"));//生成时间        订单生成时间
        $input->SetTime_expire(date("YmdHis", time() + 600));//过期时间 需要设置时区config/app.php
        $input->SetGoods_tag("test");//商品标记，代金券或立减优惠功能的参数

        $input->SetNotify_url(route('home.notify'));//接收微信支付异步通知回调地址

        $input->SetTrade_type("NATIVE");//支付方式
        $input->SetProduct_id("123456789");//此参数必传。此id为二维码中包含的商品ID，商户自行定义。

        $notify = new \NativePay();//刷卡支付实现类
        //dd($notify);
        $result = $notify->GetPayUrl($input);//生成直接支付url，支付url有效期为2小时
//        dd($result);
        $url2 = $result["code_url"];
        return view('home.pay.index', compact('order', 'url2'));
    }
//用于微信支付后的回调通知
    public function notify()
    {
//        file_put_contents('b.php','66675');
        //接受微信 post 通知我们的数据
        $result = simplexml_load_string(file_get_contents('php://input'), 'simpleXmlElement', LIBXML_NOCDATA);
        file_put_contents('b.php', var_export($result, true));
        if ($result->result_code == 'SUCCESS' && $result->return_code == 'SUCCESS') {
            //付款成功
            //更新自己的状态状态
            Order::where('number', $result->attach)->update(['status' => 2]);
//        告诉微信我们已经收到通知
            echo "<xml>
   <return_code><![CDATA[SUCCESS]]></return_code>
   <return_msg><![CDATA[OK]]></return_msg>
</xml>";
            return true;
        }
    }

//检测订单是否已经支付
    public function checkOrderStatus()
    {
        $number = \request()->number;
//        dd('1');
        $order = Order::where('number', $number)->first();
        if ($order['status'] == 2) {
            //说明已经支付
            return ['code' => 1, 'msg' => '已支付'];
        } else {
            //说明未支付
            return ['code' => 0, 'msg' => '未支付'];
        }
    }

}
