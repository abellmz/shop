<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    {{--<link rel="icon" type="text/css" href="icon.ico"/>--}}
    <link rel="stylesheet" type="text/css" href="{{asset ('org/home')}}/css/index.css" />
    <script src="{{asset ('org/home')}}/js/jquery-1.10.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset ('org/home')}}/js/list.js" type="text/javascript" charset="utf-8"></script>
    {{--ajx上传 meta令牌无效就采用以下的方法--}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>

<body style="background: #f5f5f5;">
<div class="regcontent">
    <div class="layout">

        <form action="{{route('home.register')}}" method="post">
            @csrf
            <div class="reglogo">
                <a href=""><img src="{{asset ('org/home')}}/images/360logo.png" /></a>
                <span>帐号注册</span>
            </div>
            <div class="reginput">
                <div class="username"><input type="text" name="name"  placeholder="请输入昵称" required="required" />{{old('name')}}</div>
                <div class="email"><input type="text" name="account" id="email" placeholder="请输入邮箱或手机号" required="required" value="{{old('account')}}"/></div>
                <div class="password"><input type="password" name="password" placeholder="请输入密码" required="required" /></div>
                <div class="password"><input type="password" name="password_confirmation" placeholder="请确认密码" required="required" /></div>
                <div class="code"><input type="" name="code" value="" class="codeimg" placeholder="请输入验证码" required="required" /><img onclick="sendCode(this)" class="" src="{{asset ('org/home')}}/images/car.jpg" /></div>

            </div>
            <div class="btn"><input type="submit"  name="" value="注册" /></div>
            <div class="waring">
                <span>已有账号，<a href="">请直接登录</a></span>
                <span>忘记密码<a href="">密码找回</a></span>
            </div>
        </form>
        <div class="other">
            <div class="regline"></div>
            <div class="regzi">2其他方式登录</div>
        </div>
        <div class="regqq">
            <div class="regbian">
                <a href=""></a>
            </div>
        </div>

    </div>
</div>
@include('layouts.message')
<script src="{{asset ('org/home')}}/js/list.js" type="text/javascript" charset="utf-8"></script>
<script src="{{asset ('org/layer')}}/layer.js"></script>
{{--<script src="{{asset('org/layui/layui.js')}}"></script>--}}
{{--<script>--}}
    {{--//参数,规格 id--}}
    {{--function sendCode(){--}}
        {{--var $ema=$('#email').val()--}}
        {{--// console.log($ema);--}}
        {{--layer.load();--}}
        {{--//发送异步请求对应的库存--}}
        {{--$.post("{{route ('util.code.send')}}",{id:$ema},function (res) {--}}
            {{--// alert('1');--}}
            {{--layer.closeAll('loading');--}}
            {{--console.log(res);--}}
        {{--},'json');--}}
    {{--}--}}
{{--</script>--}}

{{--试用--}}
<script>
    // 点击发送验证码请求
    function sendCode(obj) {
        //==============步骤一========================//
        //点击发送验证码时候,如果是禁止状态,name 不执行事件
        if ($(obj).is('.layui-disabled')) return false;
        //获取收信邮箱
        let account = $('input[name=account]').val();
        // alert(email);
        //检测验证码格式是否为邮箱格式或手机号
        if (/.+@.+/.test(account)||/^[0-9]{11}$/.test(account)){
        }else {
            swal({
                text: '请输入正确的邮箱或手机',
                icon: "warning",
                button: false
            });
            return;
        }
        //设置验证码倒计时,单位秒
        let time = 5;
        //给按钮设置成为禁止
        $(obj).addClass('layui-disabled');
        //设置定时器
        let timer = setInterval(function () {
            //事件每秒-1
            time--;
            if (time == 0) {
                //重置发送验证码文字
                $(obj).html('发送验证码');
                //清除定时器
                clearInterval(timer);
                //清除按钮禁止状态
                $(obj).removeClass('layui-disabled');
                //停止代码继续运行
                return;
            }
            //重新构建发送验证码按钮
            $(obj).html(time + 's后可重发');
        }, 1000)
        //发送异步请求发送验证码

        //发送异步请求
        $.ajax({
            url: "{{route('util.code.send')}}",//异步请求地址
            type: 'post',//请求方式
            dataType: 'json',//返回的数据类型
            data: {//请求数据
                account: account
            },
            //请求成功回调
            success: function (response) {
                console.log(response);
                if (response.code==1){
                    swal({
                        text:response.message,
                        icon:"success",
                        button:false
                    });
                } else {
                    swal({
                        text:response.message,
                        icon:"warning",
                        button:false
                    });
                }
            },
            //失败回调
            error: function (error) {
                console.log(error);
                swal({
                    text: error.responseJSON.message,
                    icon: "warning",
                    button: false
                });
            }
        })
    }
</script>
</body>

</html>
