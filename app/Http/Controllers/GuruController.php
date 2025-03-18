<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index(){
        return view('guru.index');
    }
    public function input(){
        return view('guru.input');
    }
    public function nilai(){
        return view('guru.nilai');
    }
}
