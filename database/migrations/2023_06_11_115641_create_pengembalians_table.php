<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id('id_pengembalian');
            $table->string('id_peminjaman')->nullable();
            $table->string('bukti_pengembalian')->nullable();
            $table->string('waktu_pengembalian')->nullable();
            $table->string('status_pengembalian')->nullable();
            $table->string('deskripsi_pengembalian')->nullable();
            $table->text('alasan')->nullable();
            $table->string('bukti_video')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengembalian');
    }
};
