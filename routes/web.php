<?php

use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('products'); // <- redirect to your login
});

// Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/logged_in', [AuthController::class, 'loggedin_user'])->name('loggedin_user');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/registered', [AuthController::class, 'register'])->name('register');

// Dashboards
Route::get('/dashboard-admin', [AuthController::class, 'indexAdmin'])->name('indexAdmin');
Route::get('/dashboard', [AuthController::class, 'indexUser'])->name('indexUser');
Route::get('/products', [UserController::class, 'produkuser'])->name('products');
Route::get('/products/{produk}', [ProdukController::class, 'showProductDetailView'])->name('products.detail');

Route::get('/admin/produk', [AdminController::class, 'index'])->name('produk');
Route::put('/admin/produk/update/{produk}', [AdminController::class, 'update'])->name('updateProduk');
Route::post('/admin/produk/tambahProduk', [AdminController::class, 'store'])->name('storeProduk');
Route::delete('/admin/produk/hapusProduk/{produk}', [AdminController::class, 'destroy'])->name('destroyProduk');

Route::get('/admin/kategori', [AdminController::class, 'indexKategori'])->name('kategori');
Route::put('/admin/kategori/update/{kategori}', [AdminController::class, 'updateKategori'])->name('updateKategori');
Route::post('/admin/kategori/tambahKategori', [AdminController::class, 'storeKategori'])->name('storeKategori');
Route::delete('/admin/kategori/hapusKategori/{kategori}', [AdminController::class, 'destroyKategori'])->name('destroyKategori');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
