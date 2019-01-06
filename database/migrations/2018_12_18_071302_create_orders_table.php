<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('number')->default('')->comment('订单编号');
//            小数型       8位中2位是小数
            $table->decimal('total_price',8,2)->default(0)->comment('订单总价钱');
            $table->unsignedInteger('total_num')->default(0)->comment('订单总数');
            $table->unsignedInteger('user_id')->default(0)->comment('用户 id');
            $table->unsignedInteger('address_id')->default(0)->comment('地址 id');
//            枚举  用于单选
            $table->enum('status',[1,2,3,4,5])->default(1)->comment('订单状态1未支付,2已支付,3待发货,4已发货,5交易已完成');
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
        Schema::dropIfExists('orders');
    }
}
