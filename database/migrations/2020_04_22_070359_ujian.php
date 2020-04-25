<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class Ujian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ujian', function(Blueprint $tabel){
            $tabel->integerIncrements('id');
            $tabel->string('nama_mk', 50);
            $tabel->string('dosen', 50);
            $tabel->integer('jumlah_soal');
            $tabel->text('keterangan');
            $tabel->date('created_at')->default(date('Y-m-d'));
            $tabel->date('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Delete tabel if exist
        Schema::dropIfExists('ujian');
    }
}
