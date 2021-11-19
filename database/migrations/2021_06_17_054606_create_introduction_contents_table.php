<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntroductionContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('introduction_contents', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('title')->nullable()->comment('บนนำ');
            $table->char('show_intro')->nullable()->comment('แสดงบทนำหรือไม่?');
            $table->string('image')->nullable()->comment('รูปภาพ');
            $table->integer('introduction_id')->nullable()->comment('ตัวเซื่อมคีย์');
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
        Schema::dropIfExists('introduction_contents');
    }
}
