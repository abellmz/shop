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
                    <h4 class="card-title">
                        订单详情
                        @if($order['status'] ==1)
                            <span class="label label-warning">待支付</span>
                        @elseif($order['status'] ==2)
                            <span class="label label-info"> 已支付 </span>
                        @elseif($order['status'] ==3)
                            <span class="label label-success">待发货</span>
                        @elseif($order['status'] ==4)
                            <span class="label label-success">待确认</span>
                        @elseif($order['status'] ==5)
                            <span class="label label-success">交易完成</span>
                        @endif
                    </h4>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>商品名称</th>
                                    <th>商品单价</th>
                                    <th>商品图片</th>
                                    <th>购买数量</th>
                                    <th>小计</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->orderDetail as $detail)
                                    <tr>
                                        <td>{{$detail['id']}}</td>
                                        <td>{{$detail['title']}}</td>
                                        <td>{{$detail['price']}}</td>
                                        <td><img src="{{$detail['pic']}}" width="60" alt=""></td>
                                        <td>{{$detail['num']}}</td>
                                        <td>{{$detail['num']*$detail['price']}}</td>

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
