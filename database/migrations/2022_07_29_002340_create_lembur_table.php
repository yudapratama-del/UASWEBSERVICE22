<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLemburTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lembur', function (Blueprint $table) {
            $table->increments('id_lembur');
            $table->integer('nip');
            $table->date('tanggal');
            $table->string('status_lembur', 20);
            $table->string('cetak', 20);
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
        Schema::dropIfExists('lembur');
    }
}
