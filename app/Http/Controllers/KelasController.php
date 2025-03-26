<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\User;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('mataPelajaran.guru')->get(); // Ambil kelas dan relasi ke mata pelajaran
        $guru = User::where('role', 'guru')->get(); // Ambil semua user dengan role guru
        return view('admin.kelas', compact('kelas', 'guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas
        ]);

        return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil ditambahkan.');
    }

    // public function addSubject(Request $request, $kelasId)
    // {
    //     $request->validate([
    //         'nama_mapel' => 'required|string|max:255',
    //         'id_guru' => 'required|exists:users,id',
    //     ]);

    //     MataPelajaran::create([
    //         'nama_mapel' => $request->nama_mapel,
    //         'id_guru' => $request->id_guru,
    //         'id_kelas' => $kelasId,
    //     ]);

    //     return redirect()->back()->with('success', 'Mata Pelajaran berhasil ditambahkan.');
    // }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
        ]);
    
        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
        ]);
    
        return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil diperbarui');
    }
    
}
