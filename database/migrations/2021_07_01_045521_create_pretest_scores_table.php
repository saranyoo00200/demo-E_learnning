<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePretestScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pretest_scores', function (Blueprint $table) {
            $table->id();
            $table->string('score')->nullable()->comment('คะแนนสอบก่อนเรียน');
            $table->string('timer')->nullable()->comment('เวลาในการสอบ');
            $table->integer('users_id')->nullable()->comment('ตัวเซื่อมuser');
            $table->integer('subject_id')->nullable()->comment('ตัวเซื่อมวิชา');
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
        Schema::dropIfExists('pretest_scores');
    }
}
