<?php

namespace App\Http\Controllers\Admin;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function show(Config $config)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function edit($name)
    {
//        dd('1');数据库中寻找列/值，若未找到就插入一条数据 列/值
        $config=Config::firstOrnew(
            ['name'=>$name]
        );
        return view('admin.config.edit_' . $name,compact('name','config'));
    }
//    数据的添加和更新
    public function update($name ,Request $request)
    {
//        数据库中寻找列/值，若未找到就插入一条数据 列/值
        $res=Config::updateOrCreate(
            ['name'=>$name],//查询条件
            ['name'=>$name,'value'=>$request->all()]
//            //更新或者添加的数据,持久化模型，因此无需调用：save()
        );
//        dd($request);
//        hd_edit_env() laravel扩展包的函数，本函数用于修改.env配置文件，更新的配置项必须在.env文件中存在，
//          没有则不修改
//        编写触动了观察者的模型事件，存入缓存，用自助函数hd_config()就能读到缓存
        hd_edit_env($request->all());
//        hd_config($request->all());
//        dd($request);
        return back()->with('success','配置项更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function destroy(Config $config)
    {
        //
    }
}
