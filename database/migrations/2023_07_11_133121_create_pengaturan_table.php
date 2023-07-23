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
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id('id_pengaturan');
            $table->string('id_kepala_bagian')->nullable();
            // $table->string('id_wadir1')->nullable();
            $table->string('id_wadir2')->nullable();
            $table->string('id_bagian_umum')->nullable();
            $table->string('id_pengelola_supir')->nullable();
            $table->string('ttd_kabag')->nullable();
            $table->string('ttd_bagian_umum')->nullable();
            $table->string('ttd_pengelola_supir')->nullable();
            $table->string('update_tanggal')->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaturan');
    }
};
