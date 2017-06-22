<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditAsalPerolehanToCityIdOnRegistersTable extends Migration
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
            $table->renameColumn('asal_perolehan', 'city_id');
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
            $table->renameColumn('city_id', 'asal_perolehan');
        });
    }
}
