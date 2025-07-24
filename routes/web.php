<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;


// Route::get('/', function () {
//     return redirect()->route('login.form'); // <- redirect to your login
//     // return view('welcome');
// });

// Your auth routes
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
// Route::post('/login', [AuthController::class, 'login'])->name('login');

// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
// Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/admin/produk', [AdminController::class, 'index'])->name('produk');
Route::put('/admin/produk/update/{produk}', [AdminController::class, 'update'])->name('updateProduk');
Route::post('/admin/produk/tambahProduk', [AdminController::class, 'store'])->name('storeProduk');
Route::delete('/admin/produk/hapusProduk/{produk}', [AdminController::class, 'destroy'])->name('destroyProduk');

Route::get('/admin/kategori', [AdminController::class, 'indexKategori'])->name('kategori');
Route::put('/admin/kategori/update/{kategori}', [AdminController::class, 'updateKategori'])->name('updateKategori');
Route::post('/admin/kategori/tambahKategori', [AdminController::class, 'storeKategori'])->name('storeKategori');
Route::delete('/admin/kategori/hapusKategori/{kategori}', [AdminController::class, 'destroyKategori'])->name('destroyKategori');
