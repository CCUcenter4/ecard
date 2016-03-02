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
            $table->enum('webfile_format', ['jpg', 'png']);
            $table->integer('click_times')->default(0);
            $table->integer('share_times')->default(0);
            $table->integer('mail_times')->default(0);
            $table->timestamps();

            $table->index(['parent', 'child']);
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
