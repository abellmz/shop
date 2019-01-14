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
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
        <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Information</h3>
        请登录 <a href="https://www.algolia.com/" target="_blank">https://www.algolia.com/ </a>获取Application ID和Admin API Key .
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-b-0">
                    <h4 class="card-title">搜搜配置</h4>
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
                                <label class="control-label text-right col-md-3">ALGOLIA_APP_ID</label>
                                <div class="col-md-9">
                                    <input type="text" name="ALGOLIA_APP_ID" placeholder=""
                                           value="{{$config['ALGOLIA_APP_ID']}}" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">ALGOLIA_SECRET</label>
                                <div class="col-md-9">
                                    <input type="text" name="ALGOLIA_SECRET" value="{{$config['ALGOLIA_SECRET']}}"
                                           placeholder="" class="form-control">
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
