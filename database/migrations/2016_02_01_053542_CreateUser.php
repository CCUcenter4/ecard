<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account', 128);
            $table->string('password', 128);
            $table->rememberToken();
            $table->enum('type', ['ecard', 'academic', 'academic_gra', 'sso']);
            $table->enum('status', ['available', 'disable']);
            $table->enum('role', ['user', 'manager']);
            $table->timestamps();

            $table->unique(['account', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user');
    }
}
