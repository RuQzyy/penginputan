<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Kelas;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran';
    protected $fillable = ['nama_mapel', 'id_guru', 'id_kelas'];

    // Jika tabel tidak memiliki timestamps
    public $timestamps = false;

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    // Relasi ke Guru (User dengan Role Guru)
    public function guru()
    {
        return $this->belongsTo(User::class, 'id_guru');
    }
}
