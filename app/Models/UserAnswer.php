<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['user_test_id', 'question_id', 'option_id', 'answer_text', 'is_correct'];

    // Relasi ke tabel `user_tests`
    public function userTest()
    {
        return $this->belongsTo(UserTest::class);
    }

    // Relasi ke tabel `questions`
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Relasi ke tabel `options` (jika pilihan ganda)
    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}