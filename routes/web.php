<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserImportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MataPelajaranController;


Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : view('auth.login');
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

        // Pengumuman
        Route::prefix('/admin/pengumuman')->group(function () {
            Route::get('/', [AdminController::class, 'pengumuman'])->name('admin.pengumuman');
            Route::post('/', [AdminController::class, 'store'])->name('admin.pengumuman.store');
            Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.pengumuman.destroy');
            Route::put('/{id}', [AdminController::class, 'update'])->name('admin.pengumuman.update');
            Route::get('/{id}', [AdminController::class, 'show'])->name('admin.pengumuman.show');
        });

        // Pengguna
        Route::prefix('/admin/pengguna')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.pengguna');
            Route::post('/', [UserController::class, 'store'])->name('admin.pengguna.store');
            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('admin.pengguna.edit');
            Route::put('/{id}', [UserController::class, 'update'])->name('admin.pengguna.update');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('admin.pengguna.delete');
            Route::post('/update-role', [UserController::class, 'updateRole'])->name('admin.pengguna.updateRole');
            Route::post('/import', [UserImportController::class, 'import'])->name('admin.pengguna.import');
            Route::get('/export', [UserImportController::class, 'export'])->name('admin.pengguna.export');
        });

       // Route untuk kelas
        Route::prefix('/admin/kelas')->group(function () {
            Route::get('/', [KelasController::class, 'index'])->name('admin.kelas');
            Route::post('/store', [KelasController::class, 'store'])->name('admin.kelas.store');
            Route::post('/{kelasId}/addSubject', [KelasController::class, 'addSubject'])->name('admin.kelas.addSubject');
            Route::delete('/{id}', [KelasController::class, 'destroy'])->name('admin.kelas.destroy');
            Route::put('/{id}', [KelasController::class, 'update'])->name('admin.kelas.update');

            Route::prefix('/{id}/mata-pelajaran')->group(function () {
                Route::get('/', [MataPelajaranController::class, 'index'])->name('admin.kelas.mataPelajaran');
                Route::post('/store', [MataPelajaranController::class, 'store'])->name('admin.kelas.mataPelajaran.store');
                Route::delete('/{idMapel}', [MataPelajaranController::class, 'destroy'])->name('admin.kelas.mataPelajaran.destroy');
            });
        });

        //matapelajaran
        
    });
});

require __DIR__.'/auth.php';
