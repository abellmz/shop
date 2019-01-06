@extends('home.layouts.master')
@section('content')
    <div class="body-center">
        <div class="center-content">
            <!--头部开始-->
            <div class="content-header">
                <p>恭喜您的订单提交成功 </p>
            </div>
            <!--选项结束-->
            <div class="options-all  goods" style="margin-top: 20px">
                <blockquote class="layui-elem-quote">
                    <p style="padding: 5px;">订单号:{{$order['number']}}</p>
                    <p style="padding: 5px;">总价:¥ {{$order['total_price']}}</p>
                    <p style="padding: 5px;">数量: {{$order['total_num']}}</p>
                    <div style="padding: 20px; background-color: #F2F2F2;">
                        <div class="layui-row layui-col-space15">
                            <div class="layui-col-md12">
                                <div class="layui-card">
                                    <div class="layui-card-header">订单详情</div>
                                    <div class="layui-card-body" style="overflow: hidden;">
                                        @foreach($order->orderDetail as $v)
                                            <div>
                                                <p style="max-width: 600px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;float: left">
                                                    <a  href="{{route('home.content',['content'=>$v['good_id']])}}">{{$v['title']}}</a>
                                                </p>
                                                <p style="float: left">
                                                    <span class="layui-badge layui-bg-orange">{{$v['spec']}}</span>
                                                    <span class="layui-badge layui-bg-blue">{{$v['num']}}/¥{{$v['price']}}</span>
                                                    <span class="layui-badge layui-bg-green">¥ {{$v['price']*$v['num']}}</span>
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </blockquote>

                <div class="qingdan options-public" style="border: none;">
                    <h3></h3>
                </div>
                <div class="goodsList">
                    <div class="title" style="text-align: center;color: #fff">
                        请您使用微信扫码进行支付
                    </div>
                </div>
                <br>
                <div class="goods-cont" style="text-align: center;border-bottom: none">
                    {{--                    <img src="{{asset('org/home/images/wehchat_qrcode.jpg')}}" width="200" alt="">--}}
                    <img src="{{asset('org/php_sdk_v3.0.9/example')}}/qrcode.php?data=<?php echo urlencode($url2);?>" width="200" alt="">
                </div>

            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset ('org/home')}}/css/account.css"/>
@endpush
@push('js')
    <script src="{{asset ('org/home')}}/js/list.js" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset ('org/home')}}/js/account.js" type="text/javascript" charset="utf-8"></script>
    <script>
        $(function () {
            var number = "{{$order['number']}}";
            var id = "{{$order['id']}}";
            //定时器
            setInterval(function () {//检测支付状态
                $.post("{{route('home.check_order_status')}}",{number:number},function (res) {
                    if(res.code == 1){
                        //加载页面
                        location.href = "/home/order/"+id;
                    }
                },'json')
            },1000)
        })
    </script>
@endpush
