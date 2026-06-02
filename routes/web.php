<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guru\DashboardController;
use App\Http\Controllers\Guru\JadwalController;
use App\Http\Controllers\Guru\PreferensiController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Route CRUD Guru
    Route::get('/guru', [App\Http\Controllers\Admin\GuruController::class, 'index'])->name('admin.guru.index');
    Route::get('/guru/create', [App\Http\Controllers\Admin\GuruController::class, 'create'])->name('admin.guru.create');
    Route::post('/guru', [App\Http\Controllers\Admin\GuruController::class, 'store'])->name('admin.guru.store');
    Route::get('/guru/{id}/edit', [App\Http\Controllers\Admin\GuruController::class, 'edit'])->name('admin.guru.edit');
    Route::put('/guru/{id}', [App\Http\Controllers\Admin\GuruController::class, 'update'])->name('admin.guru.update');
    Route::delete('/guru/{id}', [App\Http\Controllers\Admin\GuruController::class, 'destroy'])->name('admin.guru.destroy');

    // Route CRUD Siswa
    Route::get('/siswa', [App\Http\Controllers\Admin\SiswaController::class, 'index'])->name('admin.siswa.index');
    Route::get('/siswa/create', [App\Http\Controllers\Admin\SiswaController::class, 'create'])->name('admin.siswa.create');
    Route::post('/siswa', [App\Http\Controllers\Admin\SiswaController::class, 'store'])->name('admin.siswa.store');
    Route::get('/siswa/{id}/edit', [App\Http\Controllers\Admin\SiswaController::class, 'edit'])->name('admin.siswa.edit');
    Route::put('/siswa/{id}', [App\Http\Controllers\Admin\SiswaController::class, 'update'])->name('admin.siswa.update');
    Route::delete('/siswa/{id}', [App\Http\Controllers\Admin\SiswaController::class, 'destroy'])->name('admin.siswa.destroy');

    // Route CRUD Kelas
    Route::get('/kelas', [App\Http\Controllers\Admin\KelasController::class, 'index'])->name('admin.kelas.index');
    Route::get('/kelas/create', [App\Http\Controllers\Admin\KelasController::class, 'create'])->name('admin.kelas.create');
    Route::post('/kelas', [App\Http\Controllers\Admin\KelasController::class, 'store'])->name('admin.kelas.store');
    Route::get('/kelas/{id}/edit', [App\Http\Controllers\Admin\KelasController::class, 'edit'])->name('admin.kelas.edit');
    Route::put('/kelas/{id}', [App\Http\Controllers\Admin\KelasController::class, 'update'])->name('admin.kelas.update');
    Route::delete('/kelas/{id}', [App\Http\Controllers\Admin\KelasController::class, 'destroy'])->name('admin.kelas.destroy');
    
    // Route CRUD Mata Pelajaran
    Route::get('/mapel', [App\Http\Controllers\Admin\MapelController::class, 'index'])->name('admin.mapel.index');
    Route::get('/mapel/create', [App\Http\Controllers\Admin\MapelController::class, 'create'])->name('admin.mapel.create');
    Route::post('/mapel', [App\Http\Controllers\Admin\MapelController::class, 'store'])->name('admin.mapel.store');
    Route::get('/mapel/{id}/edit', [App\Http\Controllers\Admin\MapelController::class, 'edit'])->name('admin.mapel.edit');
    Route::put('/mapel/{id}', [App\Http\Controllers\Admin\MapelController::class, 'update'])->name('admin.mapel.update');
    Route::delete('/mapel/{id}', [App\Http\Controllers\Admin\MapelController::class, 'destroy'])->name('admin.mapel.destroy');

    // Route CRUD Jam Pelajaran
    Route::get('/jam', [App\Http\Controllers\Admin\JamController::class, 'index'])->name('admin.jam.index');
    Route::get('/jam/create', [App\Http\Controllers\Admin\JamController::class, 'create'])->name('admin.jam.create');
    Route::post('/jam', [App\Http\Controllers\Admin\JamController::class, 'store'])->name('admin.jam.store');
    Route::get('/jam/{id}/edit', [App\Http\Controllers\Admin\JamController::class, 'edit'])->name('admin.jam.edit');
    Route::put('/jam/{id}', [App\Http\Controllers\Admin\JamController::class, 'update'])->name('admin.jam.update');
    Route::delete('/jam/{id}', [App\Http\Controllers\Admin\JamController::class, 'destroy'])->name('admin.jam.destroy');

    Route::get('/jadwal', [App\Http\Controllers\Admin\JadwalController::class, 'index'])->name('admin.jadwal.index');


    Route::get('/jadwal', [App\Http\Controllers\Admin\JadwalController::class, 'index'])->name('admin.jadwal.index');
    Route::get('/jadwal/create', [App\Http\Controllers\Admin\JadwalController::class, 'create'])->name('admin.jadwal.create');
    Route::post('/jadwal', [App\Http\Controllers\Admin\JadwalController::class, 'store'])->name('admin.jadwal.store');

    Route::get('/jadwal/{id}/edit', [App\Http\Controllers\Admin\JadwalController::class, 'edit'])->name('admin.jadwal.edit');
    Route::put('/jadwal/{id}', [App\Http\Controllers\Admin\JadwalController::class, 'update'])->name('admin.jadwal.update');
    Route::delete('/jadwal/hapus-group/{kelas_id}/{mapel_id}', [App\Http\Controllers\Admin\JadwalController::class, 'destroyGroup'])->name('admin.jadwal.destroyGroup');
    Route::get('/jadwal/edit-group/{kelas_id}/{mapel_id}', [App\Http\Controllers\Admin\JadwalController::class, 'editGroup'])->name('admin.jadwal.editGroup');
    Route::put('/jadwal/update-group/{kelas_id}/{mapel_id}', [App\Http\Controllers\Admin\JadwalController::class, 'updateGroup'])->name('admin.jadwal.updateGroup');

    // Route CRUD Siswa
    Route::get('/siswa', [App\Http\Controllers\Admin\SiswaController::class, 'index'])->name('admin.siswa.index');
    Route::get('/siswa/create', [App\Http\Controllers\Admin\SiswaController::class, 'create'])->name('admin.siswa.create');
    Route::post('/siswa', [App\Http\Controllers\Admin\SiswaController::class, 'store'])->name('admin.siswa.store');
    Route::get('/siswa/{id}/edit', [App\Http\Controllers\Admin\SiswaController::class, 'edit'])->name('admin.siswa.edit');
    Route::put('/siswa/{id}', [App\Http\Controllers\Admin\SiswaController::class, 'update'])->name('admin.siswa.update');
    Route::delete('/siswa/{id}', [App\Http\Controllers\Admin\SiswaController::class, 'destroy'])->name('admin.siswa.destroy');

    
});

    // ========== GURU ROUTES ==========
    Route::middleware(['auth', 'role:guru'])->prefix('guru')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('guru.dashboard');
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('guru.jadwal');
    Route::get('/preferensi', [PreferensiController::class, 'index'])->name('guru.preferensi');
    Route::post('/preferensi', [PreferensiController::class, 'update'])->name('guru.preferensi.update');
    Route::get('/jadwal/export', [App\Http\Controllers\Guru\ExportController::class, 'exportJadwal'])->name('guru.jadwal.export');
});

    Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Siswa\DashboardController::class, 'index'])->name('siswa.dashboard');
    Route::get('/jadwal', [App\Http\Controllers\Siswa\JadwalController::class, 'index'])->name('siswa.jadwal');
Route::get('/cetak-jadwal', [App\Http\Controllers\Siswa\ExportController::class, 'cetakJadwal'])->name('siswa.cetak.jadwal');});

require __DIR__.'/auth.php';
