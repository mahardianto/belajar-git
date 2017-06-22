<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnDatatypeUraianVarcharToTextOnRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('rooms', function (Blueprint $table) {
            //$table->renameColumn('jumlah', 'register_number');
            $table->text('uraian')->nullable()->change();
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
        Schema::table('rooms', function (Blueprint $table) {
            //$table->renameColumn('jumlah', 'register_number');
            $table->string('uraian')->change();
        });
    }
}
