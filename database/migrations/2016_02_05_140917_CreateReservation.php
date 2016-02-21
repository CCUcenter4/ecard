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
            $table->string('sender_email', 128);
            $table->string('sender_name', 128);
            $table->string('reciever_email', 128);
            $table->string('reciever_name', 128);
            $table->longtext('message');
            $table->dateTime('mail_time');
            $table->timestamps();

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
