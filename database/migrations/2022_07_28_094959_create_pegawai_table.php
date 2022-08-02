<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->increments('nip');
            $table->integer('id_jenis');
            $table->string('nama_pegawai', 100);
            $table->string('tempat_lahir', 20);
            $table->date('tanggal_lahir');
            $table->string('agama', 20);
            $table->text('alamat');
            $table->string('no_telp', 15);
            $table->string('foto', 20);
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
        Schema::dropIfExists('pegawai');
    }
}
