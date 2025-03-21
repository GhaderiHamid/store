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
            $table->increments('order_id');
            $table->dateTime('order_date')->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->dateTime('shipped_date')->nullable();
            $table->dateTime('receive_date')->nullable();
            $table->unsignedBigInteger('tracking_number')->unique();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('shipper_id')->nullable();
            $table->unsignedInteger('payment_id');
            $table->unsignedInteger('status_id');

            $table->index(['user_id','shipper_id','payment_id','status_id']);

            $table->timestamps(); // زمان ایجاد و به‌روزرسانی


            
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
