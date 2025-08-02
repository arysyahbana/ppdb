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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->bigInteger('no_daftar');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->integer('nisn');
            $table->bigInteger6('nik');
            $table->string('asal_sekolah');
            $table->string('ijazah');
            $table->string('kk');
            $table->string('ktp_ortu');
            $table->string('akte');
            $table->string('kis');
            $table->string('butawarna')->nullable();
            $table->string('foto');
            $table->foreignId('pilihan_1')->constrained('jurusans')->onDelete('cascade');
            $table->foreignId('pilihan_2')->constrained('jurusans')->onDelete('cascade');
            $table->foreignId('jurusan_diterima')->nullable()->constrained('jurusans')->onDelete('set null');
            $table->string('status_verifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
