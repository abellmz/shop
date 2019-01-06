<?php

namespace App\Http\Controllers\Home;

use App\Models\Category;
use App\Models\Keyword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function __construct()
    {
        //获取所有顶级栏目数据
        $_categories =Category::where('pid',0)->limit(5)->get();
//        继承这个控制器，就可以在视图模板中不传递参数 $_categories， share('key', 'value')
        \View::share('_categories',$_categories);
//        获取搜索关键词
        $keywords=Keyword::OrderBy('click','desc')->limit(5)->get();
        \View::share('_keywords',$keywords);
    }
}
