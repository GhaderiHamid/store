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
        Schema::create('statusorderdetails', function (Blueprint $table) {
            $table->id(); // ایجاد ستون status_id به عنوان کلید اصلی و خودکار
            $table->string('status_name', 50)->collate('utf8mb4_persian_ci'); // ایجاد ستون status_name با نوع varchar و collation مخصوص
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
