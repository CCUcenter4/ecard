<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('card_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('sender', 128);
            $table->string('reciever', 128);
            $table->longtext('msg');
            $table->dateTime('mail_time');
            $table->timestamps();
            $table->enum('status', ['finished', 'queue']);

            $table->foreign('card_id')->references('id')->on('card')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reservation');
    }
}
