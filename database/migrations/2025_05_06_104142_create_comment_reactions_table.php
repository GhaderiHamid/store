<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_reactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ذخیره شناسه کاربر
            $table->unsignedBigInteger('comment_id'); // ذخیره شناسه کامنت (در صورت نیاز)
            $table->enum('reaction', ['like', 'dislike']); // واکنش کاربر
            $table->timestamps();

            // تعریف کلیدهای خارجی
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_reactions');
    }
}
