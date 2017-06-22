<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyOnArtifactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('artifacts', function (Blueprint $table) {
            $table->foreign('rack_id')->references('id')->on('racks')->onDelete('cascade');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->foreign('register_id')->references('id')->on('registers')->onDelete('cascade');
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
        Schema::table('artifacts', function (Blueprint $table) {
            $table->dropForeign('artifacts_rack_id_foreign');
            $table->dropForeign('artifacts_form_id_foreign');
            $table->dropForeign('artifacts_register_id_foreign');
        });
    }
}
