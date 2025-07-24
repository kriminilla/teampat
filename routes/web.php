<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return redirect()->route('login.form'); // <- redirect to your login
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