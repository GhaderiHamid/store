<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_orders', function (Blueprint $table) {
            $table->id(); // ایجاد کلید اصلی با AUTO_INCREMENT
            $table->enum('status_name', ['در حال پردازش', 'تحویل داده شده','لغو شده','در انتظار پرداخت','مرجوع شده']); // ایجاد فیلد status_name با نوع enum
            // $table->string('status_name', 50)->collate('utf8mb4_persian_ci'); // ایجاد فیلد status_name
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
        Schema::dropIfExists('status_orders'); // حذف جدول در صورت نیاز

    }
}
