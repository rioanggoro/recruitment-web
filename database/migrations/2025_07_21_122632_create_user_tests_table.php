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
        Schema::create('user_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Kunci asing ke tabel 'users'
            $table->foreignId('test_id')->constrained('tests')->onDelete('cascade'); // Kunci asing ke tabel 'tests'
            $table->integer('score')->nullable(); // Skor yang didapat user
            $table->boolean('passed')->nullable(); // Status kelulusan (true/false/null jika belum dinilai)
            $table->timestamp('started_at')->nullable(); // Waktu mulai tes
            $table->timestamp('completed_at')->nullable(); // Waktu selesai tes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_tests');
    }
};