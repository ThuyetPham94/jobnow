<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Skill', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name', 255);
            $table->bigInteger('IndustryID')->unsigned();
            $table->foreign('IndustryID')->references('id')->on('Industry');
            $table->tinyInteger('IsActive')->default(0);
            $table->string('Description', '255');
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
        Schema::drop('Skill');
    }
}
