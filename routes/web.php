<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SeleksiController;
use App\Http\Controllers\ProfileController;

Route::get(
    '/profile',
    [ProfileController::class, 'index']
)->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'nocache'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // DOSEN
    Route::get('/dosen', [DosenController::class, 'index']);
    Route::get('/tambah-dosen', [DosenController::class, 'tambah']);
    Route::post('/simpan-dosen', [DosenController::class, 'store']);
    Route::get('/dosen/edit/{id}', [DosenController::class, 'edit']);
    Route::post('/dosen/update/{id}', [DosenController::class, 'update']);
    Route::get('/dosen/hapus/{id}', [DosenController::class, 'hapus']);

    // MATA KULIAH
    Route::get('/mata-kuliah', [MataKuliahController::class, 'index']);
    Route::get('/mata-kuliah/tambah', [MataKuliahController::class, 'tambah']);
    Route::post('/mata-kuliah/simpan', [MataKuliahController::class, 'simpan']);
    Route::get('/mata-kuliah/edit/{kode}', [MataKuliahController::class, 'edit']);
    Route::post('/mata-kuliah/update/{kode}', [MataKuliahController::class, 'update']);
    Route::post('/mata-kuliah/hapus/{kode}', [MataKuliahController::class, 'hapus']);

    //KRITERIA
    Route::get('/kriteria', [KriteriaController::class, 'index']);
    Route::get('/kriteria/tambah', [KriteriaController::class, 'tambah']);
    Route::post('/kriteria/simpan', [KriteriaController::class, 'simpan']);
    Route::get('/kriteria/edit/{kode}', [KriteriaController::class, 'edit']);
    Route::post('/kriteria/update/{kode}', [KriteriaController::class, 'update']);
    Route::get('/kriteria/hapus/{kode}', [KriteriaController::class, 'hapus']);

    // PENILAIAN DOSEN
    Route::get('/penilaian', [PenilaianController::class, 'index']);
    Route::get('/penilaian/tambah', [PenilaianController::class, 'tambah']);
    Route::post('/penilaian/simpan', [PenilaianController::class, 'simpan']);
    Route::get('/penilaian/hapus/{id}', [PenilaianController::class, 'hapus']);
    Route::get('/penilaian/edit/{id}', [PenilaianController::class, 'edit']);
    Route::post('/penilaian/update/{id}', [PenilaianController::class, 'update']);

    //SELEKSI
    Route::get('/seleksi', [SeleksiController::class, 'index']);
    Route::post('/seleksi/tugaskan', [SeleksiController::class, 'tugaskan']);
    Route::post('/seleksi/batalkan', [SeleksiController::class, 'batalkan']);
    });

    //HASIL SELEKSI
    Route::get('/hasil-seleksi', [SeleksiController::class, 'hasilSeleksi']);
    