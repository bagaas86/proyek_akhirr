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
        Schema::create('beritaacara', function (Blueprint $table) {
            $table->id('id_ba');
            $table->string('id_peminjaman');
            $table->string('ba_barang')->nullable();
            $table->string('ba_ruangan')->nullable();
            $table->string('ba_kendaraan')->nullable();
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
        Schema::dropIfExists('approvals');
    }
};
