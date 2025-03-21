<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentGatewaiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gatewaies', function (Blueprint $table) {
            $table->increments('payment_id'); 
            $table->string('name', 50)->collate('utf8mb4_persian_ci'); // نام با کدگذاری مناسب
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
        Schema::dropIfExists('payment_gatewaies');

    }
}
?>