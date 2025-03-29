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
            $table->text('description')->charset('utf8mb4')->collate('utf8mb4_persian_ci');
            $table->char('image_path')->nullable();
            $table->unsignedInteger('price')->notNull();
            $table->unsignedInteger('quntity')->nullable();
            $table->unsignedInteger('discount')->nullable();
            $table->unsignedInteger('limited')->default(3)->nullable();
            $table->unsignedInteger('category_id')->notNull();
            $table->index('category_id');
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