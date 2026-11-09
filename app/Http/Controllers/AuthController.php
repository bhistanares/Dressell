<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            return redirect()->route('customer.dashboard');
        }

        return view('auth.login');
    }

    /**
     * Menampilkan halaman registrasi akun Customer.
     * Jika pengguna sudah login, arahkan ke halaman yang sesuai.
     */
    public function showRegister(): View|RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            return redirect($admin->role === 'admin' ? '/admin/dashboard' : '/cashier/dashboard');
        }

        if (Auth::guard('web')->check()) {
            return redirect()->route('customer.dashboard');
        }

        return view('auth.register');
    }

    /**
     * Memproses registrasi akun Customer baru.
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok dengan password.',
        ]);

        // Simpan data customer ke tabel users (akun otomatis Customer)
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Bersihkan sesi admin jika sebelumnya ada
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        // Customer langsung login otomatis menggunakan guard web
        Auth::guard('web')->login($user);
        $request->session()->regenerate();

        // Customer langsung diarahkan ke Dashboard Customer
        return redirect()->route('customer.dashboard');
    }

    /**
     * Memproses login terpadu berdasarkan peran yang dipilih (Customer, Admin, atau Kasir).
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'role' => ['required', 'string', 'in:customer,admin,cashier'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'role.required' => 'Silakan pilih peran (Customer, Admin, atau Kasir) terlebih dahulu.',
            'role.in' => 'Pilihan peran tidak valid.',
        ]);

        $role = $credentials['role'];
        $authCredentials = [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ];

        // 1. Autentikasi Khusus Role Customer (Hanya memeriksa tabel users & guard web)
        if ($role === 'customer') {
            if (Auth::guard('web')->attempt($authCredentials)) {
                // Bersihkan guard admin jika sebelumnya ada sesi staf yang aktif
                Auth::guard('admin')->logout();

                $request->session()->regenerate();

                return redirect()->intended('/customer/dashboard');
            }

            return back()
                ->withErrors([
                    'email' => 'Email atau password tidak cocok untuk akun Customer.',
                ])
                ->onlyInput('email', 'role');
        }

        // 2. Autentikasi Khusus Role Admin (Hanya memeriksa tabel admins & role admin)
        if ($role === 'admin') {
            if (Auth::guard('admin')->attempt($authCredentials)) {
                $admin = Auth::guard('admin')->user();

                if ($admin->role !== 'admin') {
                    Auth::guard('admin')->logout();
                    return back()
                        ->withErrors([
                            'email' => 'Akun ini bukan akun Admin (terdaftar sebagai Kasir).',
                        ])
                        ->onlyInput('email', 'role');
                }

                // Bersihkan guard web jika sebelumnya ada sesi customer yang aktif
                Auth::guard('web')->logout();

                $request->session()->regenerate();

                return redirect()->intended('/admin/dashboard');
            }

            return back()
                ->withErrors([
                    'email' => 'Email atau password tidak cocok untuk akun Admin.',
                ])
                ->onlyInput('email', 'role');
        }

        // 3. Autentikasi Khusus Role Kasir (Hanya memeriksa tabel admins & role cashier)
        if ($role === 'cashier') {
            if (Auth::guard('admin')->attempt($authCredentials)) {
                $admin = Auth::guard('admin')->user();

                if ($admin->role !== 'cashier') {
                    Auth::guard('admin')->logout();
                    return back()
                        ->withErrors([
                            'email' => 'Akun ini bukan akun Kasir (terdaftar sebagai Admin).',
                        ])
                        ->onlyInput('email', 'role');
                }

                // Bersihkan guard web jika sebelumnya ada sesi customer yang aktif
                Auth::guard('web')->logout();

                $request->session()->regenerate();

                return redirect()->intended('/cashier/dashboard');
            }

            return back()
                ->withErrors([
                    'email' => 'Email atau password tidak cocok untuk akun Kasir.',
                ])
                ->onlyInput('email', 'role');
        }

        return back()
            ->withErrors([
                'email' => 'Terjadi kesalahan saat memproses autentikasi.',
            ])
            ->onlyInput('email', 'role');
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

        if ($request->filled('redirect_to')) {
            return redirect($request->input('redirect_to'));
        }

        return redirect('/login');
    }
}
