@extends('admin.layouts.master')
@section('content')

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">首页</a></li>
                <li class="breadcrumb-item active">角色管理</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-b-0">
                    <h4 class="card-title">角色管理</h4>
                </div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('admin.role.index')}}">
                            <span class="hidden-sm-up"><i class="ti-home"></i></span>
                            <span class="hidden-xs-down">角色列表</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.role.create')}}">
                            <span class="hidden-sm-up"><i class="ti-user"></i></span> <span
                                class="hidden-xs-down">添加角色</span>
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
                                    <th>角色名称</th>
                                    <th>角色标识</th>
                                    <th>添加时间</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role['id']}}</td>
                                        <td>{{$role['title']}}</td>
                                        <td>{{$role['name']}}</td>
                                        <td>{{$role->created_at}}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                @if($role['name'] != 'webmaster')
                                                    <a href="{{route('admin.role.show',$role)}}" class="btn btn-secondary">设置权限</a>

                                                    <a href="{{route ('admin.role.edit',$role)}}" class="btn btn-secondary">编辑</a>
                                                    <button type="button" onclick="del(this)" class="btn btn-secondary">删除</button>
                                                    <form action="{{route('admin.role.destroy',$role)}}"
                                                          method="post">
                                                        @csrf @method('DELETE')
                                                    </form>
                                                @endif
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
            {{$roles->links()}}
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
