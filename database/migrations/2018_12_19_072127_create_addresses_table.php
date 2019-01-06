<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->default('')->comment('收货人姓名');
            $table->string('phone')->index()->default('')->comment('收货人联系方式');
            $table->string('province')->default('')->comment('省');
            $table->string('city')->default('')->comment('市');
            $table->string('district')->default('')->comment('县');
            $table->string('detail',500)->default('')->comment('详细地址');
            $table->unsignedInteger('user_id')->index()->default(0)->comment('用户 id');
            $table->unsignedTinyInteger('is_default')->index()->default(0)->comment('是否默认 1 是,0否');
            $table->enum('sex',['男','女'])->default('男')->comment('收货人性别');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
