
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>用户登录</title>
    <!-- Favicon icon -->
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
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<section id="wrapper" class="login-register login-sidebar"  style="background-image:url(/org/assets/images/background/login-register.jpg);">
    <div class="login-box card">
        <div class="card-body">
            <form class="form-horizontal form-material" id="loginform" action="{{route('home.login',['from'=>Request::query('from')])}}" method="post">
                @csrf
                <a href="/" class="text-center db">
                    <br/>
                    <img src="{{asset ('org/home/images/360logo.png')}}" alt="Home"/>
                </a>

                <div class="form-group m-t-40">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" name="account" value="{{old ('account')}}" required placeholder="Email or mobile">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" name="password" required="" placeholder="Password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox checkbox-primary pull-left p-t-0">
                            <input id="checkbox-signup" type="checkbox" name="remember" >
                            <label for="checkbox-signup"> Remember me </label>
                        </div>
                        <a href="" id="to-recover" class="text-dark pull-right">
                            <i class="fa fa-lock m-r-5"></i>
                            Forgot pwd?
                        </a>
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">登录</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                        <div class="social">
                            <a href="{{route('home.qq_login')}}" class="btn  btn-facebook" data-toggle="tooltip"  title="Login with QQ">
                                <i aria-hidden="true" class="fa fa-qq"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        <p>还冇账号? <a href="{{route('home.register')}}" class="text-primary m-l-5"><b>去注册</b></a></p>
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
<script src="{{asset('org/assets/')}}/plugins/jquery/jquery.min.js"></script>
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
</body>

</html>
