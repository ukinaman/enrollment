<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->unsignedBigInteger('year_id');
            $table->foreign('year_id')->references('id')->on('years');
            $table->unsignedBigInteger('sem_id');
            $table->foreign('sem_id')->references('id')->on('semesters');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('birthplace');
            $table->integer('age');
            $table->date('birthday');
            $table->string('gender');
            $table->string('address');
            $table->string('citizenship');
            $table->string('marital_status');
            $table->string('email');
            $table->string('contact_no');
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
        Schema::dropIfExists('students');
    }
}
