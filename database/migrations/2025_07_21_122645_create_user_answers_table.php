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
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_test_id')->constrained('user_tests')->onDelete('cascade'); // Kunci asing ke tabel 'user_tests'
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade'); // Kunci asing ke tabel 'questions'
            $table->foreignId('option_id')->nullable()->constrained('options')->onDelete('set null'); // Untuk jawaban pilihan ganda
            $table->text('answer_text')->nullable(); // Untuk jawaban esai atau teks bebas
            $table->boolean('is_correct')->nullable(); // Menunjukkan apakah jawaban ini benar (jika bisa otomatis dinilai)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
};