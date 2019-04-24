<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_statistics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('range')->default('ALL');
            $table->bigInteger('balance');
            $table->bigInteger('fees')->nullable();
            $table->bigInteger('payments')->nullable();
            $table->bigInteger('deptors')->nullable();
            $table->integer('month');
            $table->integer('year');
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
        Schema::dropIfExists('payment_statistics');
    }
}
