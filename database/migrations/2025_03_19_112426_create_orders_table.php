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
            $table->id();
           
            $table->dateTime('payment_date')->nullable();
            $table->dateTime('shipped_date')->nullable();
            $table->dateTime('receive_date')->nullable();
            $table->unsignedBigInteger('tracking_number')->unique();
            $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('shipper_id');
            // $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('statusorders_id');

            // تنظیم کلیدهای خارجی
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('shipper_id')->references('id')->on('shippers')->onDelete('set null');
            // $table->foreign('payment_id')->references('id')->on('payment_gateways')->onDelete('set null');
            $table->foreign('statusorders_id')->references('id')->on('statusorders')->onDelete('cascade');


            // $table->index(['user_id','shipper_id','payment_id','status_id']);

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