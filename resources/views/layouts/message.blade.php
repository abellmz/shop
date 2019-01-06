<script src="https://cdn.bootcss.com/sweetalert/2.1.2/sweetalert.min.js"></script>
{{--消息模板提示由 https://sweetalert.bootcss.com/docs/ 友情赞助BootCDN已经收录了 SweetAler--}}
{{--表单验证错误处理   验证错误都将自动闪存到会话中,$errors作为MessageBag的实例，
并被ShareErrorsFromSession中间件绑定到视图中，中间件被应用后，在你的视图中就可以获取到 $error 变量--}}
@if ($errors->any())
    <script>
        swal({
            //循环出所有的错误
            text: "@foreach ($errors->all() as $error) {{ $error }}\r\n @endforeach",
            icon: "warning",
            button: false//button不显示
        });
    </script>
@endif


<?php
////    打印所有 session 可看到我们闪存的 succes 和 danger
//dump(session()->all())
//?>

{{--成功提示--}}
{{--@if (session()->has('success'))--}}
    {{--<script>--}}
        {{--swal({--}}
            {{--//得到所有success信息--}}
            {{--text: "{{session()->get('success')}}",--}}
            {{--icon: "success",--}}
            {{--button: false--}}
        {{--});--}}
    {{--</script>--}}
{{--@endif--}}



{{--失败提示--}}
{{--@if (session()->has('danger'))--}}
    {{--<script>--}}
        {{--swal({--}}
            {{--text: "{{session()->get('danger')}}",--}}
            {{--icon: "warning",--}}
            {{--button: false--}}
        {{--});--}}
    {{--</script>--}}
{{--@endif--}}



{{--layer 弹出层--}}
{{--http://layer.layui.com/--}}
{{--成功提示--}}
<script src="{{asset('org/layer/layer.js')}}"></script>
@if (session()->has('success'))
    <script>
        layer.msg("{{session()->get('success')}}", {icon: 6});
    </script>
@endif
{{--错误提示--}}
@if (session()->has('danger'))
    <script>
        layer.msg("{{session()->get('danger')}}", function(){
//关闭后的操作
        });
    </script>
@endif
