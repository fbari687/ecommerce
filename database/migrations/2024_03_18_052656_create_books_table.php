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
        Schema::create('t_buku', function (Blueprint $table) {
            $table->id('f_id');
            $table->unsignedBigInteger('f_idkategori');
            $table->string('f_judul', 100);
            $table->string('f_pengarang', 100);
            $table->string('f_penerbit', 100);
            $table->string('f_deskripsi', 512);

            $table->foreign('f_idkategori')->references('f_id')->on('t_kategori')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_buku');
    }
};
