<?php

namespace App\Models;

use function GuzzleHttp\Promise\all;
use Houdunwang\Arr\Arr;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
//    data类型是数组
    public function getTreeData($data){
//        Arr::get($data,'name','id','pid'); 实际上是一种递归，得到所有数据的级别
        return (new Arr())->tree($data,'name','id','pid');
    }


    public function getEditCategorys($id){
//        dd($id);1
//        static指代调用当前模块
        $categories =static::all();
//        $categories = self::all();
//        $categories = Category::all();
        //获取当前$id
        $ids=$this->getSon($categories,$id);
//        dd($ids);//子集数据（递归 所有子孙后代）
        $ids[]=$id;//将自己加入数组  排除数据中的子孙后代和自己
        $data=$this->whereNotIn('id',$ids)->get();
//        dd($data->toArray());
        return $this->getTreeData($data->toArray());
    }


    public function getSon($data,$id){
//        子集数组（所有子孙后代）
        static $temp=[];
        foreach ($data as $v){
//            若当前id=pid 即确定是子集
            if ($id==$v['pid']){
                $temp[]=$v['id'];
                $this->getSon($data,$v['id']);//递归
            }
        }
        return $temp;
    }
    //关联商品 一对多正向
    public function good(){
        return $this->hasMany(Good::class);
    }
}
