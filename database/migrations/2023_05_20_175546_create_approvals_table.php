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
        Schema::create('approvals', function (Blueprint $table) {
            $table->id('id_approval');
            $table->string('id_peminjaman');
            // $table->string('wakil_direktur_1')->nullable();
            $table->string('wakil_direktur_2')->nullable();
            $table->string('kepala_bagian')->nullable();
            $table->string('staff_umum')->nullable();
            $table->string('pengelola_supir')->nullable();
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
