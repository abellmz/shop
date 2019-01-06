<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        //树状结构:https://packagist.org/packages/houdunwang/arr
        //安装方式:composer require houdunwang/arr
        //getTreeData要求的参数必须是数组
        $categories=$category->getTreeData(Category::all()->toArray());
//        dd($categories);//返回的是数组
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
//        dd('2');
        $categories=$category->getTreeData(Category::all()->toArray());
        return view('admin.category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request ,Category $category)
    {
//        dd($request->name);
        $category->name=$request->name;
        $category->pid = $request->pid;
        $category->save();
        return redirect()->route('admin.category.index')->with('success','添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
//        dd($category['id']);
//        dd($category['id']);//1实际上即是模块，也代表传入的参数
            $categories =$category->getEditCategorys($category['id']);
//      dd($categories);//得到排除自己和子孙后代的数组
        return view('admin.category.edit',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
//        dd($request->name);
//   该条数据               提交数据
        $category->name=$request->name;
        $category->pid=$request->pid;
        $category->save();
        return redirect()->route('admin.category.index')->with('success','栏目编辑成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
//        dd(Category::where('pid',$category['id'])->first());
//        判断是否有子级
        if (Category::where('pid',$category['id'])->first()){
            return redirect()->back()->with('danger','请先删除子级数据');
        }

        $category->delete();
        return redirect()->route('admin.category.index')->with('success','操作成功');
    }
}
