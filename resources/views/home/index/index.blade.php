@extends('home.layouts.master')
@section('menu')
    <div class="main hiden">
        <div class="navHidden">
            <ul class="list2">
                <?php
                $i = 0;
                ?>
                @foreach($categoryData as $v)
                    <?php $i++;?>
                    @if($i<9)
                        <li>
                            <a href="{{route ('home.list',['list'=>$v['id']])}}"><i></i>{{$v['name']}}</a>
                            <div class="listhide">
                                <div class="contentOne">

                                    @foreach($v['_data'] as $vv)
                                        <dl>
                                            <dt>{{$vv['name']}}&gt;</dt>

                                            @foreach($vv['_data'] as $vvv)
                                                <dd>
                                                    <a href="{{route ('home.list',['list'=>$vvv['id']])}}"
                                                       class="noo">{{$vvv['name']}}</a>
                                                </dd>
                                            @endforeach

                                        </dl>
                                    @endforeach

                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach


            </ul>
        </div>

        <div class="topad">
            @foreach($good as $v)
                <div class="righttopad">
                    <a href="{{route ('home.content',['content'=>$v['id']])}}">
                        <img width="200" src="{{$v['list_pic']}}"/>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('flash')
    <div class="banner">
        <ul class="pic">
            <li style="background: url('{{asset ('org/home')}}/images//1.webp.jpg') no-repeat center center;">
                <a href=""></a>
            </li>
            <li style="background: url({{asset ('org/home')}}/images//2.webp.jpg) no-repeat center center;">
                <a href=""></a>
            </li>
            <li style="background: url({{asset ('org/home')}}/images//3.webp.jpg) no-repeat center center;">
                <a href=""></a>
            </li>
            <li style="background: url({{asset ('org/home')}}/images//4.webp.jpg) no-repeat center center;">
                <a href=""></a>
            </li>
            <li style="background: url({{asset ('org/home')}}/images//5.webp.jpg) no-repeat center center;">
                <a href=""></a>
            </li>

        </ul>
        <ul class="dot">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <span class="prev"></span><span class="next"></span>
    </div>
