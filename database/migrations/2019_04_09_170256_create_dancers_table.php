<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDancersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dancers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('signupID')->nullable();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('primaryPhone');
            $table->string('secondaryPhone')->nullable();
            $table->date('birthDate');
            $table->string('city');
            $table->integer('group');
            $table->integer('fee')->default(35);
            $table->string('VIP')->default('no');
            $table->integer('currentLock')->nullable();
            $table->date('lastVisited')->nullable();
            $table->date('firstVisited')->nullable();
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
        Schema::dropIfExists('dancers');
    }
}
