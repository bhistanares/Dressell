<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard — Dressell</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-dressell.png') }}">

    {{-- Tipografi Editorial: Cormorant Garamond (Serif) + Instrument Sans (Sans) --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,500i,600,600i|instrument-sans:400,500,600,700&display=swap">

    {{-- CSS Khusus Admin (Terisolasi dari Customer) --}}
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

    @vite(['resources/js/admin.js'])
</head>
<body class="bg-[#FBF8F2] text-[#26221F] font-sans antialiased min-h-screen">
    @php
        $currentAdmin = Auth::guard('admin')->user();
        $adminPayload = [
            'name' => $currentAdmin?->name ?? 'Admin Dressell',
            'email' => $currentAdmin?->email ?? 'admin@dressell.test',
            'role' => $currentAdmin?->role ?? 'admin',
        ];
    @endphp

    <div
        id="admin-app"
        data-admin="{{ json_encode($adminPayload) }}"
        data-logout-url="{{ route('admin.logout') }}"
        data-csrf="{{ csrf_token() }}"
    ></div>
</body>
</html>
