<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'test_id', 'score', 'passed', 'started_at', 'completed_at'];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    // Relasi ke tabel `users`
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel `tests`
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    // Relasi ke tabel `user_answers`
    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}