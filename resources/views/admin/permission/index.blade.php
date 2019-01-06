@extends('admin.layouts.master')
@section('content')

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">首页</a></li>
                <li class="breadcrumb-item active">权限管理</li>
            </ol>
        </div>
    </div>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h3 class="text-info">
            <i class="fa fa-exclamation-circle"></i>
            Information
        </h3>
        这里展示为当前网站所有后台权限.
    </div>
    <div class="card">
        <div class="card-header">
            <a href="{{route('admin.forget_permission_cache')}}">清除权限缓存</a>
        </div>
        <div class="card-body">
            @foreach($modules as $module)
                <div class="card">
                    <div class="card-header">
                        {{$module['title']}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($module['permissions'] as $v)
                                <div class="col-4">
                                    <label >{{$v['title']}} | {{$module['name']}}-{{$v['name']}}</label>
                                </div>

                            @endforeach
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection
