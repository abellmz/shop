@extends('home.layouts.master')
@section('content')
    <div id="content" style="background: #f5f5f5;overflow: hidden">
        <div class="ordercontent main">
            @include('home.personal_center.layouts.slider')
            <div class="orderright">
                <div class="orderlist">
                    <h2>我的订单</h2>
                    <div style="padding: 30px;">
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
                                    <th></th>
                                    <th>订单号</th>
                                    <th>订单总价</th>
                                    <th>订单数</th>
                                    <th>下单时间</th>
                                    <th>订单状态</th>
                                    <th>格言</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order['id']}}</td>
                                        <td>{{$order['number']}}</td>
                                        <td>{{$order['total_price']}}</td>
                                        <td>{{$order['total_num']}}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td>
                                            @if($order['status'] ==1)
                                                <span class="layui-badge layui-bg-orange">未支付</span>
                                            @elseif($order['status'] ==2)
                                                <span class="layui-badge layui-bg-blue"> 已支付,待发货 </span>
                                            @elseif($order['status'] ==3)
                                                待发货
                                            @elseif($order['status'] ==4)
                                                <span class="layui-badge layui-bg-green"> 已发货 </span>
                                            @elseif($order['status'] ==5)
                                                交易已完成
                                            @endif
                                        </td>
                                        <td>
                                            <div class="layui-btn-group">
                                                {{--订单状态1未支付,2已支付,3待发货,4已发货,5交易已完成--}}
                                                @if($order['status'] ==1)
                                                    <a href="{{route('home.pay',['number'=>$order['number']])}}" class="layui-btn layui-btn-primary  layui-btn-sm" title="去支付">去支付</a>
                                                @elseif($order['status'] ==2)
                                                @elseif($order['status'] ==3)
                                                    <a href="{{route('home.order.edit',$order)}}" class="layui-btn layui-btn-primary  layui-btn-sm" title="确认收货">确认收货</a>
                                                @elseif($order['status'] ==4)
                                                    <a href="{{route('home.order.edit',$order)}}" class="layui-btn layui-btn-primary  layui-btn-sm" title="确认收货">确认收货</a>
                                                @elseif($order['status'] ==5)
                                                @endif
                                                <a href="{{route('home.order.show',$order)}}" class="layui-btn layui-btn-primary  layui-btn-sm" title="去支付">订单详情</a>
                                                <button onclick="del(this)" type="button" class="layui-btn layui-btn-danger layui-btn-sm">删除订单</button>
                                                <form action="{{route('home.order.destroy',$order)}}" method="post">
                                                    @csrf @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
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
    <script>
        function del(obj) {
            swal("确定删除吗?", {
                buttons: {
                    cancel: "取消",
                    catch: {
                        text: "确定",
                        value: "catch",
                    },
                },
            })
                .then((value) => {
                    switch (value) {
                        case "catch":
                            $(obj).next('form').submit();
                            break;
                        default:
                    }
                });
        }
    </script>
@endpush
