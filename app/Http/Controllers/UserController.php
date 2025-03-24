<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash; // Tambahkan ini di bagian atas



class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Ambil semua pengguna dari database
        return view('admin.pengguna', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
        ]);

        dd($validatedData);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Pengumuman::create($request->all());
        return redirect()->route('admin.pengguna')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::find($id);
    
        if (!$user) {
            return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
        }
    
        return response()->json($user);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        Session::flash('success', 'Data pengguna berhasil diperbarui!');
        return redirect()->route('admin.pengguna');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        Session::flash('success', 'Pengguna berhasil dihapus!');
        return redirect()->route('admin.pengguna');
    }


    public function updateRole(Request $request)
{
    $user = User::find($request->user_id);
    if ($user) {
        $user->role = $request->role;
        $user->save();
        return redirect()->back()->with('success', 'Peran pengguna berhasil diperbarui.');
    }
    return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
}


}

