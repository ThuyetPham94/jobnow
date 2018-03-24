<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Interview', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('JobSeekerID')->unsigned();
            $table->foreign('JobSeekerID')->references('id')->on('users');
            $table->bigInteger('CompanyID')->unsigned();
            $table->foreign('CompanyID')->references('id')->on('users');
            $table->string('Title', 255);
            $table->text('Content');
            $table->dateTime('InterviewDate');
            $table->string('ContactName', 255);
            $table->string('PhoneNumber', 15);
            $table->string('Status');
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
        Schema::drop('Interview');
    }
}
