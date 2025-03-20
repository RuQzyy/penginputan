<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman; 

class AdminController extends Controller
{   
     // sesi dashboard
    public function index(){
        $pengumuman = Pengumuman::all(); // Ambil semua data pengumuman
    return view('admin.index', compact('pengumuman')); // Ganti 'admin.dashboard' dengan nama view Anda
    }
     // sesi kelas
    public function kelas(){
        return view('admin.kelas');
    }
     // sesi nilai
    public function nilai(){
        return view('admin.nilai');
    }

    // sesi pengguna
    public function pengguna(){
        return view('admin.pengguna');
    }

    // sesi pengumuman
    public function pengumuman(){
        // Ambil semua data pengumuman dari database
        $pengumuman = Pengumuman::all();
        
        // Kirim data ke view
        return view('admin.pengumuman', compact('pengumuman')); // Pastikan view ini ada
    }

        public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Pengumuman::create($request->all());

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->update($request->all());

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function show($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return response()->json($pengumuman);
    }
    
}