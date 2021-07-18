<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosttestScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posttest_scores', function (Blueprint $table) {
            $table->id();
            $table->string('score')->nullable()->comment('คะแนนสอบก่อนเรียน');
            $table->string('timer')->nullable()->comment('เวลาในการสอบ');
            $table->string('users_id')->nullable()->comment('ตัวเซื่อมuser');
            $table->string('subject_id')->nullable()->comment('ตัวเซื่อมวิชา');
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
        Schema::dropIfExists('posttest_scores');
    }
}
