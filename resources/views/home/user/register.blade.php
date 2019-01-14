<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>用户注册</title>
    <!-- Favicon icon -->
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('org/assets/')}}/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->

    <link href="{{asset('org/assets/css')}}/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{asset('org/assets/css')}}/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{asset('org/assets/')}}/plugins/jquery/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<section id="wrapper" class="login-register login-sidebar"
         style="background-image:url(/org/assets/images/background/login-register.jpg);">
    <div class="login-box card">
        <div class="card-body">
            <form class="form-horizontal form-material" id="loginform" action="{{route ('home.user.store')}}"
                  method="post">
                @csrf
                <a href="/" class="text-center db">
                    <br/>
                    <img width="100px" src="{{hd_config ('website.site_logo',asset ('org/images/front-logo.png'))}}" alt="Home"/>
                </a>
                <h3 class="box-title m-t-40 m-b-0">注册账号</h3>
                <div class="form-group m-t-20">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" name="name"  value="{{old ('name')}}" placeholder="Name">
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" name="account" required value="{{old ('email')}}" placeholder="Email">
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required name="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required name="password_confirmation"
                               placeholder="Confirm Password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <input class="form-control" required type="text" name="code" placeholder="email code">
                        <span onclick="send(this)" class="input-group-addon btn btn-default ">发送验证码 </span>
                    </div>
                </div>


                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                type="submit">注册
                        </button>
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        <p>已有账号? <a href="{{route ('home.login')}}" class="text-info m-l-5"><b>去登陆</b></a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->

<script src="{{asset('org/assets/')}}/plugins/bootstrap/js/popper.min.js"></script>
<script src="{{asset('org/assets/')}}/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="{{asset('org/assets/js')}}/jquery.slimscroll.js"></script>
<script src="{{asset('org/assets/js')}}/waves.js"></script>
<script src="{{asset('org/assets/js')}}/sidebarmenu.js"></script>
<script src="{{asset('org/assets/')}}/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="{{asset('org/assets/')}}/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="{{asset('org/assets/js')}}/custom.min.js"></script>
<script src="{{asset('org/assets/')}}/plugins/styleswitcher/jQuery.style.switcher.js"></script>
@include('layouts.message')

<script>
    // 点击发送验证码请求
    function send(obj) {
        //==============步骤一========================//
        //点击发送验证码时候,如果是禁止状态,name 不执行事件
        if ($(obj).is('.layui-disabled')) return false;
        //获取收心邮箱
        let account = $('input[name=account]').val();
        //检测验证码格式是否为邮箱格式
        if (/.+@.+/.test(account) || /^[0-9]{11}$/.test(account)) {
        }else{
            swal({
                text: '邮箱或手机号格式有误',
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
            url: "{{route ('util.code.send')}}",//异步请求地址
            type: 'post',//请求方式
            dataType: 'json',//返回的数据类型
            data: {//请求数据
                account: account
            },
            //请求成功回调
            success: function (response) {
                //console.log(response);
                if(response.code==1){
                    swal({
                        text: response.message,
                        icon: "success",
                        button: false
                    });
                }else{
                    swal({
                        text: response.message,
                        icon: "warning",
                        button: false
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

