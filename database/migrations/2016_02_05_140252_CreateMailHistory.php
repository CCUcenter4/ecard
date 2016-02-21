<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('card_id');// 不使用外鍵是因為我要看歷史紀錄
            $table->integer('user_id')->unsigned();
            $table->string('sender_email', 128);
            $table->string('sender_name', 128);
            $table->string('reciever_email', 128);
            $table->string('reciever_name', 128);
            $table->longtext('message');
            $table->dateTime('created_at');
            $table->enum('type', ['immediate', 'reservation']);
            $table->enum('status', ['success', 'fail']);
            $table->timestamps();

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
        Schema::drop('mail_history');
    }
}
