<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	Schema::create('registers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipe');
            $table->string('nama');
            $table->string('uraian');
            $table->string('asal_perolehan');
            $table->string('cara_perolehan');
            $table->date('tgl_masuk');
            $table->date('tgl_perolehan');
            $table->unsignedInteger('harga_satuan');
            $table->unsignedInteger('jumlah');
            $table->text('keterangan');
            $table->string('bast');
            $table->unsignedInteger('id_profile');
            $table->timestamps();
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
	Schema::dropIfExists('registers');	
    }
}
