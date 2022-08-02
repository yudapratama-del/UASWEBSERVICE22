<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_pegawai', function (Blueprint $table) {
            $table->increments('id_jenis');
            $table->double('jumlah_gaji');
            $table->double('jumlah_gaji_lembur');
            $table->string('nama_jenis', 20);
            $table->text('keterangan');
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
        Schema::dropIfExists('jenis_pegawai');
    }
}
