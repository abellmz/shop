@extends('admin.layouts.master')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">首页</a></li>
                <li class="breadcrumb-item active">管理员管理</li>
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-b-0">
            <h4 class="card-title">后台管理员管理</h4>
        </div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item">
                <a class="nav-link " href="{{route('admin.admin.index')}}">
                    <span class="hidden-sm-up"><i class="ti-home"></i></span>
                    <span class="hidden-xs-down">管理员列表</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="">
                    <span class="hidden-sm-up"><i class="ti-user"></i></span> <span
                        class="hidden-xs-down">编辑管理员</span>
                </a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="card-header"></div>
            <div class="card-body">
                <form action="{{route('admin.admin.update',$admin)}}" method="post"
                      class="form-horizontal ">
                @csrf @method('PUT')
                <!--/row-->
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">登录账号</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="" name="username" value="{{$admin ['username']}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">设置密码</label>
                        <div class="col-md-9">
                            <input type="password" placeholder="" name="password"
                                   class="form-control" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">确认密码</label>
                        <div class="col-md-9">
                            <input type="password" placeholder="" name="password_confirmation"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label text-right col-md-3"></label>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-success">保存数据</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('org/layui/css/layui.css')}}">
    <style>
        #demo2 li {
            list-style: none;
            float: left;
            border: 1px solid #cccccc;
            margin-right: 5px;
            padding: 3px;
            position: relative;
        }

        #demo2 li span {
            position: absolute;
            top: 0;
            right: 0;
            cursor: pointer;
        }
    </style>
@endpush
@push('js')
    <script src="{{asset('org/layui/layui.js')}}"></script>
    <script>
        layui.use(['upload', 'layedit'], function () {
            var $ = layui.jquery
                , upload = layui.upload;
            var layedit = layui.layedit;
            //layui编辑器
            layedit.build('demo', {
                //tool: ['left', 'center', 'right', '|', 'face'],//自定义 tollbar
                height: 380 //设置编辑器高度
                , uploadImage: {
                    url: "{{route('util.upload')}}",
                    type: 'post'
                }
            }); //建立编辑器
            //拖拽上传
            upload.render({
                elem: '#test10'
                , url: "{{route('util.upload')}}"
                , data: {
                    //'_token':"{{csrf_token ()}}"
                }
                , headers: {}//接口的请求头。如：headers: {token: 'sasasas'}。注：该参数为 layui 2.2.6 开始新增
                , accept: 'images' //指定允许上传时校验的文件类型，可选值有：images（图片）、file（所有文件）、video（视频）、audio（音频）
                , acceptMime: "{{hd_config ('upload.upload_accept_mime','image/jpg, image/png,image/jpeg')}}"
                , size: "{{hd_config ('upload.upload_size',20000000)}}" //最大允许上传的文件大小，单位 KB。不支持ie8/9
                , exts: "{{hd_config ('upload.upload_type','jpg|png|gif|bmp|jpeg')}}"
                //,drag:true //是否接受拖拽的文件上传，设置 false 可禁用。不支持ie8/9
                //上传成功之后的回调
                , done: function (res) {
                    if (res.code == 0) {
                        $('#test10').html('<img src="' + res.data.src + '" alt="" width="50"><input type="hidden" name="list_pic" value="' + res.data.src + '">')
                    } else {
                        layer.msg(res.msg, {icon: 2}, function () {
                            //关闭后的操作
                        });
                    }

                }
            });
            //多图上传
            upload.render({
                elem: '#test2'
                , url: "{{route('util.upload')}}"
                , multiple: true
                , accept: 'images' //指定允许上传时校验的文件类型，可选值有：images（图片）、file（所有文件）、video（视频）、audio（音频）
                , acceptMime: "{{hd_config ('upload.upload_accept_mime','image/jpg, image/png,image/jpeg')}}"
                , size: "{{hd_config ('upload.upload_size',20000000)}}" //最大允许上传的文件大小，单位 KB。不支持ie8/9
                , exts: "{{hd_config ('upload.upload_type','jpg|png|gif|bmp|jpeg')}}"
                // ,before: function(obj){
                //     //预读本地文件示例，不支持ie8
                //     obj.preview(function(index, file, result){
                //         $('#demo2').append('<img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img">')
                //     });
                // }
                , done: function (res) {
                    //上传完毕
                    if (res.code == 0) {
                        $('#demo2').append('<li><span onclick="delImage(this)" class="mdi mdi-close"></span><img src="' + res.data.src + '" alt="" width="50" height="50" class="layui-upload-img"><input type="hidden" name="pics[]" value="' + res.data.src + '"></li>')
                    } else {
                        layer.msg(res.msg, {icon: 2}, function () {
                            //关闭后的操作
                        });
                    }
                }
            });
        })
        ;
    </script>
    <script src="https://cdn.bootcss.com/vue/2.5.18-beta.0/vue.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                specs: {!!  old ('specs')?:'[]' !!}
            },
            methods: {
                add() {
                    this.specs.push({spec: '', total: ''})
                },
                del(k) {
                    this.specs.splice(k, 1)
                }
            }
        })
    </script>
    <script>
        //删除上传图片
        function delImage(obj) {
            $(obj).parents('li').remove();
        }
    </script>
@endpush
