<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login terpadu.
     * Jika pengguna sudah login pada guard admin atau web, arahkan ke halaman yang sesuai.
     */
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            return redirect($admin->role === 'admin' ? '/admin/dashboard' : '/cashier/dashboard');
        }

        if (Auth::guard('web')->check()) {
            return redirect('/');
        }

        return view('auth.login');
    }

    /**
     * Memproses login terpadu untuk Admin, Kasir, dan Customer.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Aturan konsistensi multi-tabel:
        // 1. Periksa akun staf pada tabel admins (Admin & Kasir) terlebih dahulu
        if (Auth::guard('admin')->attempt($credentials)) {
            // Bersihkan guard web jika sebelumnya ada sesi customer yang aktif
            Auth::guard('web')->logout();

            $request->session()->regenerate();

            $admin = Auth::guard('admin')->user();

            if ($admin->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/cashier/dashboard');
        }

        // 2. Jika bukan staf atau password admin tidak cocok, periksa akun customer pada tabel users
        if (Auth::guard('web')->attempt($credentials)) {
            // Bersihkan guard admin jika sebelumnya ada sesi staf yang aktif
            Auth::guard('admin')->logout();

            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        // 3. Jika kredensial tidak cocok di kedua tabel/guard
        return back()
            ->withErrors([
                'email' => 'Email atau password yang kamu masukkan salah.',
            ])
            ->onlyInput('email');
    }

    /**
     * Memproses logout untuk seluruh jenis akun (Admin, Kasir, Customer).
     */
    public function logout(Request $request): RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
