<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GoodRequest;
use App\Models\Category;
use App\Models\Good;
use App\Models\Spec;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Good $good)
    {
//        不能toArray不然页面不好关联
        $goods = Good::all();
//        foreach ($goods as $v){
//            $v
//        }
//        $categoryname=Category::where('id',$good->category_id);
//        dd($goods);
//        $goods[0]['list_pic']=explode(',',$goods[0]['list_pic']);
//        dd(explode(',',$goods[0]['list_pic']));
//        $goods[0]['list_pic'] =json_decode(Good::all()->toArray()[0]['list_pic'],true);
//        dd($goods[0]['list_pic']);
        return view('admin.good.index', compact('goods', 'good'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        //得到所有数据的级别
        $categories = $category->getTreeData(Category::all()->toArray());
//        dd(hd_config('upload.upload_accept_mime'));
        return view('admin.good.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(GoodRequest $request, Good $good)
    {
//        dd($request);
        $data = $request->all();
//        dd($request);
        $data['admin_id'] = auth('admin')->id();
//        dd($data);
//        列表图片处理  存入需要时string 转化为json存入
//        dd($data['list_pic'][0]);
//        $data['list_pic'] =$data['list_pic'][0];
//        dd($data);/数组转化为字符串  explode()转化为数组
//        $data['pics'] = implode(",", $data['pics']);
//        dd($data);//数据库表中只能存入字符串   不能是数组
//        $data['pics'] =json_encode($data['pics'],true);

        //       处理规格数据
        $specs = json_decode($data['specs'], true);
        $total = 0;
        foreach ($specs as $v) {
            $total += $v['total'];
        }
        $data['total'] = $total;
//        dd($data);
        $good = $good->create($data);
//        添加进商品详情
//        dd($good);
        foreach ($specs as $v) {
            $spec = new Spec();
            $spec->spec = $v['spec'];
            $spec->total = $v['total'];
            $spec->good_id = $good->id;
            $spec->save();
        }
        return redirect()->route('admin.good.index')->with('success', '商品添加成功');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Good $good
     * @return \Illuminate\Http\Response
     */
    public function show(Good $good)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Good $good
     * @return \Illuminate\Http\Response
     */
    public function edit(Good $good, Category $category)
    {
//        dd($good['pics']);
        $categories = $category->getTreeData(Category::all()->toArray());
        return view('admin.good.edit', compact('good', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Good $good
     * @return \Illuminate\Http\Response
     */
    public function update(GoodRequest $request, Good $good)
    {
//        dd($request->all());
        $good['admin_id'] = auth('admin')->id();
//specs得total
        $specs = json_decode($request['specs'], true);
        $total = 0;
        foreach ($specs as $v) {
            $total += $v['total'];
        }
        $good['total'] = $total;
//        dd($good);

        $good->title = $request->title;//
        $good->price = $request->price;//
        $good->description = $request->description;//

        $good->category_id = $request->category_id;//
//        $good->list_pic = $request['list_pic'];
//        $good->pics = $request->pics;
        $good->content = $request['content'];//编辑报错只能加上【】

        $good->save();
//        添加进商品详情
//        dd($good);
        foreach ($specs as $v) {
            $spec = new Spec();
            $spec->spec = $v['spec'];
            $spec->total = $v['total'];
            $spec->good_id = $good->id;
            $spec->save();
        }

        return redirect()->route( 'admin.good.index' )->with( 'success' , '商品编辑成功' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Good $good
     * @return \Illuminate\Http\Response
     */
    public function destroy(Good $good)
    {
//        dd('1');
        $good->delete();
        return redirect()->route('admin.good.index')->with('success', '删除成功');
    }
}
