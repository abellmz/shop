@extends('admin.layouts.master')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">首页</a></li>
                <li class="breadcrumb-item active">配置管理</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-b-0">
                    <h4 class="card-title">站点配置</h4>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <form action="{{route('admin.config.update',['type'=>$name])}}" method="post"
                              class="form-horizontal ">
                            {{--表当方法伪造--}}
                        @csrf @method('PUT')
                        <!--/row-->
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">网站名称(site_name)</label>
                                <div class="col-md-9">
                                    <input type="text" name="site_name" placeholder="请输入网站名称"
                                           value="{{$config['site_name']}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">网站 logo(site_logo)</label>
                                <div class="col-md-9">
                                    <div class="layui-upload-drag" id="test10">
                                        @if(isset($config['site_logo']))
                                            <img src="{{$config['site_logo']}}" width="80" alt="">
                                            <input type="hidden" name="site_logo" value="{{$config['site_logo']}}">
                                        @else

                                            <i class="layui-icon"></i>
                                            <p>点击上传，或将文件拖拽到此处</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">icp 备案信息(site_icp)</label>
                                <div class="col-md-9">
                                    <input type="text" name="site_icp" value="{{$config['site_icp']}}"
                                           placeholder="请输入 icp 备案信息" class="form-control">
                                </div>
                            </div>
                            <hr>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-success">保存数据</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('org/layui/css/layui.css')}}">
@endpush
@push('js')
    <script src="{{asset('org/layui/layui.js')}}"></script>
    <script>
        layui.use(['upload', 'layedit'], function () {
            var $ = layui.jquery
                , upload = layui.upload;
            //拖拽上传
            upload.render({
                elem: '#test10'
                , url: "{{route('util.upload')}}"
                , data: {}
                , headers: {}//接口的请求头。如：headers: {token: 'sasasas'}。注：该参数为 layui 2.2.6 开始新增
                , accept: 'images' //指定允许上传时校验的文件类型，可选值有：images（图片）、file（所有文件）、video（视频）、audio（音频）
                , acceptMime: 'image/jpg,image/png'
                , size: 50000000000 //最大允许上传的文件大小，单位 KB。不支持ie8/9
                , exts: 'jpg|png'
                //,drag:true //是否接受拖拽的文件上传，设置 false 可禁用。不支持ie8/9
                //上传成功之后的回调
                , done: function (res) {
                    if (res.code == 0) {
                        $('#test10').html('<img src="' + res.data.src + '" alt="" width="80"><input type="hidden" name="site_logo" value="' + res.data.src + '">')
                    } else {
                        layer.msg(res.msg)
                    }
                }
            });

        });
    </script>
@endpush
