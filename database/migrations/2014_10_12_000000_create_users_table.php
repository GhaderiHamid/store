<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use phpDocumentor\Reflection\Types\Nullable;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // INT NOT NULL AUTO_INCREMENT
            $table->string('first_name', 100)->charset('utf8mb4')->collation('utf8mb4_persian_ci')->notNull(); // نام
            $table->string('last_name', 100)->charset('utf8mb4')->collation('utf8mb4_persian_ci')->notNull(); // نام خانوادگی
            $table->string('password', 100)->charset('utf8mb4')->collation('utf8mb4_persian_ci'); // رمز عبور
            $table->string('email', 100)->charset('utf8mb4')->collation('utf8mb4_persian_ci')->unique(); // ایمیل
            $table->string('city', 100)->charset('utf8mb4')->collation('utf8mb4_persian_ci'); // شهر
            $table->char('phone', 11)->charset('utf8mb4')->collation('utf8mb4_persian_ci')->notNull(); // شماره تلفن
            $table->text('address')->charset('utf8mb4')->collation('utf8mb4_persian_ci'); // آدرس
            $table->enum('role',['admin','user'])->charset('utf8mb4')->collation('utf8mb4_persian_ci');
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
        Schema::dropIfExists('users');
    }
}
