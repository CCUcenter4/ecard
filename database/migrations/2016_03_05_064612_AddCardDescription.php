<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCardDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('card', function (Blueprint $table) {
            //
            $table->string('author', 128);
            $table->longText('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('card', function (Blueprint $table) {
            //
            $table->dropColumn('author');
            $table->dropColumn('description');
        });
    }
}
