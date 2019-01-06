@extends('home.layouts.master')
@section('content')
    <div id="content" style="background: #f5f5f5;overflow: hidden">
        <div class="ordercontent main">
            @include('home.personal_center.layouts.slider')
            <div class="orderright">
                <div class="orderlist">
                    <h2>地址管理</h2>
                    <div style="padding: 30px">
                        <table class="layui-table" lay-size="sm">
                            <colgroup>
                                <col >
                                <col >
                                <col>
                            </colgroup>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>地址</th>
                                <th>详细地址</th>
                                <th>添加时间</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($addresses as $address)
                                <tr>
                                    <td>{{$address['id']}}</td>
                                    <td>{{$address['province']}}/{{$address['province']}}/{{$address['district']}}</td>
                                    <td>{{$address['detail']}}</td>
                                    <td>{{$address->created_at->format('Y-m-d')}}</td>
                                    <td>
                                        <div class="layui-btn-group">
                                            @if($address['is_default']==1)
                                                <button  class="layui-btn  layui-btn-sm">默认地址</button>

                                            @else
                                                <a href="{{route('home.address.update',['is_default'=>$address['id']])}})}}" class="layui-btn layui-btn-primary layui-btn-sm">设为默认</a>

                                            @endif
                                            <a href="" class="layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon"></i></a>
                                            <button class="layui-btn layui-btn-primary layui-btn-sm"><i class="layui-icon"></i></button>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <a href="{{route('home.address.create')}}" class="layui-btn">添加地址</a>
                        </table>
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
    {{--三级城市联动--}}
    <script src="https://cdn.bootcss.com/distpicker/2.0.5/distpicker.min.js"></script>
    <script src="{{asset ('org/home')}}/js/list.js" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('org/layui/layui.js')}}"></script>
    <script>
        //城市联动
        $("#distpicker").distpicker({
            province: '山西省',
            city: '临汾市',
            district: '尧都区'
        });
        layui.use(['form', 'layedit', 'laydate'], function () {
            var form = layui.form
                , layer = layui.layer
                , laydate = layui.laydate;
            //日期
            laydate.render({
                elem: '#date'
            });
            form.on('select(a)', function (data) {
                console.log(data)
                $("#a").val(data.value).change();
                form.render();
            })

            form.on('select(b)', function (data) {
                $("#b").val(data.value).change();
                form.render();
            })

            form.on('select(c)', function (data) {
                $("#c").val(data.value).change();
                form.render();
            })
        });

    </script>
@endpush
