@extends('admin.layouts.master')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">首页</a></li>
                <li class="breadcrumb-item active">栏目管理</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-b-0">
                    <h4 class="card-title">栏目管理</h4>
                </div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('admin.category.index')}}">
                            <span class="hidden-sm-up"><i class="ti-home"></i></span>
                            <span class="hidden-xs-down">栏目列表</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.category.create')}}">
                            <span class="hidden-sm-up"><i class="ti-user"></i></span> <span
                                class="hidden-xs-down">添加栏目</span>
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
                                    <th>栏目名称</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        {{--这里的$category是数组，不是对象不能箭头调用--}}
                                        <td>{{$category['id']}}</td>
                                        {{--_name属性是经过树状结构递归排列后有的属性,打印出来有缩进--}}
                                        <td>{!! $category['_name'] !!}</td>
                                        {{--<td>{{$category['_name']}}</td>  二级会标签实体化--}}
                                        <td>
                                            <a href="{{route('admin.category.edit',['id'=>$category['id']])}}"> <i
                                                    class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                            <a href="javascript:;" onclick="del(this)" data-toggle="tooltip"
                                               data-original-title="Close"> <i
                                                    class="fa fa-close text-danger"></i> </a>
                                            <form action="{{route('admin.category.destroy',['id'=>$category['id']])}}"
                                                         method="post">
                                                @csrf @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
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
