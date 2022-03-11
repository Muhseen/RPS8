<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGraduatedStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graduated_students', function (Blueprint $table) {
            $table->id();
            $table->string('REG_NUMBER');
            $table->string('FULLNAME');
            $table->string('CLASS_OF_DEGREE');
            $table->string('TYPE_OF_DEGREE');
            $table->decimal('CGPA', 4, 2);
            $table->date('ACADEMIC_DATE');
            $table->string('COURSE');
            $table->string('DEPARTMENT');

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
        Schema::dropIfExists('graduated_students');
    }
}