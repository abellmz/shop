<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="">
    <title>{{hd_config('website.site_name')}}</title>
    <script src="{{asset ('org/home')}}/js/jquery-1.10.1.min.js" type="text/javascript" charset="utf-8"></script>
    @stack('css')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>
    <link rel="stylesheet" href="{{asset ('org/layui/css/layui.css')}}">
</head>

<body>
<!--头部开始-->
<div id="top">
    <!--头部灰条就开始-->
    <div class="topbox">
        <div class="main">
            <div class="topleft fl">
                <a href="/">欢迎来到{{hd_config('website.site_name')}}</a>
            </div>
            <div class="topright fr">
                <div class="login fl">
                    @auth()
                        <a href="">{{auth ()->user ()->name}}</a>
                        <a href="{{route ('home.logout',['from'=>url ()->full()])}}">注销</a>
                    @else
                        <a href="{{route ('home.login',['from'=>url ()->full()])}}">登录</a>
                        <a href="{{route ('home.register')}}">注册</a>
                    @endauth
                </div>
                @auth()
                    <span class="fl">|</span>
                    <div class="fcode fl">
                        <a href="">我的订单</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
    <!--头部灰条结束-->

    <!--logo区域开始-->
    <div class="logoRegion">
        <div class="main">
            <div class="logo">
                <a href="/"><img width="100px" src="{{hd_config('website.site_logo')}}"/></a>
            </div>
            <div class="seachRegion">
                <div class="seach fl">
                    <form action="{{route('home.search')}}" >
                        <input type="text" class="seachtxt fl" name="kwd" value="{{request()->query('Kwd')}}" placeholder="请。。"/>
                        <input type="submit" class="btn" value=""/>
                    </form>
                    <p class="searchkey">
                        <a href="">电竞配件低至5折</a>
                        <a href="">电竞配件低至5折</a>
                        <a href="">电竞配件低至5折</a>
                    </p>

                </div>
                <div class="topshopcart fr">
                    <a href="" class="header-cart"><i></i>我的购物车<span class="cart-size">(0)</span></a>
                    <div class="cart-tips">
                        请
                        <a href="">登录</a>后查看您的购物车。
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--logo区域结束-->
    <!--导航开始-->
    <div class="navbox">
        <div class="main">
            <h5 class="fl"><a href=""><i></i>全部智能酷品</a></h5>
            <ul class="menu fl">
                @foreach($_categories as $category)
                    <li class="menulist">
                        <a href="{{route ('home.list',['list'=>$category['id']])}}">{{$category['name']}}</a>
                        @if($category->good->count() != 0)
                            <div class="menuHiden">
                                <ul class="product">
                                    @foreach($category->good()->limit(5)->get() as $good)
                                        <li>
                                            <a href="{{route ('home.content',['content'=>$good['id']])}}">
                                                <img src="{{$good->list_pic}}" alt=""/>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        {{--左侧二级菜单--}}
        @yield('menu')
    </div>
    <!--导航结束-->
    <div class="clear"></div>
    <!--banner开始 轮播图-->
@yield('flash')
<!--banner结束-->
</div>
<!--头部结束-->
<!--中间开始-->
@yield('content')
<!--中间结束-->
<!--尾部开始-->
<div class="mod-footer">
    <div class="foot-bannerw">
        <div class="foot-banner clearfix">
            <div class="banner-item">
                <a href="#" target="_blank" data-monitor="home_foot_days7"><i class="icon1">7</i>7天无理由退货</a>
            </div>
            <div class="banner-item">
                <a href="#" target="_blank" data-monitor="home_foot_days15"><i class="icon2">15</i>15天免费换货</a>
            </div>
            <div class="banner-item"><i class="icon3">包</i>满99元包邮</div>
            <div class="banner-item">
                <a href="#" target="_blank" data-monitor="home_foot_moblie"><i class="icon4">服</i>手机特色服务</a>
            </div>
        </div>
    </div>
    <div class="footer-copyright"> {{hd_config('website.site_name','万人商城')}}©2016-2018
        BYCMS工作室版权所有 {{hd_config ('website.site_icp')}}</div>
</div>
<!--尾部结束-->

<!--右边底部返回顶部-->
<div class="slidebar" id="slidebar">
    <ul>
        <li class="topback">
            <a href="javascript:;"></a>
        </li>
    </ul>
</div>
<!--右边底部返回顶部结束-->
@stack('js')
@include('layouts.message')
</body>

</html>
