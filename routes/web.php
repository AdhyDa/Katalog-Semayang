<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::get('/katalog/{kategori}', [KatalogController::class, 'kategori'])->name('katalog.kategori');
Route::get('/katalog-pria', [KatalogController::class, 'pria'])->name('katalog.pria');
Route::get('/katalog-wanita', [KatalogController::class, 'wanita'])->name('katalog.wanita');
Route::get('/katalog-aksesoris', [KatalogController::class, 'aksesoris'])->name('katalog.aksesoris');
Route::get('/cara-sewa', [HomeController::class, 'caraSewa'])->name('cara-sewa');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/daftar', [AuthController::class, 'showRegister'])->name('daftar');
Route::post('/daftar', [AuthController::class, 'register'])->name('daftar');
