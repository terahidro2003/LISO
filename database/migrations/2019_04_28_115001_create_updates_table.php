<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('updates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('version'); // For example: v0.1
            $table->string('type'); // improvements, critical, planned
            $table->string('part'); // front-end, back-end, server-managment, security
            $table->string('description')->nullabe(); //addinitional notes
            $table->string('developer'); //people who were responsible for current update
            $table->string('problemsSolved')->nullabe(); //problems which has been solved with current update
            $table->string('improved')->nullabe(); //features added or improved by current update
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
        Schema::dropIfExists('updates');
    }
}
