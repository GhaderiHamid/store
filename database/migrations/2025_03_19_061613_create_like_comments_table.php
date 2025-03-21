<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikeCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_comments', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('comment_id');
            $table->primary(['user_id', 'comment_id']);
            $table->index(['user_id', 'comment_id']);

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
        Schema::dropIfExists('like_comments');
    }
}
