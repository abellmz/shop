<?php

namespace App;

use App\Models\Address;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
//此处user和app下的user不是同一个类，由于同名所以起个别名用于继承

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','email_verified_at', 'icon','token','mobile',
        'province','city','district','detail','mobile_verified_at','sex','open_id','birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
//    用户和地址关联
    public function address(){
        return $this->hasMany(Address::class);
    }
}

