<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNextCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('next_carts', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('product_id');
            

            // تعریف کلید اصلی ترکیبی
            $table->primary(['user_id', 'product_id']);
            $table->index(['user_id', 'product_id']);
            $table->unsignedInteger('quantity'); 
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
        Schema::dropIfExists('next_carts');

    }
}
