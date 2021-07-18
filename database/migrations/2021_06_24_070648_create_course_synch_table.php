<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseSynchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_synch', function (Blueprint $table) {
            $table->bigIncrements('synch_id');
            $table->integer('course_id');
            $table->integer('start_date');
            $table->integer('end_date');
            $table->string('synch_time');
            $table->string('synch_amout');
            $table->integer('teacher_id');
            $table->integer('synch_status');
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
        Schema::dropIfExists('course_synch');
    }
}
