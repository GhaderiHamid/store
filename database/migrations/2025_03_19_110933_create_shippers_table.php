<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippers', function (Blueprint $table) {
            $table->id(); // INT NOT NULL AUTO_INCREMENT
            $table->string('first_name', 100)->charset('utf8mb4')->collation('utf8mb4_persian_ci')->notNull(); // نام
            $table->string('last_name', 100)->charset('utf8mb4')->collation('utf8mb4_persian_ci')->notNull(); // نام خانوادگی
            $table->string('password', 100)->charset('utf8mb4')->collation('utf8mb4_persian_ci'); // رمز عبور
            $table->string('email', 100)->charset('utf8mb4')->collation('utf8mb4_persian_ci')->unique(); // ایمیل
            $table->string('city', 100)->charset('utf8mb4')->collation('utf8mb4_persian_ci'); // شهر
            $table->char('phone', 11)->charset('utf8mb4')->collation('utf8mb4_persian_ci')->notNull(); // شماره تلفن
            $table->integer('active_orders')->default(0);

            $table->timestamps(); // زمان ایجاد و به‌روزرسانی
            // $table->text('address')->charset('utf8mb4')->collation('utf8mb4_persian_ci'); // آدرس

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shippers');
    }
}
