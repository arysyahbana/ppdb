<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'no_daftar',
        'tempat_lahir',
        'tanggal_lahir',
        'nisn',
        'nik',
        'asal_sekolah',
        'ijazah',
        'kk',
        'ktp_ortu',
        'akte',
        'kis',
        'butawarna',
        'foto',
        'pilihan_1',
        'pilihan_2',
        'jurusan_diterima',
        'status_verifikasi',
        'published_at',
    ];

    public function rUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function jurusanPilihan1()
    {
        return $this->belongsTo(Jurusan::class, 'pilihan_1', 'id');
    }

    public function jurusanPilihan2()
    {
        return $this->belongsTo(Jurusan::class, 'pilihan_2', 'id');
    }

    public function jurusanDiterima()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_diterima', 'id');
    }
}
