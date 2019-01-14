<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <title>{{hd_config('website.site_name')}}后台管理系统</title>
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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{asset('org/assets/')}}/plugins/jquery/jquery.min.js"></script>
    {{--ajx上传 meta令牌无效就采用以下的方法--}}
    <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    </script>
    @stack('css')
</head>

<body class="fix-header card-no-border">
<div id="main-wrapper">
    <!-- ============================================================== -->
@include('admin.layouts.head')
<!-- ============================================================== -->
@include('admin.layouts.slide')
<!-- ============================================================== -->
    <div class="page-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>
        <footer class="footer"> © 2018 Material Pro Admin by wubin.pro</footer>
    </div>
</div>
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
<!-- ============================================================== -->

@include('layouts.message')
@stack('js')
</body>

</html>
