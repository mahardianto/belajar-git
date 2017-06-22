<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTglMasukToTahunPerolehanOnTableRegisters extends Migration
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
            $table->renameColumn('tgl_masuk', 'tahun_pembuatan');
        });

        DB::statement('ALTER TABLE `registers` CHANGE `tahun_pembuatan` `tahun_pembuatan` YEAR NOT NULL;');
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
            $table->renameColumn('tahun_pembuatan', 'tgl_masuk');
        });

          DB::statement('ALTER TABLE `registers` CHANGE `tgl_masuk` `tgl_masuk` DATE NOT NULL;');
    }
}
