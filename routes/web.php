<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Autentikasi Terpadu (Admin, Kasir, Customer)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registrasi Customer
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// Kompatibilitas route lama /admin/login
Route::get('/admin/login', function () {
    return redirect()->route('login');
})->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.process');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Dashboard Admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth:admin')->name('admin.dashboard');

// Dashboard Kasir
Route::get('/cashier/dashboard', function () {
    return view('cashier.dashboard');
})->middleware('auth:admin')->name('cashier.dashboard');

// Dashboard Customer
Route::get('/customer/dashboard', function () {
    return view('customer.accounts.dashboard');
})->middleware('auth:web')->name('customer.dashboard');

Route::get('/katalog', function () {
    return view('customer.catalog');
});
