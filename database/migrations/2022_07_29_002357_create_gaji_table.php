<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGajiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaji', function (Blueprint $table) {
            $table->increments('id_gaji');
            $table->integer('nip');
            $table->integer('id_jenis');
            $table->integer('jumlah_absen');
            $table->integer('jumlah_lembur');
            $table->double('tunjangan_anak');
            $table->double('tunjangan_istri');
            $table->double('tunjangan_pokok');
            $table->double('potongan_ansuransi');
            $table->double('total');
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
        Schema::dropIfExists('gaji');
    }
}
