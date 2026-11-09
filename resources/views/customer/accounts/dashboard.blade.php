<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Koleksi Gaun Studio — Dashboard Customer | Dressell</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-dressell.png') }}">

    {{-- Tipografi Editorial: Cormorant Garamond (Serif) + Instrument Sans (Sans) --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,500i,600,600i|instrument-sans:400,500,600,700&display=swap">

    <!-- Stylesheet Terpusat (style.css yang sama dengan homepage) -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Vite Bundles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-white text-gray-900 min-h-screen antialiased">
    @php
        $customer = Auth::guard('web')->user();
        $userPayload = [
            'name' => $customer?->name ?? 'Pelanggan Dressell',
            'email' => $customer?->email ?? 'customer@dressell.test',
        ];
    @endphp

    <!-- Container Aplikasi Vue Dashboard Customer -->
    <div
        id="app"
        data-user="{{ json_encode($userPayload) }}"
        data-page="customer-dashboard"
        data-logout-url="{{ route('logout') }}"
        data-csrf="{{ csrf_token() }}"
    ></div>

    <!-- Script Khusus Dashboard Customer -->
    <script src="{{ asset('assets/js/customer-dashboard.js') }}"></script>
</body>
</html>