@endsection
@section('content')
    <div id="content">
        <div class="main">
            <div class="tip">
                <ul>
                    @foreach($latestGood as $v)
                        <li>
                            <a href="{{route ('home.content',['content'=>$v['id']])}}"><img width="240"
                                                                                            src="{{$v['list_pic']}}"
                                                                                            alt=""/></a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="hot" id="hot">
                <h5 class="hline">
                    <span class="vline"></span>
                    <span class="tiao"></span>
                    <span class="zi">热门活动</span>
                    <span class="tiao"></span>
                    <span class="vline"></span></h5>
            </div>
            <!--楼层一-->
            <div class="container" id="floor1">
                <div class="part-title">{{$oneFloor['name']}}</div>
                <a href="{{route ('home.list',['list'=>1])}}" target="_blank" class="indexmore">更多</a>
            </div>
            <div class="container">

                <div class="part-center" style="width: 990px">
                    <ul>
                        <?php $i = 0;?>
                        @foreach($oneFloor['data'] as $v)
                            <?php $i++;?>
                            @if($i<3)
                                <li>
                                    <a href="{{route ('home.content',['content'=>$v['id']])}}">
                                        <span class="title">{{$v['title']}}</span>
                                        <span class="info">{{$v['description']}}</span>
                                        <span class="price">{{$v['price']}}</span>
                                        <img width="120" src="{{$v['list_pic']}}" alt=""/>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="part-right">
                    <p class="part-suggest-title">热销推荐</p>
                    <div class="slideBox">
                        <div class="slider-film">
                            <?php $i = 0;?>
                            @foreach($oneFloor['data'] as $v)
                                <?php $i++;?>
                                @if($i>=3 and $i<5)
                                    <a href="{{route ('home.content',['content'=>$v['id']])}}">
                                        <dl>
                                            <dt><img src="{{$v['list_pic']}}" width="50"></dt>
                                            <dd class="title">{{$v['title']}}</dd>
                                            <dd class="info">{{$v['description']}}</dd>
                                            <dd class="price"><i class="yen">￥</i>{{$v['price']}}</dd>
                                        </dl>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="slide-point">
                        <a href="javascript:;" class="curr-point"></a>
                        <a href="javascript:;"></a>
                    </div>

                </div>
            </div>
            <!--楼层二-->
            <div class="container" id="floor2">
            </div>
            <!--楼层三-->
            <div class="container" id="floor3">
            </div>
            <!--楼层四-->
            <div class="container" id="floor4"></div>
            <!--新品速递-->
            <div class="newproduct" id="newproduct">
                <div class="part-title">新品速递</div>
                <ul class="newproduct-list">
                    <li>
                        <a href="" class="new-item">
                            <dl>
                                <dt><img class="js-lazyload" src="{{asset ('org/home')}}/images/right.png"></dt>
                                <dd class="title">铁三角（Audio-technica）ATH-CKB50 平衡动铁时尚入耳式耳机</dd>
                                <dd class="price"><span><i class="yen">￥</i>289</span> 09-18上新</dd>
                            </dl>
                        </a>
                    </li>
                    <li>
                        <a href="" class="new-item">
                            <dl>
                                <dt><img class="js-lazyload" src="{{asset ('org/home')}}/images/right.png"></dt>
                                <dd class="title">铁三角（Audio-technica）ATH-CKB50 平衡动铁时尚入耳式耳机</dd>
                                <dd class="price"><span><i class="yen">￥</i>289</span> 09-18上新</dd>
                            </dl>
                        </a>
                    </li>
                    <li>
                        <a href="" class="new-item">
                            <dl>
                                <dt><img class="js-lazyload" src="{{asset ('org/home')}}/images/right.png"></dt>
                                <dd class="title">铁三角（Audio-technica）ATH-CKB50 平衡动铁时尚入耳式耳机</dd>
                                <dd class="price"><span><i class="yen">￥</i>289</span> 09-18上新</dd>
                            </dl>
                        </a>
                    </li>
                    <li>
                        <a href="" class="new-item">
                            <dl>
                                <dt><img class="js-lazyload" src="{{asset ('org/home')}}/images/right.png"></dt>
                                <dd class="title">铁三角（Audio-technica）ATH-CKB50 平衡动铁时尚入耳式耳机</dd>
                                <dd class="price"><span><i class="yen">￥</i>289</span> 09-18上新</dd>
                            </dl>
                        </a>
                    </li>
                    <li>
                        <a href="" class="new-item">
                            <dl>
                                <dt><img class="js-lazyload" src="{{asset ('org/home')}}/images/right.png"></dt>
                                <dd class="title">铁三角（Audio-technica）ATH-CKB50 平衡动铁时尚入耳式耳机</dd>
                                <dd class="price"><span><i class="yen">￥</i>289</span> 09-18上新</dd>
                            </dl>
                        </a>
                    </li>
                    <li>
                        <a href="" class="new-item">
                            <dl>
                                <dt><img class="js-lazyload" src="{{asset ('org/home')}}/images/right.png"></dt>
                                <dd class="title">铁三角（Audio-technica）ATH-CKB50 平衡动铁时尚入耳式耳机</dd>
                                <dd class="price"><span><i class="yen">￥</i>289</span> 09-18上新</dd>
                            </dl>
                        </a>
                    </li>
                    <li>
                        <a href="" class="new-item">
                            <dl>
                                <dt><img class="js-lazyload" src="{{asset ('org/home')}}/images/right.png"></dt>
                                <dd class="title">铁三角（Audio-technica）ATH-CKB50 平衡动铁时尚入耳式耳机</dd>
                                <dd class="price"><span><i class="yen">￥</i>289</span> 09-18上新</dd>
                            </dl>
                        </a>
                    </li>
                    <li>
                        <a href="" class="new-item">
                            <dl>
                                <dt><img class="js-lazyload" src="{{asset ('org/home')}}/images/right.png"></dt>
                                <dd class="title">铁三角（Audio-technica）ATH-CKB50 平衡动铁时尚入耳式耳机</dd>
                                <dd class="price"><span><i class="yen">￥</i>289</span> 09-18上新</dd>
                            </dl>
                        </a>
                    </li>
                    <li>
                        <a href="" class="new-item">
                            <dl>
                                <dt><img class="js-lazyload" src="{{asset ('org/home')}}/images/right.png"></dt>
                                <dd class="title">铁三角（Audio-technica）ATH-CKB50 平衡动铁时尚入耳式耳机</dd>
                                <dd class="price"><span><i class="yen">￥</i>289</span> 09-18上新</dd>
                            </dl>
                        </a>
                    </li>
                    <li>
                        <a href="" class="new-item">
                            <dl>
                                <dt><img class="js-lazyload" src="{{asset ('org/home')}}/images/right.png"></dt>
                                <dd class="title">铁三角（Audio-technica）ATH-CKB50 平衡动铁时尚入耳式耳机</dd>
                                <dd class="price"><span><i class="yen">￥</i>289</span> 09-18上新</dd>
                            </dl>
                        </a>
                    </li>
                    <li>
                        <a href="" class="new-item">
                            <dl>
                                <dt><img class="js-lazyload" src="{{asset ('org/home')}}/images/right.png"></dt>
                                <dd class="title">铁三角（Audio-technica）ATH-CKB50 平衡动铁时尚入耳式耳机</dd>
                                <dd class="price"><span><i class="yen">￥</i>289</span> 09-18上新</dd>
                            </dl>
                        </a>
                    </li>
                    <li>
                        <a href="" class="new-item">
                            <dl>
                                <dt><img class="js-lazyload" src="{{asset ('org/home')}}/images/right.png"></dt>
                                <dd class="title">铁三角（Audio-technica）ATH-CKB50 平衡动铁时尚入耳式耳机</dd>
                                <dd class="price"><span><i class="yen">￥</i>289</span> 09-18上新</dd>
                            </dl>
                        </a>
                    </li>
                    <li>
                        <a href="" class="new-item">
                            <dl>
                                <dt><img class="js-lazyload" src="{{asset ('org/home')}}/images/right.png"></dt>
                                <dd class="title">铁三角（Audio-technica）ATH-CKB50 平衡动铁时尚入耳式耳机</dd>
                                <dd class="price"><span><i class="yen">￥</i>289</span> 09-18上新</dd>
                            </dl>
                        </a>
                    </li>
                    <li>
                        <a href="" class="new-item">
                            <dl>
                                <dt><img class="js-lazyload" src="{{asset ('org/home')}}/images/right.png"></dt>
                                <dd class="title">铁三角（Audio-technica）ATH-CKB50 平衡动铁时尚入耳式耳机</dd>
                                <dd class="price"><span><i class="yen">￥</i>289</span> 09-18上新</dd>
                            </dl>
                        </a>
                    </li>
                    <li>
                        <a href="" class="new-item">
                            <dl>
                                <dt><img class="js-lazyload" src="{{asset ('org/home')}}/images/right.png"></dt>
                                <dd class="title">铁三角（Audio-technica）ATH-CKB50 平衡动铁时尚入耳式耳机</dd>
                                <dd class="price"><span><i class="yen">￥</i>289</span> 09-18上新</dd>
                            </dl>
                        </a>
                    </li>
                </ul>
                <div class="nomore" style="display: block;">没有更多了</div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset ('org/home')}}/css/index.css"/>
@endpush
@push('js')
    <script src="{{asset ('org/home')}}/js/index.js" type="text/javascript" charset="utf-8"></script>
@endpush
