@extends('admin.layouts.master')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">首页</a></li>
                <li class="breadcrumb-item active">欢迎页面</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">系统信息</h4>
                    <h6 class="card-subtitle">欢迎使用超人商城管理系统</h6>
                    <div class="row m-t-40">
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-inverse card-info">
                                <div class="box bg-info text-center">
                                    <h1 class="font-light text-white">2,064</h1>
                                    <h6 class="text-white">Total Tickets</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-primary card-inverse">
                                <div class="box text-center">
                                    <h1 class="font-light text-white">1,738</h1>
                                    <h6 class="text-white">Responded</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-inverse card-success">
                                <div class="box text-center">
                                    <h1 class="font-light text-white">1100</h1>
                                    <h6 class="text-white">Resolve</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-inverse card-dark">
                                <div class="box text-center">
                                    <h1 class="font-light text-white">964</h1>
                                    <h6 class="text-white">Pending</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">系统环境</h4>
                    <div class="table-responsive m-t-20">
                        <table class="table stylish-table">
                            <thead>
                            <tr>
                                <th>名称</th>
                                <th>。。。</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>php 版本</td>
                                <td><span class="label label-success">{{PHP_VERSION}}</span></td>
                            </tr>
                            <tr>
                                <td>Laravel 版本</td>
                                <td><span class="label label-success">{{app()->version()}}</span></td>
                            </tr>
                            <tr>
                                <td>操作系统</td>
                                <td><span class="label label-success">{{PHP_OS}}</span></td>
                            </tr>
                            <tr>
                                <td>商城版本</td>
                                <td><span class="label label-success">v1.0.0</span></td>
                            </tr>
                            <tr>
                                <td>当前域名</td>
                                <td><span class="label label-success">{{url('/')}}</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">开发信息</h4>
                    <div class="table-responsive m-t-20">
                        <table class="table stylish-table">
                            <thead>
                            <tr>
                                <th>名称</th>
                                <th>XX商城</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>开发者</td>
                                <td>李敏樟</td>
                            </tr>
                            <tr>
                                <td>联系开发者</td>
                                <td>m15701641946@163.com</td>
                            </tr>
                            <tr>
                                <td>GitHub</td>
                                <td><a target="_blank" href="https://github.com/abellmz">https://github.com/abellmz</a></td>
                            </tr>
                            <tr>
                                <td>博客</td>
                                <td><a target="_blank" href="abellmz.cn">abellmz.cn</a></td>
                            </tr>
                            <tr>
                                <td>微信/qq</td>
                                <td>
                                    {{--以下点击后自动打开qq进行登录--}}
                                    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=290646986&site=qq&menu=yes">
                                        1114708936
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

