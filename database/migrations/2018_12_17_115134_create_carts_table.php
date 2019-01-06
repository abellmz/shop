<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pic')->default('')->comment('购物车商品图片');
            $table->string('title')->default('')->comment('购物车商品名称');
            $table->string('spec')->default('')->comment('购物车商品规格属性');
            $table->decimal('price',8,2)->default(0)->comment('购物车商品单价');
            $table->unsignedInteger('num')->default(0)->comment('购物车商品数量');
            $table->unsignedInteger('user_id')->index()->default(0)->comment('用户 id');
            $table->unsignedInteger('good_id')->index()->default(0)->comment('商品 id');
            $table->unsignedInteger('spec_id')->index()->default(0)->comment('规格 id');
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
        Schema::dropIfExists('carts');
    }
}
