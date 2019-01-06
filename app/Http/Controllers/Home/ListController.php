<?php

namespace App\Http\Controllers\Home;

use App\Models\Category;
use App\Models\Good;
use Houdunwang\Arr\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListController extends CommonController
{

    public function index($list,Category $category){
//获取所有栏目数据
        $categories=Category::all()->toArray();
//获取当前栏目下所有子栏目商品
        $sonIds=$category->getSon($categories,$list);
//        追加子集
        $sonIds[] = $list;

//获取在 sonIds 里面所有商品
        $goods=Good::whereIn('category_id',$sonIds);
        if (\request()->query('price')=='asc'){
            $goods=$goods->orderBy('price','asc');
        }
        if (\request()->query('price')=='desc'){
            $goods=$goods->orderBy('price','desc');
        }
        $goods=$goods->orderBy('created_at','desc')->paginate(10);
        return view('home.list.index',compact('goods','list'));
    }
}
