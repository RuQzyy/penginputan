<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'pengumuman'; 

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'title',   // Judul pengumuman
        'content', // Konten pengumuman
    ];
}