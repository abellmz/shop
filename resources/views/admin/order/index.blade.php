@extends('admin.layouts.master')
@section('content')

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">首页</a></li>
                <li class="breadcrumb-item active">订单管理</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-b-0">
                    <h4 class="card-title">订单管理</h4>
                </div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('admin.order.index')}}">
                            <span class="hidden-sm-up"><i class="ti-home"></i></span>
                            <span class="hidden-xs-down">订单列表</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>订单号</th>
                                    <th>订单时间</th>
                                    <th>订单总价</th>
                                    <th>订单总数</th>
                                    <th>订单状态</th>
                                    <th>用户编号/昵称</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order['id']}}</td>
                                        <td>{{$order['number']}}</td>
                                        <td>{{$order['created_at']}}</td>
                                        <td>{{$order['total_price']}}</td>
                                        <td>{{$order['total_num']}}</td>
                                        <td>
                                            @if($order['status'] ==1)
                                                <span class="label label-warning">待用户支付</span>
                                            @elseif($order['status'] ==2)
                                                <span class="label label-info"> 已支付,等待发货 </span>
                                            @elseif($order['status'] ==3)
                                                <span class="label label-success">等待发货</span>
                                            @elseif($order['status'] ==4)
                                                <span class="label label-success">已发货,待用户确认</span>
                                            @elseif($order['status'] ==5)
                                                <span class="label label-success">用户确认收货,交易完成</span>
                                            @endif
                                        </td>
                                        <td>{{$order->user->id}}/{{$order->user->name}}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a class="btn btn-outline-secondary " href="{{route('admin.order.show',$order)}}" >订单详情</a>
                                                @if($order['status'] ==1)
                                                @elseif($order['status'] ==2)
                                                    <a class="btn btn-outline-info " href="{{route('admin.order.edit',$order)}}" >确认发货</a>
                                                @elseif($order['status'] ==3)
                                                @elseif($order['status'] ==4)
                                                @elseif($order['status'] ==5)
                                                @endif

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
            {{$orders->links()}}
        </div>
    </div>
@endsection
@push('js')
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
