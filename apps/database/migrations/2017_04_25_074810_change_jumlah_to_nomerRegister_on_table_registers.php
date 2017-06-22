<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeJumlahToNomerRegisterOnTableRegisters extends Migration
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
            $table->renameColumn('jumlah', 'register_number');
            //$table->string('register_number', 50)->change();
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
            $table->renameColumn('register_number', 'jumlah');
            //$table->unsignedInteger('jumlah')->change();
        });
    }
}
