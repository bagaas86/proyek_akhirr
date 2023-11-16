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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id_peminjaman');
            $table->string('id_user');
            $table->string('jenis_peminjaman')->nullable();  
            $table->string('nama_pj')->nullable();  
            $table->string('no_identitas')->nullable();
            $table->string('dari')->nullable();    
            $table->string('no_hp')->nullable(); 
            $table->string('nama_kegiatan');
            $table->string('surat_pengajuan')->nullable();
            $table->string('waktu_pengajuan')->nullable();
            $table->string('waktu_awal');
            $table->string('waktu_akhir');
            $table->string('status_peminjaman')->nullable();
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
};
