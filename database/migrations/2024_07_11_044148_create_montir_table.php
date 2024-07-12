<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('montir', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->string('nama');
            $table->char('gender');
            $table->date('tgl_lahir');
            $table->string('tmp_lahir');
            $table->string('keahlian');
            $table->unsignedBigInteger('kategori_montir_id');
            $table->foreign('kategori_montir_id')->references('id')->on('kategori_montir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('montir');
    }
};
