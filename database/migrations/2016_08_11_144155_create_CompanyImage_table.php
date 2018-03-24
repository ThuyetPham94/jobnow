<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CompanyImage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('CompanyID')->unsigned();
            $table->foreign('CompanyID')->references('id')->on('users');
            $table->string('ImageUrl', 255);
            $table->string('ImageTitle', 255);
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
        Schema::drop('CompanyImage');
    }
}
