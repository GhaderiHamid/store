<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // AUTO_INCREMENT و PRIMARY KEY
            $table->string('name', 100)->charset('utf8mb4')->collate('utf8mb4_persian_ci');
            $table->string('brand',50)->charset('utf8mb4')->collate('utf8mb4_persian_ci');
            $table->text('description')->charset('utf8mb4')->collate('utf8mb4_persian_ci');
            $table->char('image_path');
            $table->unsignedInteger('price');
            $table->unsignedInteger('quntity');
            $table->unsignedInteger('discount');
            $table->unsignedInteger('limited')->default(3);
            $table->unsignedBigInteger('category_id');;
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            
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
        Schema::dropIfExists('products');
    }
}
?>