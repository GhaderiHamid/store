<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('comment_id'); // ایجاد فیلد auto-increment
            $table->text('comment_text')->charset('utf8mb4')->collation('utf8mb4_persian_ci'); // فیلد متن نظر
            $table->unsignedInteger('user_id'); // فیلد شناسه کاربر
            $table->unsignedInteger('product_id'); // فیلد شناسه محصول
            $table->unsignedInteger('parent_id')->nullable();// شناسه کامنت والد
            $table->index(['user_id','product_id','parent_id']);
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
        Schema::dropIfExists('comments'); // حذف جدول در صورت نیاز
    }
}
?>