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
            $table->integer('card_id')->reference('id')->on('card');
            $table->integer('user_id')->reference('id')->on('user');
            $table->string('mailer_mail', 128);
            $table->string('target_mail', 128);
            $table->longtext('msg');
            $table->dateTime('mail_time');
            $table->timestamps();
            $table->enum('status', ['finished', 'queue']);
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
