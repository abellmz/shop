<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Good extends Model
{
    use Searchable;
//    可以进入数据表中的字段
    protected $fillable =['title','price','description','total','category_id','list_pic','pics','admin_id','content'];
//  pics(多图上传)若是数组进去转成json格式，取出自动转化为数组  没规定不转化，原样进入数据表  数据表只限制数组的进入
    protected $casts = [
        'pics'=>'array'
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function spec(){
        return $this->hasMany(Spec::class);
    }
}
