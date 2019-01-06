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
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h3 class="text-info">
            <i class="fa fa-exclamation-circle"></i>
            Information
        </h3>
        该项管理为对后台管理员设置权限所设置,如需管理前台会员,请到商城系统中进行管理.
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-b-0">
                    <h4 class="card-title">后台管理员管理</h4>
                </div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('admin.admin.index')}}">
                            <span class="hidden-sm-up"><i class="ti-home"></i></span>
                            <span class="hidden-xs-down">管理员列表</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.admin.create')}}">
                            <span class="hidden-sm-up"><i class="ti-user"></i></span> <span
                                class="hidden-xs-down">添加管理员</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>管理员账号</th>
                                    <th>添加时间</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($admins as $admin)
                                    <tr>
                                        <td>{{$admin['id']}}</td>
                                        <td>{{$admin['username']}}</td>
                                        <td>{{$admin->created_at}}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">

                                                <a href="{{route('admin.admin_set_role_create',$admin)}}" class="btn btn-secondary">设置角色</a>
                                                <a href="{{route ('admin.admin.edit',$admin)}}" class="btn btn-secondary">编辑</a>
                                                @can('delete',$admin)
                                                    <a href="javascript:;" onclick="del(this)" class="btn btn-secondary">
                                                        删除
                                                    </a>
                                                    <form action="{{route('admin.admin.destroy',$admin)}}"
                                                          method="post">
                                                        @csrf @method('DELETE')
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            {{$admins->links()}}
        </div>
    </div>
@endsection
@push('js')
    <script>
        function del(obj) {
            swal("确定删除吗?", {
                buttons: {
                    cancel: "取消",
                    catch: {
                        text: "确定",
                        value: "catch",
                    },
                },
            })
                .then((value) => {
                    switch (value) {
                        case "catch":
                            $(obj).next('form').submit();
                            break;
                        default:
                    }
                });
        }
    </script>
@endpush
