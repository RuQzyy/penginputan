<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\User;

class MataPelajaranController extends Controller
{
    public function index($id)
    {
        // Mengambil data kelas beserta mata pelajaran dan guru terkait menggunakan eager loading
        $kelas = Kelas::with(['mataPelajaran.guru'])->findOrFail($id);
        
        // Mengambil daftar guru yang memiliki peran 'guru'
        $gurus = User::where('role', 'guru')->get();
    
        return view('admin.kelas', compact('kelas', 'gurus'));
    }
    
    public function create($id)
    {
        // Mengambil data kelas berdasarkan ID
        $kelas = Kelas::findOrFail($id);
        
        // Mengambil daftar guru yang memiliki peran 'guru'
        $gurus = User::where('role', 'guru')->get();
    
        return view('admin.kelas', compact('kelas', 'gurus'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'id_guru' => 'required|exists:users,id',
            'id_kelas' => 'required|exists:kelas,id',
        ]);

        // Membuat mata pelajaran baru dengan data yang telah divalidasi
        MataPelajaran::create([
            'nama_mapel' => $request->nama_mapel,
            'id_guru' => $request->id_guru,
            'id_kelas' => $request->id_kelas,
        ]);

        // Redirect kembali ke halaman daftar kelas dengan pesan sukses
        return redirect()->route('admin.kelas')
            ->with('success', 'Mata Pelajaran berhasil ditambahkan.');
    }

    public function destroy($mapelId)
    {
        // Mengambil data mata pelajaran berdasarkan ID
        $mapel = MataPelajaran::findOrFail($mapelId);
        
        // Menghapus mata pelajaran
        $mapel->delete();

        return redirect()->back()->with('success', 'Mata Pelajaran berhasil dihapus.');
    }
}
