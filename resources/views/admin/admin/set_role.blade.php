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

    <form action="{{route('admin.admin_set_role_store',$admin)}}" method="post">
        @csrf
        <div class="card">

            <div class="card-body">

                <div class="row">
                    @foreach($roles as $k=>$role)
                        <div class="col-4">
                            <input id="checkbox{{$k}}" type="checkbox"
                                   name="roles[]"
                                   value="{{$role['name']}}"
                                   @if($admin->hasRole($role['name'])) checked @endif
                            >
                            <label for="checkbox{{$k}}">{{$role->title}}</label>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
        <button class="btn btn-primary">保存</button>
    </form>
@endsection
