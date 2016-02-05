<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent');
            $table->integer('child');
            $table->string('name', 128);
            $table->enum('type', ['all', 'web']);
            $table->integer('click_times');
            $table->integer('share_times');
            $table->integer('mail_times');
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
        Schema::drop('card');
    }
}
