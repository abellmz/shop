<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
//windows系统，关联错误提醒
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username')->default('')->comment('管理员姓名');
            $table->string('password')->default('')->comment('密码');
            $table->string('remember_token')->default('')->comment('记住我');
            $table->timestamps();
        },'后台管理员表');
    }

    /**
     * Reverse the migrations.
     *
     * @return void   回滚
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
