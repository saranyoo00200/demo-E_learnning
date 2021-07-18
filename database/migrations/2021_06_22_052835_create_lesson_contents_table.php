<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_contents', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable()->comment('รูปภาพก่อนเนื้อหา');
            $table->string('title')->nullable()->comment('เนื้อหาของภาพ');
            $table->string('lesson')->nullable()->comment('บทเรียนที่...');
            $table->string('lessonName')->nullable()->comment('ชื่อบทเรียน');
            $table->string('show_lesson')->nullable()->comment('แสดงข้อมูล');
            $table->string('vdo')->nullable()->comment('วิดิโอการสอน');
            $table->string('subject_id')->nullable()->comment('ตัวเซื่อมเคย์');
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
        Schema::dropIfExists('lesson_contents');
    }
}
