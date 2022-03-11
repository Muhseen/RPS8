<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('ippis_no')->unique();
            $table->text('file_no');
            $table->text('fullname');
            $table->integer('dept_id');
            $table->string('email');
            $table->string('phone_no');
            $table->string('rank');
            $table->string('department');
            $table->string('grade');
            $table->string('step');
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
        Schema::dropIfExists('staff');
    }
}