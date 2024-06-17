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
        Schema::create('biodata', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->enum('jenis_kelamin', ['Pria', 'Wanita']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('agama', ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'lainnya']);
            $table->text('alamat');
            $table->enum('status', ['Menikah', 'Belum Menikah']);
            $table->enum('pendidikan_terakhir', ['SD (Sekolah Dasar)', 'SMP (Sekolah Menengah Pertama)', 'SMA (Sekolah Menengah Atas) / SMK (Sekolah Menengah Kejuruan)', 'D1 (Diploma 1)', 'D2 (Diploma 2)', 'D3 (Diploma 3)', 'D4 (Diploma 4)', 'Sarjana (S1)', 'Magister (S2)', 'Doktor (S3)']);
            $table->string('email');
            $table->string('nomor_hp');
            //mulai dari sini adalah field untuk menyimpan nama berkas yang di upload
            $table->text('cv');
            $table->text('ijazah');
            $table->text('ktp');
            $table->text('foto');
            $table->text('surat_pengalaman_kerja');
            $table->text('surat_keterangan_sehat');
            $table->text('skck');
            $table->text('transkrip_nilai');
            //foreign key
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodata');
    }
};
