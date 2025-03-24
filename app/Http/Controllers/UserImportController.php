<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class UserImportController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth'); // Pastikan hanya user terautentikasi yang bisa akses
    // }

    public function show()
    {
        return view('admin.pengguna'); // Tampilkan halaman import
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        if ($request->hasFile('file')) {
            Excel::import(new UsersImport, $request->file('file'));
            Session::flash('success', 'Data pengguna berhasil diimpor!');
        } else {
            Session::flash('error', 'File tidak ditemukan!');
        }

        return redirect()->back();
    }
}
