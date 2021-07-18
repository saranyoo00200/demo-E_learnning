<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosttestExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posttest_exams', function (Blueprint $table) {
            $table->id();
            $table->string('question')->nullable()->comment('คำถาม');
            $table->string('aq1')->nullable()->comment('ตอบข้อที่ 1');
            $table->string('aq2')->nullable()->comment('ตอบข้อที่ 2');
            $table->string('aq3')->nullable()->comment('ตอบข้อที่ 3');
            $table->string('aq4')->nullable()->comment('ตอบข้อที่ 4');
            $table->string('answer')->nullable()->comment('เฉลยคำตอบ');
            $table->char('subject_id')->nullable()->comment('ตัวเซื่อมคีย์');
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
        Schema::dropIfExists('posttest_exams');
    }
}
