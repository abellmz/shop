<div class="orderleft">
    {{--头像--}}
    <div class="ordertitle">
        <h1 style="background: white;color: black;font-weight: 700;border-bottom: 1px dashed #cccccc">头像</h1>
        <div style="margin: 10px 5px auto;text-align: center;cursor: pointer">
            <img id="user_icon" src="{{auth()->user()->icon}}" width="118" class="layui-circle">
            <form action="{{route('home.user.update',auth()->user())}}"  method="post" id="editCicon">
                @csrf @method('PUT')
                <input type="hidden" name="icon" value="">
            </form>
        </div>
        <p style="text-align: center;padding-top: 10px;padding-bottom: 10px">{{auth()->user()->name}}</p>
    </div>

    <br>
    <div style="height: 20px;background: #f5f5f5"></div>
    {{--个人中心--}}
    <div class="ordertitle">
        <h1 style="background: white;color: black;font-weight: 700;border-bottom: 1px dashed #cccccc">个人中心</h1>
        <ul>
            <li class="{{ active_class(if_route('home.personal_center')||if_route('home.order.show'),'personalCenter_active','') }}"><a href="{{route('home.personal_center')}}">我的订单<span>&gt;</span></a></li>
            <li class="{{ active_class(if_route('home.user.edit'),'personalCenter_active','') }}"><a href="{{route('home.user.edit',auth()->user())}}">个人信息<span>&gt;</span></a></li>
            <li class="{{ active_class(if_route('home.address.index') || if_route('home.address.create') || if_route('home.address.edit'),'personalCenter_active','') }}"><a href="{{route('home.address.index')}}">管理地址<span>&gt;</span></a></li>
        </ul>
    </div>
</div>
<style>
    .personalCenter_active {
        background: #23ac38 !important;
    }
    .personalCenter_active a{
        color: #fff !important;
    }
    .personalCenter_active a span{
        color: #fff !important;
    }
</style>
