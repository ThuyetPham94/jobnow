<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobactstaticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('JobActstatic', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('JobID')->unsigned();
            $table->foreign('JobID')->references('id')->on('Job');
            $table->bigInteger('Like')->default(0);
            $table->bigInteger('View')->default(0);
            $table->bigInteger('Share')->default(0);
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
        Schema::drop('JobActstatic');
    }
}
