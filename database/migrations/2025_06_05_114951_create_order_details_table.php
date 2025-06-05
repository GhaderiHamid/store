<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id(); // ایجاد ستون id با AUTO_INCREMENT
            $table->unsignedInteger('quantity')->default(1); // مقدار پیش فرض 1 برای quantity
            $table->unsignedInteger('price'); // ستون price
            $table->unsignedInteger('discount'); // ستون discount
            $table->enum('status', ['processing', 'shipped', 'delivered', 'returned']);
            $table->unsignedBigInteger('order_id'); // ستون order_id
            $table->unsignedBigInteger('product_id'); // ستون product_id
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            // $table->index(['status_id','order_id','product_id']);
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
        Schema::dropIfExists('order_details'); // حذف جدول در صورت نیاز

    }
}
