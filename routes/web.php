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

Route::get('/katalog', function () {
    return view('customer.catalog');
});
