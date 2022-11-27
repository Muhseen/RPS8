<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_allocations', function (Blueprint $table) {
            $table->id();
            $table->string('file_no');
            $table->string('programme_type');
            $table->string('course_code');
            $table->string('session');
            $table->string('semester');
            $table->string('added_by');
            $table->integer('level');
            $table->boolean('isLeadLec');
            $table->integer('prog_id');
            $table->integer('dept_id');
            $table->string('staff_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_allocations');
    }
}