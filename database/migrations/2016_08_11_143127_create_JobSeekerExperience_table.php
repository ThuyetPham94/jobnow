<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobSeekerExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('JobSeekerExperience', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('JobSeekerID')->unsigned();
            $table->foreign('JobSeekerID')->references('id')->on('users');
            $table->string('CompanyName', 255);
            $table->string('PositionName', 255);
            $table->text('Description');
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
        Schema::drop('JobSeekerExperience');
    }
}
