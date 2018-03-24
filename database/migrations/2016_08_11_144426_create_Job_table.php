<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Job', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('CompanyID')->unsigned();
            $table->foreign('CompanyID')->references('id')->on('users');
            $table->string('Title', 255);
            $table->string('Position', 255);
            $table->tinyInteger('Level');
            $table->string('YearOfExperience', 255);
            $table->bigInteger('LocationID')->unsigned();
            $table->foreign('LocationID')->references('id')->on('Location');
            $table->bigInteger('IndustryID')->unsigned();
            $table->foreign('IndustryID')->references('id')->on('Industry');
            $table->decimal('FromSalary', 30, 2);
            $table->decimal('ToSalary', 30, 2);
            $table->bigInteger('CurrencyID')->unsigned();
            $table->foreign('CurrencyID')->references('id')->on('Currency');
            $table->tinyInteger('IsDisplaySalary')->default(0);
            $table->string('Latitude',20)->default(0);
            $table->string('Longitude',20)->default(0);
            $table->text('Description');
            $table->text('Requirement');
            $table->dateTime('CreateDate');
            $table->tinyInteger('IsActive');
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
        Schema::drop('Job');
    }
}
