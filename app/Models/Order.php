<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderDetail(){
//        一对多
        return $this->hasMany(OrderDetail::class);
    }
    public function user(){
//        多对一
        return $this->belongsTo(User::class);
    }
}
