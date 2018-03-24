<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Username', 255);
            $table->string('Email')->unique();
            $table->tinyInteger('IsCompany');
            $table->dateTime('CreateDate');
            $table->tinyInteger('IsEmailConfirmed')->default(0);
            $table->string('Password', 128);
            $table->string('PasswordSalt', 128);
            $table->string('fb_id');
            $table->string('google_id');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
