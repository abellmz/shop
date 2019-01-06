@extends('home.layouts.master')
@section('content')
    <div id="content">
        <div class="list">
            <div class="main">
                <h4 class="listoption">
                    <a href="/">首页</a>
                    >
                    搜索：{{$kwd}}
                </h4>
            </div>
        </div>

        <div class="listcontent" style="overflow: hidden">
            <div class="main" style="overflow: hidden">
                @if(count ($goods) != 0)
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
                    {{--引用自定义的分页视图--}}
                    {{--{{$goods->appends(['price' => request ()->query('price'),'kwd'=>$kwd])->links('vendor.pagination.list_page')}}--}}
                @else
                    <p style="padding: 200px;text-align: center;color: #848484;">
                        <span class="layui-icon layui-icon-face-surprised"></span>
                        sorry,没有您要搜索的商品(⊙o⊙)哦
                    </p>
                @endif
            </div>

        </div>

    </div>
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset ('org/home')}}/css/index.css"/>
@endpush
@push('js')
    <script src="{{asset ('org/home')}}/js/list.js" type="text/javascript" charset="utf-8"></script>
@endpush

