<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('JobSkill', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('JobID')->unsigned();
            $table->foreign('JobID')->references('id')->on('Job');
            $table->bigInteger('SkillID')->unsigned();
            $table->foreign('SkillID')->references('id')->on('Skill');
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
        Schema::drop('JobSkill');
    }
}
