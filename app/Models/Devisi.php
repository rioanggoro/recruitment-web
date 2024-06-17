<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devisi extends Model
{
    use HasFactory;

    protected $table = 'devisi';

    protected $fillable = [
        'nama_devisi',
    ];

    // Relationship with loker table
    public function loker()
    {
        return $this->hasMany(Loker::class);
    }
}
