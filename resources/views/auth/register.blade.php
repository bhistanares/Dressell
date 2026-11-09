<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title>Daftar Akun — Dressell</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-dressell.png') }}">

    {{-- Tipografi Editorial: Cormorant Garamond (serif) + Instrument Sans (sans) --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,500i,600,600i|instrument-sans:400,500,600&display=swap">

    {{-- Stylesheet Khusus Autentikasi Customer --}}
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
</head>
<body class="auth-body">
    <div class="auth-page">
        <main class="auth-card auth-card--register" role="main">
            <!-- Header Brand: Logo Menonjol & Editorial Fashion Studio -->
            <header class="auth-brand">
                <a href="/" class="auth-logo-link" aria-label="Dressell Beranda">
                    <div class="auth-logo-badge">
                        <img
                            src="{{ asset('assets/img/logo-dressell.png') }}"
                            alt="Logo Dressell"
                            class="auth-logo-img"
                        >
                    </div>
                    <span class="auth-logo-text">Dressell</span>
                </a>
                <h1 class="auth-title">Daftar <em>Akun Baru</em></h1>
                <p class="auth-subtitle">
                    Bergabung bersama Dressell untuk menikmati koleksi busana eksklusif dan layanan fitting terbaik.
                </p>
            </header>

            <!-- Alert Kesalahan Validasi Umum jika ada -->
            @if ($errors->any())
                <div class="auth-alert-error" role="alert">
                    <strong>Mohon periksa kembali formulir pendaftaran:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Registrasi Customer -->
            <form
                method="POST"
                action="{{ route('register.process') }}"
                class="auth-form"
                id="register-form"
                novalidate
            >
                @csrf

                <!-- 1. Nama Lengkap -->
                <div class="auth-field {{ $errors->has('name') ? 'is-invalid' : '' }}">
                    <label for="name" class="auth-label">Nama Lengkap</label>
                    <div class="auth-input-wrapper">
                        <input
                            id="name"
                            name="name"
                            type="text"
                            class="auth-input"
                            value="{{ old('name') }}"
                            placeholder="Contoh: Clarissa Anastasia"
                            autocomplete="name"
                            required
                            @if (! $errors->any() || $errors->has('name')) autofocus @endif
                            @if ($errors->has('name')) aria-invalid="true" aria-describedby="name-error" @endif
                        >
                    </div>
                    @error('name')
                        <p class="auth-field-error" id="name-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 2. Email -->
                <div class="auth-field {{ $errors->has('email') ? 'is-invalid' : '' }}">
                    <label for="email" class="auth-label">Alamat Email</label>
                    <div class="auth-input-wrapper">
                        <input
                            id="email"
                            name="email"
                            type="email"
                            class="auth-input"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            autocomplete="email"
                            inputmode="email"
                            required
                            @if ($errors->has('email') && ! $errors->has('name')) autofocus @endif
                            @if ($errors->has('email')) aria-invalid="true" aria-describedby="email-error" @endif
                        >
                    </div>
                    @error('email')
                        <p class="auth-field-error" id="email-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 3. Password -->
                <div class="auth-field {{ $errors->has('password') ? 'is-invalid' : '' }}">
                    <label for="password" class="auth-label">Password</label>
                    <div class="auth-input-wrapper">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="auth-input auth-input--with-toggle"
                            placeholder="Minimal 8 karakter"
                            autocomplete="new-password"
                            required
                            @if ($errors->has('password') && ! $errors->has('name') && ! $errors->has('email')) autofocus @endif
                            @if ($errors->has('password')) aria-invalid="true" aria-describedby="password-error" @endif
                        >
                        <button
                            type="button"
                            class="auth-toggle-btn"
                            id="password-toggle"
                            aria-controls="password"
                            aria-pressed="false"
                            title="Lihat password"
                        >
                            <svg class="auth-eye-icon auth-eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <svg class="auth-eye-icon auth-eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                                <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
                                <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                                <line x1="2" y1="2" x2="22" y2="22" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="auth-field-error" id="password-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 4. Konfirmasi Password -->
                <div class="auth-field {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}">
                    <label for="password_confirmation" class="auth-label">Konfirmasi Password</label>
                    <div class="auth-input-wrapper">
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            class="auth-input auth-input--with-toggle"
                            placeholder="Ulangi password di atas"
                            autocomplete="new-password"
                            required
                            @if ($errors->has('password_confirmation')) aria-invalid="true" aria-describedby="password_confirmation-error" @endif
                        >
                        <button
                            type="button"
                            class="auth-toggle-btn"
                            id="password_confirmation-toggle"
                            aria-controls="password_confirmation"
                            aria-pressed="false"
                            title="Lihat konfirmasi password"
                        >
                            <svg class="auth-eye-icon auth-eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <svg class="auth-eye-icon auth-eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                                <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
                                <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                                <line x1="2" y1="2" x2="22" y2="22" />
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <p class="auth-field-error" id="password_confirmation-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Submit Pendaftaran -->
                <button type="submit" class="auth-submit-btn" id="register-submit">
                    <span data-label>Daftar Akun</span>
                    <svg class="auth-submit-arrow" viewBox="0 0 26 10" fill="none" aria-hidden="true">
                        <path d="M0 5h24M20 1l4 4-4 4" stroke="currentColor" stroke-width="1.3"/>
                    </svg>
                </button>
            </form>

            <!-- Tautan Beralih ke Halaman Masuk -->
            <div class="auth-switch">
                Sudah memiliki akun Dressell?
                <a href="{{ route('login') }}" class="auth-switch-link">Masuk di sini</a>
            </div>
        </main>
    </div>

    <!-- Footer Copyright -->
    <footer class="auth-page-footer">
        <p>&copy; {{ date('Y') }} Dressell — Sewa Dress &amp; Fitting Appointment</p>
        <p>Koleksi Gaun Eksklusif &amp; Layanan Fitting Terpercaya</p>
    </footer>

    <!-- Script Interaksi UI Autentikasi -->
    <script src="{{ asset('assets/js/auth.js') }}"></script>
</body>
</html>
