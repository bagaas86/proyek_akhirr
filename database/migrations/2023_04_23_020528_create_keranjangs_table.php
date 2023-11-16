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
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id('id_keranjang');
            $table->integer('id_user')->nullable();
            $table->integer('id_item')->nullable();
            $table->integer('id_supir')->nullable();
            $table->string('id_peminjaman')->nullable();
            $table->integer('jumlah');
            $table->string('jumlah_rusak')->nullable();
            $table->string('selesai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keranjangs');
    }
};
