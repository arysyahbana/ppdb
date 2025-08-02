<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $fillable = [
        'jurusan',
        'deskripsi',
    ];

    public function rPendaftar()
    {
        return $this->hasMany(Pendaftaran::class, 'jurusan_diterima');
    }
}
