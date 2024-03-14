<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('facility_id');
            $table->string('hid');
            $table->string('group_id');
            $table->string('facility_name_jp');
            $table->string('facility_name_en');
            $table->integer('facility_sort');
            $table->string('facility_visible');
            $table->string('facility_images');
            $table->string('facility_introduction');
            $table->string('facility_busines_hours');
            $table->string('facility_place_jp');
            $table->string('facility_place_en');
            $table->string('frame_id');
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
        Schema::dropIfExists('facilities');
    }
}
