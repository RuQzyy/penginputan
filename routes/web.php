<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserImportController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('auth.login'); // Tambahkan route untuk halaman utama
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Routes untuk Siswa
    Route::middleware('siswa')->group(function () {
        Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
        Route::get('/siswa/nilai', [SiswaController::class, 'nilai'])->name('siswa.nilai');
    });

    // Routes untuk Guru
    Route::middleware('guru')->group(function () {
        Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
        Route::get('/guru/input', [GuruController::class, 'input'])->name('guru.input');
        Route::get('/guru/nilai', [GuruController::class, 'nilai'])->name('guru.nilai');
    });
     // Routes untuk admin
    Route::middleware('admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/kelas', [AdminController::class, 'kelas'])->name('admin.kelas');
        Route::get('/admin/nilai', [AdminController::class, 'nilai'])->name('admin.nilai');

         // pengumuman
        Route::get('/admin/pengumuman', [AdminController::class, 'pengumuman'])->name('admin.pengumuman');
        Route::post('/admin/pengumuman', [AdminController::class, 'store'])->name('admin.pengumuman.store');
        Route::delete('/admin/pengumuman/{id}', [AdminController::class, 'destroy'])->name('admin.pengumuman.destroy');
        Route::put('/admin/pengumuman/{id}', [AdminController::class, 'update'])->name('admin.pengumuman.update');
        Route::get('/admin/pengumuman/{id}', [AdminController::class, 'show'])->name('admin.pengumuman.show');
        
         // pengguna
        // Route::get('/admin/pengguna', [UserImportController::class, 'show'])->name('admin.pengguna');
        // Route::post('/admin/pengguna', [UserImportController::class, 'import'])->name('admin.pengguna.process'); 
        // Route::post('/admin/pengguna', [UserImportController::class, 'import'])->name('admin.pengguna.import');  
        // Route::get('/admin/pengguna', [UserController::class, 'index'])->name('admin.pengguna'); 
        // Route::post('/admin/pengguna/store', [UserController::class, 'store'])->name('admin.pengguna.store');
        // Route::get('/admin/pengguna/{id}', [UserController::class, 'edit'])->name('admin.pengguna.edit');
        // Route::put('/admin/pengguna/{id}', [UserController::class, 'update'])->name('admin.pengguna.update');
        // Route::delete('/admin/pengguna/{id}', [UserController::class, 'destroy'])->name('admin.pengguna.delete'); 
        // Route::get('/admin/pengguna', [AdminController::class, 'pengguna'])->name('admin.pengguna');
        // Route::get('/admin/pengguna', [UserController::class, 'index'])->name('admin.pengguna');
        // Route::post('/admin/pengguna', [UserController::class, 'updateRole'])->name('admin.pengguna.updateRole');
        // Rute untuk menampilkan daftar pengguna
        Route::get('/admin/pengguna', [UserController::class, 'index'])->name('admin.pengguna');

        // Rute untuk menambah pengguna
        Route::post('/admin/pengguna/store', [UserController::class, 'store'])->name('admin.pengguna.store');

        // Rute untuk mengedit dan mengupdate pengguna
        Route::get('/admin/pengguna/{id}', [UserController::class, 'edit'])->name('admin.pengguna.edit');
        Route::put('/admin/pengguna/{id}', [UserController::class, 'update'])->name('admin.pengguna.update');

        // Rute untuk menghapus pengguna
        Route::delete('/admin/pengguna/{id}', [UserController::class, 'destroy'])->name('admin.pengguna.delete');

        // Rute untuk mengubah peran pengguna
        Route::post('/admin/pengguna/update-role', [UserController::class, 'updateRole'])->name('admin.pengguna.updateRole');

        // Rute untuk impor dan ekspor pengguna
        Route::post('/admin/pengguna/import', [UserImportController::class, 'import'])->name('admin.pengguna.import');
        Route::get('/admin/pengguna/export', [UserImportController::class, 'export'])->name('admin.pengguna.export');
        Route::post('/admin/users', [UserController::class, 'store'])->name('admin.user.store');
    });

    
});

require __DIR__.'/auth.php';
