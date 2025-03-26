<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $fillable = ['nama_kelas'];

    // Relasi ke model MataPelajaran
    public function mataPelajaran()
    {
        return $this->hasMany(MataPelajaran::class, 'id_kelas');
    }
    // Relasi ke Guru melalui MataPelajaran
    public function guru()
    {
        return $this->hasManyThrough(User::class, MataPelajaran::class, 'id_kelas', 'id', 'id', 'id_guru');
    }
}
