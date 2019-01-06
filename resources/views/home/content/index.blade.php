@extends('home.layouts.master')
@section('content')
    <div id="content">
        <div class="cont">
            <div class="main">
                <div class="content-left">
                    <div class="box">
                        <div class="zhezhao"></div>
                        <div class="sekuai"></div>
                        <div class="smallTu"></div>
                        <a href="javascript:;" class="shang">&lt;</a>
                        <div class="list1">

                            <ul>
                                @foreach($content['pics'] as $v)
                                    <li><img src="{{$v}}" alt=""></li>
                                @endforeach

                            </ul>

                        </div>
                        <a href="javascript:;" class="xia">&gt;</a>

                        <div class="bgTu"></div>
                        <div class="bgTuHide">
                            <ul>
                                @foreach($content['pics'] as $v)
                                    <li><img width="800" src="{{$v}}" alt=""></li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="content-right">

                    <div class="tit">{{$content['title']}}</div>
                    <div class="description">{{$content['description']}}</div>
                    <div class="pirve">￥ {{$content['price']}}</div>
                    <div class="category">
                        <h4>规格</h4>
                        <ul>
                            @foreach($content->spec as $v)
                                <li spec="{{$v['id']}}" onclick="chooseSpec({{$v['id']}})" style="margin-bottom: 5px">{{$v['spec']}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="num">
                        <h5>数量</h5>
                        <a href="javascript:;" class="num_l">-</a>
                        <input type="text" value="1"/>
                        <a href="javascript:;" class="num_r">+</a>

                        <span id="cr_total" style="margin-left: 10px">{{$content['total']}}</span>
                    </div>
                    <div class="nobdr">
                        <h6 class="disabled">
                            @auth()
                                <a href="javascript:;" onclick="addCart(this)">加入购物车</a>
                            @else
                                <a href="{{route('home.login',['from'=>url()->full()])}}">加入购物车</a>
                            @endauth
                        </h6>
                    </div>
                    <div class="houdun">
                        <h3>保障</h3>
                        <p><i class="o1"></i>360商城发货&售后</p>
                        <p><i class="o2"></i>满99元包邮</p>
                        <p><i class="o3"></i>7天无理由退货</p>
                        <p><i class="o4"></i>15天免费换货</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="desc" id="xijie">
            <div class="desctab">
                <div class="main">
                    <ul>
                        <li><a href="#xijie">产品详情</a><span>|</span></li>
                        <li><a href="#guige">规格参数</a><span>|</span></li>
                        <li><a href="#wenti">常见问题</a></li>
                    </ul>
                </div>
            </div>

            <div class="con">
                {!! $content['content'] !!}
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset ('org/home')}}/css/index.css"/>
    <style>
        .disabled {
            background: #cccccc !important;
        }

        .disabled a:hover {
            background: #cccccc !important;
        }
    </style>
@endpush
@push('js')
    <script src="{{asset ('org/home')}}/js/list.js" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset ('org/layer/layer.js')}}"></script>
    <script>
        function addCart(obj) {
            if ($(obj).parents('h6').hasClass('disabled')){
                layer.msg('请先选择规格');
                return;
            } else {
                $.ajax({
                    url:"{{route('home.cart.store')}}",
                    type:'post',
                    data:{
                        id:"{{$content['id']}}",
                        spec:$('.content-right .category ul').find('li.zhong').attr('spec'),
                        num:$('.num').find('input').val()
                    },
                    dataType:'json',
                    success:function (response) {
                        // alert(response.code);
                        if (response.code==0){
                            location.href="{{route('home.login')}}?from={{url()->full()}}"
                        } else {
                            location.href='{{route('home.cart.index')}}'
                        }
                    },
                    error:function (error) {
                        console.log(error)
                    }
                })
            }
        }
        //参数,规格 id
        function chooseSpec(id) {
            layer.load();
            //发送异步请求对应的库存
            $.post("{{route ('home.spec_to_get_total')}}", {id: id}, function (res) {
                layer.closeAll('loading');
                // console.log(res)
                $('#cr_total').html(res.total);
                $('.nobdr').find('h6').removeClass('disabled')
            }, 'json')
        }

        $(function () {
         // 类cont下的content-right类下的num类 下的a标签内的类num_r
            $('.cont .content-right .num a.num_r').click(function () {
                var num = $('.cont .content-right .num input').val();
                if (num >= 0) {
                    num++;
                    $('.cont .content-right .num input').val(num);
                }
                // 相应规格能够买的最大值
                if (num >{{$content['total']}}) {
                    layer.msg('超过库存拉');
                    $('.cont .content-right .num input').val({{$content['total']}});
                }
            });
            //减法
            $('.cont .content-right .num a.num_l').click(function () {
                var num = $('.cont .content-right .num input').val();
                //防止数字小于0
                if (num <= 1) {
                    $('.cont .content-right .num input').val(1);
                }
                if (num > 1) {
                    num--;
                    $('.cont .content-right .num input').val(num);
                }
            });
        })
    </script>
@endpush
