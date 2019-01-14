<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.（处理传入的请求）
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dd($request->toArray());登录跳转路由请求为空（LoginController的login跳转路由）
//        dd(auth('admin')->check());//底层：先判断是否有守卫，。。。。有则从admin表中判断是佛管理员
                                                        //（中间还有很多步骤不在细数）
        if(!auth('admin')->check()){
            return redirect()->route('admin.login');
        }
//        dd($next($request));//打印出来是一个页面（即通过了路由，进行输出的最终结果--跳转页面）
        return $next($request);
    }
}
