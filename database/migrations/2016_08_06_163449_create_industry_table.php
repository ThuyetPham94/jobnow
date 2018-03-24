<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndustryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Industry', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name', 255);
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
        Schema::drop('Industry');
    }
}
