<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobseekerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('JobSeeker', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('Avatar', 255);
            $table->string('FullName', 255);
            $table->date('BirthDay');
            $table->tinyInteger("Gender");
            $table->string("PhoneNumber", 255);
            $table->string("PostalCode", 255);
            $table->bigInteger('CountryID')->unsigned()->nullable();
            $table->foreign('CountryID')->references('id')->on('Country');
            $table->string("CurriculumVitae", 255);
            $table->string("Description", 255);
            $table->tinyInteger("IsActive");
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
        Schema::drop('JobSeeker');
    }
}
