<?php

namespace App\Http\Controllers\Home;

use App\Models\Category;
use App\Models\Good;
use App\Models\Keyword;
use App\User;
use Houdunwang\Arr\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Lcobucci\JWT\Signer\Key;
use Prophecy\Doubler\ClassPatch\KeywordPatch;

require_once public_path('')."/org/Connect2.1/API/qqConnectAPI.php";
class IndexController extends CommonController
{
    public function index(Category $category){
        $categories = Category::all ()->toArray ();

        $categoryData=(new Arr())->channelLevel($categories,$pid=0,$html='&nbsp;',$fieldPri='id',$fieldPid='pid');
        //轮播图右侧随机两个商品
        $good=Good::inRandomOrder()->limit(2)->get();
        //获取最近发布的五个商品(时间)
        $latestGood=Good::latest()->limit(5)->get();

        ///第一楼层
        //找家用电子所有子集数据
        $sonIds=$category->getSon($categories,1);
        //将子集追加进去
        $sonIds[]=1;
        $oneFloor = [
            'name'=>'家用电器',
            'data'=>Good::whereIn('category_id',$sonIds)->get()
        ];
        return view ( 'home.index.index' ,compact ('oneFloor','categoryData','good','latestGood'));
    }
    public function search(Request $request){
//        dd($request->kwd);
//        获取搜索词
        $kwd=$request->query('kwd');
        if (!$kwd){
            return back()->with('danger','请输入搜索内容');
        }
        //在数据表中查找当前关键词是否存在
        $keyword=Keyword::where('kwd',$kwd)->first();
//        dd($keyword->toArray());
        if ($keyword){
            //如果已经存在,让搜索次数+1   自加一
            $keyword->increment('click');
        }else{
            //如果搜索词不存在,进行添加
            Keyword::create(['kwd'=>$kwd]);
        }
//        search在这是什么意思  1作为关键词，可能会默认选择第一条
        $goods=Good::search($kwd)->paginate(5);
//        dd($goods->toArray());
        return view('home.index.search',compact('goods','kwd'));
    }
//    QQ回调  扫描二维码后触发
    public function qqBack(Request $request){

//        dd($request->toArray());
        if ($request->state && $request->code){
//            原生 sdk
//            $qc =new \QC();
//            $access_token =$qc->qq_callback();
//            dd($access_token);
//            $openid=$qc->get_openid();
//            dd($openid);
//            $qc = new \QC($access_token, $openid);
//            得到用户信息
//            $userInfo=$qc->get_user_info();
//            $user=User::where('open_id',$openid)->first();
//            dd($userInfo);
//            dd($user);
//            if (!$user){
//                $user= new User();
//                $user->open_id = $openid;
//                $user->name = $userInfo['nickname'];
//                $user->icon = $userInfo['figureurl_1'];
//                $user->save();
//            }
//            执行登录
//            auth()->login($user);
//跳转
//            return redirect('/');
//            ----------------------------------------------------------
//            社会化登录
            $userInfo=Socialite::driver('qq')->user();
//            dd($userInfo['figureurl_qq_1']);
//            dd($user);
            $user=User::where('open_id',$userInfo->id)->first();
            if (!$user){
                $user= new User();
                $user->open_id = $userInfo->id;
                $user->name = $userInfo['nickname'];
                $user->icon = $userInfo['figureurl_qq_1'];
                $user->save();
            }
//执行登录
            auth()->login($user);
            //跳转
            return redirect('/');
        }
    }
//    QQ登录  http://shop.abellmz.cn/org/Connect2.1登录这个网址进行配置
    public function qqLogin(){
//        社会化登录
        return Socialite::with('qq')->redirect();
//        原生 sdk
//        $qc=new \QC();
//        $qc->qq_login();
    }
}
