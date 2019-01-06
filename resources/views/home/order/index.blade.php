@extends('home.layouts.master')
@section('content')
    <div class="body-center">
        <div class="center-content">
            <!--头部开始-->
            <div class="content-header">
                <p>收获地址 <span>温馨提示：为了保证您的权益，防止黄牛倒卖，订单进入正在配货状态将不能修改收货地址和发票信息！</span></p>
            </div>
            <!--头部结束-->
            <!--地址选择开始-->
            <div class="content-address">
                @if(count($addresses)!=0)
                    @foreach($addresses as $address)
                        <div class="consignee-item">
                            <span class="radio-img @if($address['is_default']==1) pitchOn @endif"
                                  address_id="{{$address['id']}}"></span>
                            <label for="adress1" class="radio">
                                <input type="radio" name="adress" id="adress1" class="radio-select" value=""/>
                                <span class="e-name">{{$address['name']}},</span>
                                <span class="city">{{$address['province']}}/{{$address['city']}}
                                    /{{$address['district']}}</span>
                                <span class="city-particular">{{$address['detail']}}</span>
                                <span class="codeNumber">{{$address['phone']}}</span>
                            </label>
                            <span class="compile"><a class="copyreader" href="{{route('home.personal_center')}}">编辑</a></span>
                        </div>
                    @endforeach
                @else
                    <div style="padding: 10px;text-align: center">
                        您还没有添加地址,请先 <a href="{{route('home.address.create')}}" style="">添加地址</a>
                    </div>
                @endif

            </div>
            <!--地址选择结束-->


            <!--选项开始-->
            <div class="options">
                <div class="options-all">
                    <div class="payment options-public">
                        <h3>支付方式</h3>
                    </div>
                    <div class="consignee-item new-ress">
                        <span class="radio-img pitchOn"></span>
                        <label for="payment" class="radio w122"><input type="radio" name="payment" id="payment"
                                                                       class="radio-select" value=""/>微信支付</label>
                    </div>
                </div>

                <div class="options-all invoice">
                    <div class=" options-public">
                        <h3>发票信息</h3>
                    </div>
                    <div class="box-all" style="overflow: hidden;">
                        <div class="consignee-item new-ress left">
                            <span class="radio-img pitchOn"></span>
                            <label for="invoice" class="radio w122 no"><input type="radio" name="invoice" id="invoice"
                                                                              class="radio-select "
                                                                              value=""/>不开发票</label>
                        </div>
                        <div class="consignee-item new-ress left">
                            <span class="radio-img "></span>
                            <label for="invoice1" class="radio w122 yes"><input type="radio" name="invoice"
                                                                                id="invoice1" class="radio-select "
                                                                                value=""/>普通发票</label>

                        </div>
                    </div>
                    <div class="con">
                        <div class="text">发票内容：购买商品明细</div>
                        <div class="text">发票抬头：请确认单位名称正确，以免因名称错误耽搁您的报销。</div>
                        <div class="box-all" style="overflow: hidden; margin-top: 10px;">
                            <a href="javascript:;" class="geren tongyong active">个人</a>
                            <a href="javascript:;" class="danwei tongyong">单位</a>
                        </div>
                        <div class="danweiname">
                            <div class="text">单位名称：</div>
                            <input type="text" name="danweiname" id="danweiname" value=""/>
                        </div>
                    </div>
                </div>

            </div>
            <!--选项结束-->
            <div class="options-all  goods">
                <div class="qingdan options-public" style="border: none;">
                    <h3>商品清单</h3>
                </div>
                <div class="goodsList">
                    <div class="title">
                        <ul>
                            <li class="l1">商品名称</li>
                            <li class="l2">单价</li>
                            <li class="l3">数量</li>
                            <li class="l4">合计</li>
                        </ul>
                    </div>
                </div>

                <div class="goods-cont">
                    <ul>

                        @foreach($orders as $order)
                            <li style="padding: 13px;">
                                <div class="gc1">
                                    <img src="{{$order['pic']}}"/>
                                    <span>{{$order['title']}}({{$order['spec']}})</span>
                                </div>
                                <div class="gc2">
                                    ¥
                                    <span>{{$order['price']}}</span>
                                </div>
                                <div class="gc3">
                                    X
                                    <span>{{$order['num']}}</span>
                                </div>
                                <div class="gc4">
                                    ¥
                                    <span>{{$order['num']*$order['price']}}</span>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>

                <!--总计-->
                <div class="zongji">
                    <ul>
                        <li>
                            共<span class="color">{{count($orders)}}</span>件
                        </li>
                        <li style="margin-top: 15px;">
                            <h3>应付总金额：<span class="color">{{$totalPrice}}</span>元</h3>
                        </li>
                    </ul>
                </div>

                <!--确认地址-->
                <div class="mailTo">
                    @if($defaultAddress)
                        <p>寄送至：<span class="m-city">{{$defaultAddress['province']}}/{{$defaultAddress['city']}}
                                /{{$defaultAddress['district']}} </span><span
                                class="m-particular">{{$defaultAddress['detail']}}</span></p>
                        <p><span class="m-name">{{$defaultAddress['name']}}</span> (收件人) <span
                                class="m-number">{{$defaultAddress['phone']}}</span></p>
                    @else
                        <p>寄送至：
                            <span class="m-city"></span>
                            <span class="m-particular"></span>
                        </p>
                        <p>
                            <span class="m-name"></span>
                            <span class="m-number">
                            </span>
                        </p>
                    @endif
                </div>
                <div class="" style="overflow: hidden;">
                    <a href="javascript:;" onclick="send()" class="liji">提交订单</a>
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
        function send() {
            //    检测是否有选中地址
            let len = $('.content-address').find('span.pitchOn').length;
            if (len == 0) {
                layer.msg('请先选择提交地址');
                return;
            }
            //路由：提交订单 存入订单表和订单详情表 并清除购物车对应数据
            $.post("{{route('home.order.store')}}", {
                address_id: $('.content-address').find('span.pitchOn').attr('address_id'),
                ids: "{{request()->query('ids')}}"
            }, function (res) {
                if (res.code == 1) {
                    location.href = '{{route('home.pay')}}?number=' + res.number;
                }
            }, 'json');
        }
    </script>
@endpush
