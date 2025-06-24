<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            // کلید خارجی به جدول users - nullable برای مهمان‌ها
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');

            // کلید خارجی به محصولات
            $table->foreignId('product_id')
                ->constrained('products')
                ->onDelete('cascade');

            // تعداد رزروشده و زمان رزرو
            $table->integer('quantity');
            $table->timestamp('reserved_at');



            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
