<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRenameToAccessSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('access_subjects', function (Blueprint $table) {
            //
        });
        Schema::rename('access_subjects', 'access_subjects');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('access_subjects', function (Blueprint $table) {
            Schema::dropIfExists('access_subjects');
        });
    }
}
