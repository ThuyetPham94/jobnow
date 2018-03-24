<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobSeekerSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('JobSeekerSkill', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('JobSeekerID')->unsigned();
            $table->foreign('JobSeekerID')->references('id')->on('users');
            $table->bigInteger('SkillID')->unsigned();
            $table->foreign('SkillID')->references('id')->on('Skill');
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
        Schema::drop('JobSeekerSkill');
    }
}
