<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectLearningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_learnings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id()->comment('primay kay');
            $table->string('subjectId')->nullable()->comment('รหัสวิชา');
            $table->string('subjectName')->nullable()->comment('ชื่อวิชา');
            $table->string('title')->nullable()->comment('คำแนะนำรายวิชา');
            $table->string('schoolYear')->nullable()->comment('ปีการศึกษา');
            $table->string('image')->nullable()->comment('ไฟล์รูป');
            $table->char('subjectType')->nullable()->comment('หมวดหมูวิชา');
            $table->char('show_subject')->nullable()->comment('แสดงหมวดหมูวิชา');
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
        Schema::dropIfExists('subject_learnings');
    }
}
