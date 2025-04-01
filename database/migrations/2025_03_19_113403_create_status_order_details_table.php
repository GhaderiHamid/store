<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_order_details', function (Blueprint $table) {
            $table->id(); // ایجاد ستون status_id به عنوان کلید اصلی و خودکار
            $table->enum('status_name', ['تحویل داده شده', 'لغو شده', 'مرجوع شده'])->charset('utf8mb4')->collation('utf8mb4_persian_ci'); // ایجاد فیلد status_name با نوع enum

            // $table->string('status_name', 50)->collate('utf8mb4_persian_ci'); // ایجاد ستون status_name با نوع varchar و collation مخصوص
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
        Schema::dropIfExists('status_order_details');

    }
}
