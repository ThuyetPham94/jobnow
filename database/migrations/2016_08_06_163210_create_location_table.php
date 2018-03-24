<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Location', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name', 255);
            $table->string('ZipCode', 50);
            $table->bigInteger('CountryID')->unsigned();
            $table->foreign('CountryID')->references('id')->on('Country');
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
        Schema::drop('Location');
    }
}
