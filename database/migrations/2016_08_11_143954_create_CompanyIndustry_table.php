<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyIndustryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CompanyIndustry', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('CompanyID')->unsigned();
            $table->foreign('CompanyID')->references('id')->on('users');
            $table->bigInteger('IndustryID')->unsigned();
            $table->foreign('IndustryID')->references('id')->on('Industry');
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
        Schema::drop('CompanyIndustry');
    }
}
