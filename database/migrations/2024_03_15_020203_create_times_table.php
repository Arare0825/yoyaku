<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->string('hid');
            $table->string('frame_name');
            $table->string('frame_activefrom_1');
            $table->string('frame_activeto_1');
            $table->string('frame_activefrom_2');
            $table->string('frame_activeto_2');
            $table->string('frame_activefrom_3');
            $table->string('frame_activeto_3');
            $table->integer('frame_limit');
            $table->integer('frame_max_per_set');
            $table->integer('frame_timeunit');
            $table->integer('frame_deadtime');
            $table->integer('frame_cancellimit');
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
        Schema::dropIfExists('times');
    }
}
