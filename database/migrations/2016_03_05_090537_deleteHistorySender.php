<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteHistorySender extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mail_history', function (Blueprint $table) {
            //
            $table->dropColumn('sender_name');
            $table->dropColumn('sender_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mail_history', function (Blueprint $table) {
            //
        });
    }
}
