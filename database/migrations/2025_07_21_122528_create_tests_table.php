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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama tes, misal: "Tes Divisi Kosmetik"
            $table->text('description')->nullable(); // Deskripsi singkat tes
            $table->foreignId('devisi_id')->nullable()->constrained('devisi')->onDelete('set null'); // 💡 Relasi ke tabel 'devisi' kamu
            $table->integer('duration_minutes')->default(30); // Durasi tes dalam menit
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};