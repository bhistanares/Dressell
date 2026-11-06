<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title>Masuk — Dressell</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-dressell.png') }}">

    {{-- Tipografi editorial: Cormorant Garamond (serif) + Instrument Sans (sans, sama dengan halaman pelanggan) --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,500i,600i|instrument-sans:400,500,600&display=swap">

    <style>
        /* =============================================================
           Dressell — Login Editorial
           Konsep: "Editorial Plate" — foto sebagai plate majalah,
           kata display di belakang, panel login menumpuk asimetris.
           Layout desktop: 100dvh / 100vh one-screen view tanpa scrollbar.
           ============================================================= */

        :root {
            --ivory: #F4EFE6;
            --paper: #FBF8F2;
            --beige: #E4D8C6;
            --sand: #D9CAB4;
            --taupe: #8A7B6C;
            --taupe-ink: #6B5F53;
            --charcoal: #26221F;
            --champagne: #C2A878;
            --error: #963A44;
            --error-bg: #F4E7E3;

            --serif: 'Cormorant Garamond', 'Cormorant', Garamond, 'Times New Roman', serif;
            --sans: 'Instrument Sans', ui-sans-serif, system-ui, -apple-system, 'Segoe UI', sans-serif;

            --display-size: clamp(4.2rem, 9.5vh, 8.5rem);
        }

        *, *::before, *::after { box-sizing: border-box; }

        html, body {
            margin: 0;
            padding: 0;
        }

        body {
            background: var(--ivory);
            color: var(--charcoal);
            font-family: var(--sans);
            -webkit-font-smoothing: antialiased;
        }

        img { display: block; max-width: 100%; }

        /* ---------- Desktop Viewport (100dvh one-screen) ---------- */
        @media (min-width: 1024px) {
            html, body {
                height: 100%;
                height: 100dvh;
                width: 100%;
                width: 100vw;
                overflow: hidden;
            }

            .page {
                height: 100%;
                height: 100dvh;
                max-height: 100dvh;
                width: 100%;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            /* Pergeseran komposisi gambar, teks display & form ke kiri agar sisi kiri tidak terlalu kosong */
            .display {
                left: calc(50% - clamp(30px, 3vw, 60px) - clamp(38px, 4.2vw, 76px));
            }

            .plate,
            .panel {
                transform: translateX(calc(-1 * clamp(38px, 4.2vw, 76px)));
            }
        }

        @media (max-width: 1023px) {
            html, body {
                min-height: 100%;
                overflow-x: hidden;
                overflow-y: auto;
            }

            .page {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }
        }

        /* ---------- Masthead ---------- */
        .masthead {
            position: relative;
            z-index: 5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: clamp(14px, 2.2vh, 26px) clamp(20px, 4vw, 56px) 0;
            flex-shrink: 0;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: inherit;
            text-decoration: none;
        }

        .brand__logo {
            width: clamp(30px, 4vh, 36px);
            height: clamp(30px, 4vh, 36px);
            object-fit: contain;
        }

        .brand__name {
            font-family: var(--serif);
            font-size: clamp(1.4rem, 2.4vh, 1.65rem);
            font-weight: 500;
            letter-spacing: 0.01em;
            line-height: 1;
        }

        .masthead__meta {
            margin: 0;
            font-size: clamp(0.58rem, 0.9vh, 0.66rem);
            line-height: 1.6;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            text-align: right;
            color: var(--taupe-ink);
        }

        .masthead__meta strong {
            display: block;
            font-weight: 600;
            color: var(--charcoal);
        }

        /* ---------- Stage (editorial composition) ---------- */
        .stage {
            position: relative;
            flex: 1;
            min-height: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(8px, 1.2vh, 18px) clamp(20px, 3vw, 48px);
        }

        /* Bidang warna beige di belakang foto — memberi lapisan kedalaman */
        .stage::before {
            content: '';
            position: absolute;
            left: 0;
            top: 15%;
            bottom: 0;
            width: 38vw;
            background: var(--beige);
            z-index: 0;
        }

        /* Kata display besar di belakang panel */
        .display {
            position: absolute;
            left: calc(50% - clamp(30px, 3vw, 60px));
            top: clamp(6%, 8vh, 12%);
            z-index: 1;
            margin: 0;
            padding-left: 0.12em;
            font-family: var(--serif);
            font-style: italic;
            font-weight: 500;
            font-size: var(--display-size);
            line-height: 0.8;
            letter-spacing: -0.02em;
            color: var(--sand);
            white-space: nowrap;
            pointer-events: none;
            user-select: none;
        }

        /* ---------- Plate foto ---------- */
        .plate {
            position: relative;
            z-index: 2;
            height: clamp(400px, 66vh, 630px);
            aspect-ratio: 1920 / 2561;
            margin: 0;
            flex-shrink: 0;
        }

        .plate__frame {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: var(--sand);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Ukuran gambar 100% tertampil utuh di dalam kotak tanpa terpotong */
        .plate__img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            display: block;
        }

        .plate__caption {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            display: flex;
            align-items: baseline;
            gap: 14px;
            margin-top: clamp(8px, 1.2vh, 14px);
            font-size: clamp(0.58rem, 0.9vh, 0.66rem);
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--taupe-ink);
        }

        .plate__caption em {
            font-family: var(--serif);
            font-size: clamp(0.95rem, 1.4vh, 1.15rem);
            font-style: italic;
            letter-spacing: 0;
            text-transform: none;
            color: var(--charcoal);
        }

        .plate__side {
            position: absolute;
            right: calc(100% + clamp(14px, 1.8vw, 24px));
            bottom: 0;
            margin: 0;
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            font-size: clamp(0.54rem, 0.8vh, 0.62rem);
            letter-spacing: 0.32em;
            text-transform: uppercase;
            color: var(--taupe-ink);
            white-space: nowrap;
        }

        /* ---------- Sketsa atelier (img-1) ---------- */
        .sketch {
            position: absolute;
            right: clamp(20px, 4vw, 80px);
            bottom: 0;
            z-index: 1;
            height: min(68vh, 580px);
            width: auto;
            opacity: 0.18;
            mix-blend-mode: multiply;
            pointer-events: none;
        }

        /* ---------- Panel login ---------- */
        .panel {
            position: relative;
            z-index: 3;
            width: clamp(465px, 35.5vw, 565px);
            margin: 0 0 0 clamp(-90px, -6.5vw, -60px);
            flex-shrink: 0;
            background: var(--paper);
            border-top: 2px solid var(--charcoal);
            padding: clamp(28px, 3.6vh, 46px) clamp(32px, 3.2vw, 50px) clamp(24px, 3.2vh, 40px);
            box-shadow:
                0 1px 0 rgba(38, 34, 31, 0.04),
                0 40px 80px -42px rgba(38, 34, 31, 0.38);
        }

        .panel__mark {
            position: relative;
            width: clamp(72px, 9vh, 96px);
            aspect-ratio: 500 / 235;
            overflow: hidden;
            margin: 0 0 clamp(10px, 1.4vh, 20px) -4px;
            mix-blend-mode: multiply;
        }

        /* Area gantungan pada img-2 (736×736): x 118–618, y 180–415 */
        .panel__mark img {
            position: absolute;
            max-width: none;
            width: 147.2%;
            left: -23.6%;
            top: -76.6%;
        }

        .eyebrow {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0 0 clamp(8px, 1.2vh, 16px);
            font-size: clamp(0.62rem, 0.9vh, 0.68rem);
            font-weight: 500;
            letter-spacing: 0.24em;
            text-transform: uppercase;
            color: var(--taupe-ink);
        }

        .eyebrow::before {
            content: '';
            width: 28px;
            height: 1px;
            background: var(--champagne);
        }

        .panel__title {
            margin: 0;
            font-family: var(--serif);
            font-weight: 500;
            font-size: clamp(1.95rem, min(3.3vw, 4vh), 3.1rem);
            line-height: 1.05;
            letter-spacing: -0.01em;
        }

        .panel__title em {
            font-style: italic;
            color: var(--taupe-ink);
        }

        .panel__desc {
            max-width: 38ch;
            margin: clamp(8px, 1.2vh, 14px) 0 0;
            font-size: clamp(0.82rem, 1.2vh, 0.92rem);
            line-height: 1.55;
            color: var(--taupe-ink);
        }

        /* ---------- Alert ---------- */
        .alert {
            margin: clamp(10px, 1.4vh, 20px) 0 0;
            padding: clamp(8px, 1.2vh, 12px) 14px;
            border-left: 2px solid var(--error);
            background: var(--error-bg);
            font-size: clamp(0.74rem, 1.05vh, 0.84rem);
            line-height: 1.45;
            color: var(--error);
        }

        .alert strong {
            display: block;
            margin-bottom: 2px;
            font-size: clamp(0.58rem, 0.85vh, 0.66rem);
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
        }

        .alert--status {
            border-left-color: var(--champagne);
            background: #F3ECDF;
            color: var(--charcoal);
        }

        /* ---------- Form ---------- */
        .form {
            margin-top: clamp(16px, 2.4vh, 32px);
        }

        .field + .field {
            margin-top: clamp(12px, 1.8vh, 24px);
        }

        .field__label {
            display: block;
            margin-bottom: clamp(3px, 0.5vh, 6px);
            font-size: clamp(0.62rem, 0.9vh, 0.68rem);
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--charcoal);
        }

        .field__control {
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--taupe);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .field__control:focus-within {
            border-bottom-color: var(--charcoal);
            box-shadow: 0 1px 0 0 var(--charcoal);
        }

        .field__input {
            flex: 1;
            min-width: 0;
            padding: clamp(8px, 1.2vh, 13px) 0 clamp(7px, 1vh, 11px);
            border: 0;
            outline: 0;
            background: transparent;
            font-family: var(--sans);
            font-size: clamp(0.9rem, 1.3vh, 1.02rem);
            color: var(--charcoal);
        }

        .field__input::placeholder {
            color: #A89B8D;
        }

        .field__input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 40px var(--paper) inset;
            -webkit-text-fill-color: var(--charcoal);
        }

        .field__toggle {
            flex: none;
            padding: 4px 0 4px 10px;
            border: 0;
            background: transparent;
            font-family: var(--sans);
            font-size: clamp(0.6rem, 0.9vh, 0.68rem);
            font-weight: 600;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--taupe-ink);
            cursor: pointer;
        }

        .field__toggle:hover { color: var(--charcoal); }

        .field.is-invalid .field__control,
        .field.is-invalid .field__control:focus-within {
            border-bottom-color: var(--error);
            box-shadow: 0 1px 0 0 var(--error);
        }

        .field__error {
            margin: clamp(4px, 0.6vh, 8px) 0 0;
            font-size: clamp(0.72rem, 1vh, 0.8rem);
            line-height: 1.4;
            color: var(--error);
        }

        /* ---------- Tombol ---------- */
        .submit {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            margin-top: clamp(18px, 2.6vh, 34px);
            padding: clamp(12px, 1.8vh, 18px) 24px;
            border: 0;
            background: var(--charcoal);
            color: var(--paper);
            font-family: var(--sans);
            font-size: clamp(0.68rem, 1vh, 0.76rem);
            font-weight: 600;
            letter-spacing: 0.26em;
            text-transform: uppercase;
            cursor: pointer;
            transition: background-color 0.25s ease;
        }

        .submit:hover { background: #3A342F; }

        .submit__arrow {
            width: clamp(20px, 2.5vw, 26px);
            height: 10px;
            transition: transform 0.25s ease;
        }

        .submit:hover .submit__arrow { transform: translateX(4px); }

        .submit[disabled] {
            cursor: progress;
            background: #4A433D;
        }

        .field__toggle:focus-visible,
        .submit:focus-visible,
        .brand:focus-visible {
            outline: 2px solid var(--champagne);
            outline-offset: 3px;
        }

        .panel__note {
            margin: clamp(12px, 1.6vh, 22px) 0 0;
            font-size: clamp(0.72rem, 1vh, 0.8rem);
            line-height: 1.55;
            color: var(--taupe-ink);
        }

        /* ---------- Footer ---------- */
        .footer {
            position: relative;
            z-index: 5;
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: clamp(10px, 1.5vh, 18px) clamp(20px, 4vw, 56px) clamp(12px, 1.8vh, 22px);
            font-size: clamp(0.6rem, 0.9vh, 0.68rem);
            letter-spacing: 0.06em;
            color: var(--taupe-ink);
            flex-shrink: 0;
        }

        .footer p { margin: 0; }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        @media (prefers-reduced-motion: reduce) {
            .submit__arrow, .field__control, .submit { transition: none; }
        }

        /* =============================================================
           Tablet (768px – 1023px)
           ============================================================= */
        @media (max-width: 1023px) {
            :root { --display-size: clamp(4.5rem, 11vw, 6.5rem); }

            .stage {
                display: grid;
                grid-template-columns: minmax(24px, 1fr) repeat(8, minmax(0, 88px)) minmax(24px, 1fr);
                grid-template-rows: auto auto 1fr;
                padding-top: 28px;
                padding-bottom: 48px;
            }

            .stage::before {
                top: 18%;
                width: 52vw;
            }

            /* Kata display menjadi vertikal di samping foto */
            .display {
                position: static;
                grid-column: 7 / 10;
                grid-row: 1;
                justify-self: center;
                align-self: start;
                margin: 0;
                padding: 0;
                writing-mode: vertical-rl;
                line-height: 1;
            }

            .plate__side { display: none; }

            .plate {
                grid-column: 2 / 7;
                grid-row: 1 / 4;
                justify-self: stretch;
                width: 100%;
                height: auto;
            }

            .panel {
                grid-column: 5 / 10;
                grid-row: 2 / 4;
                margin-top: clamp(200px, 34vw, 280px);
                margin-left: 0;
                width: auto;
            }

            .sketch { display: none; }

            .plate__caption { display: none; }
        }

        /* =============================================================
           Mobile (< 768px)
           ============================================================= */
        @media (max-width: 767px) {
            :root { --display-size: clamp(3.6rem, 17vw, 5rem); }

            .masthead { padding-top: 20px; }
            .brand__logo { width: 30px; height: 30px; }
            .brand__name { font-size: 1.4rem; }
            .masthead__meta { font-size: 0.6rem; letter-spacing: 0.18em; }

            .stage {
                display: grid;
                grid-template-columns: 20px repeat(6, minmax(0, 1fr)) 20px;
                grid-template-rows: auto auto;
                padding: 24px 0 40px;
            }

            .stage::before {
                top: 6%;
                height: 44%;
                bottom: auto;
                width: 58vw;
            }

            /* Kata display menjadi vertikal di samping foto */
            .display {
                position: static;
                grid-column: 6 / 8;
                grid-row: 1;
                justify-self: center;
                align-self: start;
                margin: 0;
                padding: 0;
                writing-mode: vertical-rl;
                line-height: 1;
                color: var(--beige);
            }

            .plate {
                grid-column: 2 / 6;
                grid-row: 1;
                width: 100%;
                height: auto;
            }

            .plate__side { display: none; }

            .panel {
                grid-column: 2 / 8;
                grid-row: 2;
                margin: -72px 0 0 24px;
                padding: 30px 24px 28px;
                width: auto;
            }

            .panel__mark { width: 80px; margin-bottom: 16px; }

            .panel__title { font-size: 2.3rem; }

            .footer {
                flex-direction: column;
                gap: 4px;
            }
        }

        @media (max-width: 359px) {
            .panel { margin-left: 0; }
            .masthead__meta span { display: none; }
        }
    </style>
</head>
<body>
@php
    /*
     * Controller menaruh pesan gagal autentikasi pada key "email".
     * Pesan validasi bawaan (required / email) dibedakan agar
     * kesalahan autentikasi bisa ditampilkan sebagai alert terpisah.
     */
    $emailError = $errors->first('email');
    $emailValidationMessages = [
        __('validation.required', ['attribute' => 'email']),
        __('validation.email', ['attribute' => 'email']),
    ];
    $authFailed = $emailError && ! in_array($emailError, $emailValidationMessages, true);
    $emailInvalid = $errors->has('email') && ! $authFailed;
    $passwordInvalid = $errors->has('password');
@endphp

<div class="page">

    <header class="masthead">
        <a href="{{ url('/') }}" class="brand" aria-label="Dressell — kembali ke beranda">
            <img src="{{ asset('assets/img/logo-dressell.png') }}" alt="" class="brand__logo" width="36" height="36">
            <span class="brand__name">Dressell</span>
        </a>
        <p class="masthead__meta">
            <strong>Dress Rental</strong>
            <span>&amp; Fitting Studio</span>
        </p>
    </header>

    <main class="stage">

        <p class="display" aria-hidden="true">Maison</p>

        <figure class="plate">
            <div class="plate__frame">
                <img
                    src="{{ asset('assets/img/login-photo.jpg') }}"
                    alt="Model mengenakan gaun Dressell"
                    class="plate__img"
                >
            </div>
            <figcaption class="plate__caption">
                <em>No. 01</em>
                <span>The Evening Edit</span>
            </figcaption>
            <p class="plate__side" aria-hidden="true">Sewa Dress &nbsp;·&nbsp; Fitting Appointment</p>
        </figure>

        <img src="{{ asset('assets/img/img-1.jpeg') }}" alt="" class="sketch" aria-hidden="true">

        <section class="panel" aria-labelledby="login-title">

            <div class="panel__mark" aria-hidden="true">
                <img src="{{ asset('assets/img/img-2.jpeg') }}" alt="">
            </div>

            <p class="eyebrow">Akun Dressell</p>

            <h1 id="login-title" class="panel__title">Selamat datang <em>kembali.</em></h1>

            <p class="panel__desc">
                Masuk untuk mengakses layanan sewa gaun, jadwal fitting, dan pengelolaan akun Dressell.
            </p>

            @if (session('status'))
                <div class="alert alert--status" role="status">
                    {{ session('status') }}
                </div>
            @endif

            @if ($authFailed)
                <div class="alert" role="alert">
                    <strong>Gagal masuk</strong>
                    {{ $emailError }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.process') }}" class="form" id="login-form" novalidate>
                @csrf

                <div class="field {{ $emailInvalid ? 'is-invalid' : '' }}">
                    <label for="email" class="field__label">Email</label>
                    <div class="field__control">
                        <input
                            id="email"
                            name="email"
                            type="email"
                            class="field__input"
                            value="{{ old('email') }}"
                            placeholder="nama@dressell.test"
                            autocomplete="username"
                            inputmode="email"
                            required
                            @if (! $passwordInvalid || $emailInvalid) autofocus @endif
                            @if ($emailInvalid) aria-invalid="true" aria-describedby="email-error" @endif
                        >
                    </div>
                    @if ($emailInvalid)
                        <p class="field__error" id="email-error">{{ $emailError }}</p>
                    @endif
                </div>

                <div class="field {{ $passwordInvalid ? 'is-invalid' : '' }}">
                    <label for="password" class="field__label">Password</label>
                    <div class="field__control">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="field__input"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                            @if ($passwordInvalid && ! $emailInvalid) autofocus @endif
                            @if ($passwordInvalid) aria-invalid="true" aria-describedby="password-error" @endif
                        >
                        <button
                            type="button"
                            class="field__toggle"
                            id="password-toggle"
                            aria-controls="password"
                            aria-pressed="false"
                        >
                            <span data-label>Lihat</span>
                            <span class="sr-only"> password</span>
                        </button>
                    </div>
                    @error('password')
                        <p class="field__error" id="password-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="submit" id="login-submit">
                    <span data-label>Masuk</span>
                    <svg class="submit__arrow" viewBox="0 0 26 10" fill="none" aria-hidden="true">
                        <path d="M0 5h24M20 1l4 4-4 4" stroke="currentColor" stroke-width="1.2"/>
                    </svg>
                </button>
            </form>

            <p class="panel__note">
                Mengalami kendala masuk atau lupa kata sandi? Hubungi layanan pelanggan Dressell.
            </p>
        </section>

    </main>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} Dressell — Sewa Dress &amp; Fitting Appointment</p>
        <p>Koleksi Gaun Eksklusif &amp; Layanan Fitting Terpercaya</p>
    </footer>

</div>

<script>
    (function () {
        var input = document.getElementById('password');
        var toggle = document.getElementById('password-toggle');
        var form = document.getElementById('login-form');
        var submit = document.getElementById('login-submit');

        toggle.addEventListener('click', function () {
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            toggle.setAttribute('aria-pressed', show ? 'true' : 'false');
            toggle.querySelector('[data-label]').textContent = show ? 'Sembunyikan' : 'Lihat';
            input.focus();
        });

        form.addEventListener('submit', function () {
            submit.disabled = true;
            submit.querySelector('[data-label]').textContent = 'Memproses…';
        });

        // Kembalikan tombol jika halaman dipulihkan dari cache (tombol back browser)
        window.addEventListener('pageshow', function () {
            submit.disabled = false;
            submit.querySelector('[data-label]').textContent = 'Masuk';
        });
    })();
</script>
</body>
</html>
