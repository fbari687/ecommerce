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
        Schema::create('t_anggota', function (Blueprint $table) {
            $table->id('f_id');
            $table->string('f_nama', 100);
            $table->string('f_username', 25)->unique();
            $table->string('f_password', 100);
            $table->string('f_tempatlahir', 100);
            $table->date('f_tanggallahir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_anggota');
    }
};
