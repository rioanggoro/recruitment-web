<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodata';

    protected $fillable = [
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'alamat',
        'status',
        'pendidikan_terakhir',
        'email',
        'nomor_hp',
        'cv',
        'ijazah',
        'ktp',
        'foto',
        'surat_pengalaman_kerja',
        'surat_keterangan_sehat',
        'skck',
        'transkrip_nilai',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
