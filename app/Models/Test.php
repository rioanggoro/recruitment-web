<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'devisi_id', 'duration_minutes'];

    // Relasi ke tabel `devisi` (sesuai nama tabel kamu)
    public function devisi()
    {
        return $this->belongsTo(Devisi::class, 'devisi_id'); // 💡 Sesuaikan dengan nama model Devismu
    }

    // Relasi ke tabel `questions`
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Relasi ke tabel `user_tests`
    public function userTests()
    {
        return $this->hasMany(UserTest::class);
    }
}