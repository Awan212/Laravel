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
            $table->string('student_roll_no')->unique();
            $table->string('student_name');
            $table->string('student_father_name');
            $table->foreignId('class_sections_id')->constrained('class_sections')->onDelete('Cascade');
            $table->string('student_cnic')->unique();
            $table->string('student_email');
            $table->date('dob');
            $table->string('student_gender');
            $table->string('student_address');
            $table->string('student_religion');
            $table->string('student_guardian_name');
            $table->string('student_guardian_cnic');
            $table->string('student_guardian_phone_no');
            $table->string('student_guardian_occopation');
            $table->string('student_profile_pic');
            $table->string('struck_off')->default('0');
            $table->string('is_active')->default('1');
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
