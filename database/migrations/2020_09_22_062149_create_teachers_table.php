<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_id')->unique();
            $table->string('teacher_name');
            $table->string('teacher_father_name');
            $table->string('teacher_qualification');
            $table->string('teacher_phone');
            $table->string('is_class_teacher')->default('0');
            $table->string('teacher_nic')->unique();
            $table->string('teacher_email');
            $table->string('teacher_dob');
            $table->string('teacher_address');
            $table->string('teacher_religion');
            $table->string('refrance_name');
            $table->string('refrence_cnic');
            $table->string('refrence_phone_no');
            $table->string('teacher_designation');
            $table->string('teacher_gender');
            $table->string('teacher_profile_pic');
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
        Schema::dropIfExists('teachers');
    }
}
