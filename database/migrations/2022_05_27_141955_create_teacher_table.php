<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher', function (Blueprint $table) {
            

            $table->id();
            $table->string('name');
            $table->string('desingnation')->nullable();
            $table->string('qualification')->nullable();
            $table->string('experience')->nullable();
            $table->string('interest_areas')->nullable();
            $table->string('department')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->enum('blood_group',['O+','O-','A+','A-','B+','B-','AB+','AB-'])->nullable();
            $table->enum('gender',['Male','Female','Other'])->nullable();
            $table->string('address')->nullable();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('full_profile_path', 2048)->nullable();
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
        Schema::dropIfExists('teacher');
    }
}
