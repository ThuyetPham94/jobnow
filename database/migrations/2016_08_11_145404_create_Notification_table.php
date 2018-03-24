<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Notification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('MembershipID')->unsigned();
            $table->foreign('MembershipID')->references('id')->on('users');
            $table->string('Title', 500);
            $table->text('Content');
            $table->tinyInteger('Status');
            $table->dateTime('CreateDate');
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
        Schema::drop('Notification');
    }
}
