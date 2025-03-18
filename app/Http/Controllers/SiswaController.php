<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(){
        return view('siswa.index');
    }

    public function nilai()
    {
        return view('siswa.nilai'); // Halaman daftar nilai
    }
}
