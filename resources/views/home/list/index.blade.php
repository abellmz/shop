@extends('home.layouts.master')
@section('content')
    <div id="content">
        <div class="list">
            <div class="main">
                <h4 class="listoption"><a href="#">首页</a>&gt;<a href="#">全部商品列表</a></h4>
                <div class="postion">
                    <dl>
                        <dt>分类:</dt>

                        <dd>
                            <a href="">娱乐影音</a>
                            <a href="">智能家居</a>
                            <a href="">手机/配件</a>
                            <a href="">智能穿戴</a>
                            <a href="">母婴玩具</a>
                            <a href="">电脑/游戏</a>
                            <a href="">汽车用品</a>
                            <a href="">同城二手</a>
                            <a href="">无人机/机器人</a>
                            <a href="">娱乐影音</a>
                        </dd>

                    </dl>


                    <dl>
                        <dt>品牌:</dt>
                        <dd>
                            <a href="">娱乐影音</a>
                            <a href="">360</a>
                            <a href="">漫步者</a>
                            <a href="">JBL</a>
                            <a href="">beats</a>
                            <a href="">宜客莱</a>
                            <a href="">铁三角</a>
                            <a href="">大管家</a>
                            <a href="">黑爵</a>
                            <a href="">奥睿科</a>
                        </dd>
                    </dl>
                    <dl>
                        <dt>排序:</dt>
                        <dd>
                            <a href="{{route ('home.list',['list'=>$list])}}">默认</a>
                            @if(request ()->query('price') == 'asc')
                                <a href="{{route ('home.list',['list'=>$list,'price'=>'desc'])}}">价格</a>
                            @else
                                <a href="{{route ('home.list',['list'=>$list,'price'=>'asc'])}}">价格</a>
                            @endif
                        </dd>

                    </dl>
                </div>

            </div>
        </div>

        <div class="listcontent" style="overflow: hidden">
            <div class="main" style="overflow: hidden">
                <ul>
                    @foreach($goods as $good)
                        <li>
                            <div class="listdesc">
                                <dl class="desc">
                                    <a href="{{route ('home.content',['content'=>$good['id']])}}" class="pro_list">
                                        <dt class="pic">
                                            <img class="lazy" src="{{$good['list_pic']}}"
                                                 alt="{{$good['title']}}"></dt>
                                        <dd class="cont">
                                            <span class="title">{{$good['title']}}</span>
                                            <span class="price">{{$good['price']}}元</span>
                                        </dd>
                                    </a>
                                    <dd class="btns">
                                        <a href="javascript:;" class="add-cart"><i></i><em>加入购物车</em></a>
                                    </dd>
                                </dl>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{$goods->links()}}
        </div>

    </div>
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset ('org/home')}}/css/index.css"/>
@endpush
@push('js')
    <script src="{{asset ('org/home')}}/js/list.js" type="text/javascript" charset="utf-8"></script>
@endpush


