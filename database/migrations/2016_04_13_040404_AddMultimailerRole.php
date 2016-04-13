<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;

class AddMultimailerRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            //
            DB::statement("ALTER TABLE user CHANGE COLUMN role role ENUM('user', 'manager', 'multimailer')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            //
            DB::statement("ALTER TABLE user CHANGE COLUMN role role ENUM('user', 'manager')");
        });
    }
}
