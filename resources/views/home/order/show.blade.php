@extends('home.layouts.master')
@section('content')
    <div id="content" style="background: #f5f5f5;overflow: hidden">
        <div class="ordercontent main">
            @include('home.personal_center.layouts.slider')
            <div class="orderright">
                <div class="orderlist">
                    <h2>
                        <a href="{{route('home.personal_center')}}">我的订单</a>
                        >
                        订单详情
                        <div style="float: right;margin-right: 30px">
                            订单号:{{$order['number']}}
                            @if($order['status'] ==1)
                                <span class="layui-badge layui-bg-blue">未支付</span>
                            @elseif($order['status'] ==2)
                                <span class="layui-badge layui-bg-orange"> 已支付 </span>
                            @elseif($order['status'] ==3)
                                待发货
                            @elseif($order['status'] ==4)
                                已发货
                            @elseif($order['status'] ==5)
                                交易已完成
                            @endif
                        </div>
                    </h2>
                    <div style="padding: 20px;">
                        <div class="layui-form">
                            <table class="layui-table">
                                <colgroup>
                                    <col>
                                    <co>
                                        <col>
                                        <col>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>商品标题</th>
                                    <th>商品图片</th>
                                    <th>数量</th>
                                    <th>单价</th>
                                    <th>小计</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->orderDetail as $orderDetail)
                                    <tr>
                                        <td>{{$orderDetail['id']}}</td>
                                        <td>{{$orderDetail['title']}}</td>
                                        <td><img src="{{$orderDetail['pic']}}" width="50" alt=""></td>
                                        <td>{{$orderDetail['num']}}</td>
                                        <td>{{$orderDetail['price']}}</td>
                                        <td>{{$orderDetail['price'] * $orderDetail['num']}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
@endpush
