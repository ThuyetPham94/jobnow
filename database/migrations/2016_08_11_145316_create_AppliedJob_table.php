<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppliedJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AppliedJob', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('JobSeekerID')->unsigned();
            $table->foreign('JobSeekerID')->references('id')->on('users');
            $table->bigInteger('JobID')->unsigned();
            $table->foreign('JobID')->references('id')->on('Job');
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
        Schema::drop('AppliedJob');
    }
}
