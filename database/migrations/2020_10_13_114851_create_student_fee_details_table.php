<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentFeeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_fee_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_fee')->constrained('student_fees')->onDelete('Cascade');
            $table->string('fee_amount');
            $table->string('invoice_number');
            $table->string('fee_of_month');
            $table->string('paid_date')->nullable();
            $table->string('is_paid')->default(0);
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
        Schema::dropIfExists('student_fee_details');
    }
}
