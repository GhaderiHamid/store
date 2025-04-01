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
            $table->id(); // ایجاد فیلد auto-increment
            $table->text('comment_text')->charset('utf8mb4')->collation('utf8mb4_persian_ci'); // فیلد متن نظر
            $table->unsignedBigInteger('user_id'); // فیلد شناسه کاربر
            $table->unsignedBigInteger('product_id'); // فیلد شناسه محصول
            $table->unsignedBigInteger('parent_id')->nullable();// شناسه کامنت والد
            // $table->index(['user_id','product_id','parent_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
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