<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIdProfilesOnRegistersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
  Schema::table('registers', function (Blueprint $table) {
        $table->dropColumn('id_profile');
        $table->string('nama_user')->nullable()->after('bast');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('registers', function (Blueprint $table) {
            //
        });

    /**
     * Reverse the migrations.
     *
     * @return void
     */
        //
    }
}
