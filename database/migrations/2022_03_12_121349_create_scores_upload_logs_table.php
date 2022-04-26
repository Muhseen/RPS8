<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresUploadLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores_upload_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->integer('file_no');
            $table->string('score_type');
            $table->integer('dept_id');
            $table->integer('prog_id');
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
        Schema::dropIfExists('scores_upload_logs');
    }
}