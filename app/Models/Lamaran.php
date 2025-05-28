<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;

    protected $table = 'lamaran';

    protected $fillable = [
        'status_lamaran',
        'user_id',
        'loker_id',
        'link_wawancara',
    ];

    // Relationship with user table
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with loker table
    public function loker()
    {
        return $this->belongsTo(Loker::class);
    }
}
