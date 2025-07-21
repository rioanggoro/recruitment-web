<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['test_id', 'question_text', 'question_type'];

    // Relasi ke tabel `tests`
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    // Relasi ke tabel `options` (jika multiple choice)
    public function options()
    {
        return $this->hasMany(Option::class);
    }

    // Relasi ke tabel `user_answers`
    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}