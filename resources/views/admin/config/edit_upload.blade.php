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
                    <h4 class="card-title">上传配置</h4>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <form action="{{route('admin.config.update',['type'=>$name])}}" method="post"
                              class="form-horizontal ">
                        @csrf @method('PUT')
                        <!--/row-->
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">上传大小(upload_size)</label>
                                <div class="col-md-9">
                                    <input type="text" name="upload_size" placeholder=""
                                           value="{{hd_config('upload.upload_size')}}" class="form-control">
                                    <small class="form-control-feedback "> 单位为 B</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">上传类型(upload_type)</label>
                                <div class="col-md-9">
                                    <input type="text" name="upload_type" value="{{hd_config('upload.upload_type')}}"
                                           placeholder="" class="form-control">
                                    <small class="form-control-feedback "> 允许上传的文件后缀:格式:jpg|png|gif|bmp|jpeg,一般情况下,应该跟 <span class="label label-info">筛选文件类型</span> 保持一致</small>
                                    <small class="form-control-feedback "> 如果未设置:默认使用 jpg|png|jpeg</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">筛选文件类型(upload_accept_mime)</label>
                                <div class="col-md-9">
                                    <input type="text" name="upload_accept_mime" value="{{hd_config('upload.upload_accept_mime')}}"
                                           placeholder="如:image/jpg, image/png" class="form-control">
                                    <small class="form-control-feedback "> 规定打开文件选择框时，筛选出的文件类型，值为用逗号隔开的 MIME 类型列表。如：acceptMime: 'image/*'（只显示图片文件）
                                        acceptMime: 'image/jpg, image/png'（只显示 jpg 和 png 文件）</small>
                                    <small class="form-control-feedback "> 如果未设置:默认使用 image/jpg, image/png,image/jpeg</small>
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
