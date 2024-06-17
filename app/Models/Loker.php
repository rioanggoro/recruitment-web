<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;

    protected $table = 'loker';

    protected $fillable = [
        'title',
        'deskripsi',
        'status',
        'devisi_id',
    ];

    // Relationship with devisi table
    public function devisi()
    {
        return $this->belongsTo(Devisi::class);
    }

    // Relationship with lamaran table
    public function lamaran()
    {
        return $this->hasMany(Lamaran::class);
    }
}
