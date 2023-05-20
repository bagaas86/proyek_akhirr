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
        Schema::create('items', function (Blueprint $table) {
            $table->id('id_item');
            $table->string('nama_item');
            $table->string('kategori_item')->nullable();
            $table->text('deskripsi_item')->nullable();
            $table->string('jumlah_item')->nullable();
            $table->string('foto_item')->nullable();
            $table->string('lokasi_item')->nullable();
            $table->string('kondisi_item')->nullable();
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
        Schema::dropIfExists('items');
    }
};
