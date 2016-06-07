<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyReturnVistors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('return_visitor', function (Blueprint $table) {
            $table->dropColumn('original');
        });
        Schema::table('return_visitor', function (Blueprint $table) {
            $table->string('original');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact', function (Blueprint $table) {
            $table->dropColumn('original');
            $table->integer('original')->unsigned();
        });
    }
}
