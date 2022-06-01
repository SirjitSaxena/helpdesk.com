<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('roll_no');
            $table->string('course');
            $table->string('subject');
            $table->string('semester');
            $table->string('admission_year');
            $table->int('no_of_attendance');
            $table->int('no_of_total_attendance');
            $table->string('attendance_date');
            $table->string('taken_by');
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
        Schema::dropIfExists('attendance');
    }
}
