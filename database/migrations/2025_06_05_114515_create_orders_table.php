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



            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shipper_id');
            $table->enum('status', ['processing', 'shipped', 'delivered', 'returned']);

            // تنظیم کلیدهای خارجی
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('shipper_id')->references('id')->on('shippers')->onDelete('cascade');
            $table->timestamps();


            // $table->index(['user_id','shipper_id','payment_id','status_id']);

         



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
