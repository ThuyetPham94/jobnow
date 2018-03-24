<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CompanyProfile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('CompanyID')->unsigned();
            $table->foreign('CompanyID')->references('id')->on('users');
            $table->string('Logo', 255);
            $table->string('Name', 255);
            $table->string('CoverImage', 255);
            $table->text('Overview');
            $table->text('WhyJoinUs');
            $table->bigInteger('CompanySizeID')->unsigned();
            $table->foreign('CompanySizeID')->references('id')->on('CompanySize');
            $table->string('ContactName', 255);
            $table->string('ContactNumber', 50);
            $table->string('Address', 255);
            $table->string('RegistrationNo', 255);
            $table->string('Website', 255);
            $table->string('WorkingHour', 255);
            $table->string('DressCode', 255);
            $table->string('Benefit', 255);
            $table->string('Spoken', 255);
            $table->string('Latitude',20)->default(0);
            $table->string('Longitude',20)->default(0);
            $table->tinyInteger('IsActive')->default(0);
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
        Schema::drop('CompanyProfile');
    }
}
