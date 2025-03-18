<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function kelas(){
        return view('admin.kelas');
    }
    public function nilai(){
        return view('admin.nilai');
    }
    public function pengumuman(){
        return view('admin.pengumuman');
    }
    public function pengguna(){
        return view('admin.pengguna');
    }
}
