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
            $table->string('nik')->nullable();
            $table->enum('jenis_kelamin', ['Pria', 'Wanita'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('agama', ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'lainnya'])->nullable();
            $table->text('alamat')->nullable();
            $table->enum('status', ['Menikah', 'Belum Menikah'])->nullable();
            $table->enum('pendidikan_terakhir', ['SD (Sekolah Dasar)', 'SMP (Sekolah Menengah Pertama)', 'SMA (Sekolah Menengah Atas) / SMK (Sekolah Menengah Kejuruan)', 'D1 (Diploma 1)', 'D2 (Diploma 2)', 'D3 (Diploma 3)', 'D4 (Diploma 4)', 'Sarjana (S1)', 'Magister (S2)', 'Doktor (S3)'])->nullable();
            $table->string('email')->nullable();
            $table->string('nomor_hp')->nullable();
            //mulai dari sini adalah field untuk menyimpan nama berkas yang di upload
            $table->text('cv')->nullable();
            $table->text('ijazah')->nullable();
            $table->text('ktp')->nullable();
            $table->text('foto')->nullable();
            $table->text('surat_pengalaman_kerja')->nullable();
            $table->text('surat_keterangan_sehat')->nullable();
            $table->text('skck')->nullable();
            $table->text('transkrip_nilai')->nullable();
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
