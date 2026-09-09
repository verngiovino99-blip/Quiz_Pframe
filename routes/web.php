<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KategoriController;

Route::get('/', [InformasiController::class, 'halamanUtama'])->name('public.index');
Route::get('/informasi/{id}', [InformasiController::class, 'halamanDetail'])->name('public.show');

// Admin Dashboard
use App\Http\Controllers\DashboardController;
Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/daftar-kategori', [KategoriController::class, 'tampil'])->name('kategori.daftar');
Route::get('/tambah-kategori', [KategoriController::class, 'create']);
Route::post('/simpan-kategori', [KategoriController::class, 'simpan']);
Route::delete('/hapus-kategori/{id}', [KategoriController::class, 'hapus'])->name('kategori.hapus');
Route::get('/ubah-kategori/{id}', [KategoriController::class, 'ubah'])->name('kategori.ubah');
Route::put('/update-kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');

Route::get('/daftar-informasi', [InformasiController::class, 'tampil'])->name('informasi.daftar');
Route::get('/tambah-informasi', [InformasiController::class, 'create']);
Route::post('/simpan-informasi', [InformasiController::class, 'simpan']);
Route::delete('/hapus-informasi/{informasi}', [InformasiController::class, 'hapus'])->name('informasi.hapus');
Route::get('/ubah-informasi/{informasi}', [InformasiController::class, 'ubah'])->name('informasi.ubah');
Route::put('/update-informasi/{id}', [InformasiController::class, 'update'])->name('informasi.update');