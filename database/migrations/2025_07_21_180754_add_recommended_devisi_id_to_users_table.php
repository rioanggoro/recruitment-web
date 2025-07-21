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
        Schema::table('users', function (Blueprint $table) {
            // Relasi ke tabel 'devisi'
            // Defaultnya bisa null, artinya belum ada rekomendasi
            $table->foreignId('recommended_devisi_id')->nullable()->constrained('devisi')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['recommended_devisi_id']);
            $table->dropColumn('recommended_devisi_id');
        });
    }
};