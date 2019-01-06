<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCloumToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
//            nullable允许为空
            $table->string('province')->nullable()->comment('省');
            $table->string('city')->nullable()->comment('市');
            $table->string('district')->nullable()->comment('县');
            $table->string('detail',500)->nullable()->comment('详细地址');
            $table->string('mobile')->nullable()->comment('用户手机号');
            $table->enum('sex',['男','女'])->default('男')->comment('用户手机号');
            $table->string('open_id')->default('')->comment('qq 登录 openid');
            $table->date('birthday')->nullable()->comment('生日');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('province')->nullable()->comment('省');
            $table->string('city')->nullable()->comment('市');
            $table->string('district')->nullable()->comment('县');
            $table->string('detail',500)->nullable()->comment('详细地址');
            $table->string('mobile')->nullable()->comment('用户手机号');
            $table->enum('sex',['男','女'])->default('男')->comment('用户手机号');
            $table->string('open_id')->default('')->comment('qq 登录 openid');
            $table->date('birthday')->nullable()->comment('生日');
        });
    }
}
