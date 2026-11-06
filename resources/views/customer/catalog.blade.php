<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Katalog Dress – Dressell</title>

        @fonts

        <!-- Stylesheets -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/catalog.css') }}">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css'])
        @endif
    </head>
    <body class="bg-white text-gray-900 min-h-screen antialiased">
        <!-- ==============================================================
             Navbar Dressell (Konsisten dengan Homepage)
             ============================================================== -->
        <header class="navbar">
            <div class="navbar-container">
                <!-- Baris Pertama: Logo, Search, Aksi -->
                <div class="navbar-main">
                    <!-- Logo -->
                    <a href="/" class="navbar-logo">
                        <span class="navbar-logo-icon">🌸</span>
                        <span class="navbar-logo-text">Dressell</span>
                    </a>

                    <!-- Search Desktop -->
                    <div class="navbar-search-desktop">
                        <form id="navbar-search-form" onsubmit="event.preventDefault(); submitNavbarSearch();" class="navbar-search">
                            <input
                                id="navbar-search-input"
                                type="text"
                                placeholder="Cari dress..."
                                class="navbar-search-input"
                                oninput="onNavbarSearchInput(this.value)"
                            />
                            <button
                                type="submit"
                                class="navbar-search-button"
                                aria-label="Cari"
                            >
                                <svg
                                    class="navbar-search-icon"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                    />
                                </svg>
                            </button>
                        </form>
                    </div>

                    <!-- Ikon Aksi -->
                    <div class="navbar-actions">
                        <!-- Favorit -->
                        <button
                            type="button"
                            class="navbar-action-button"
                            aria-label="Wishlist"
                            title="Favorit Saya"
                        >
                            <svg
                                class="navbar-action-icon"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                />
                            </svg>
                        </button>

                        <!-- Bandingkan Dress (Ikon Gantungan Baju) -->
                        <button
                            type="button"
                            class="navbar-action-button"
                            aria-label="Bandingkan Dress"
                            title="Bandingkan Dress"
                        >
                            <svg
                                class="navbar-action-icon"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M14 6a2 2 0 10-4 0c0 1.66 1.34 2.5 2 3.5l8 6.5H4l8-6.5"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M3 18a1 1 0 001 1h16a1 1 0 001-1"
                                />
                            </svg>
                            <span class="navbar-cart-badge">0</span>
                        </button>

                        <!-- Profil -->
                        <button
                            type="button"
                            class="navbar-action-button"
                            aria-label="Akun"
                            title="Akun Saya"
                        >
                            <svg
                                class="navbar-action-icon"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                />
                            </svg>
                        </button>

                        <!-- Tombol Menu Mobile -->
                        <button
                            type="button"
                            id="mobile-menu-toggle"
                            onclick="toggleMobileMenu()"
                            class="navbar-menu-button"
                            aria-label="Menu"
                            aria-expanded="false"
                        >
                            <svg
                                id="mobile-menu-icon"
                                class="navbar-menu-icon"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Baris Kedua: Navigasi Desktop -->
                <div class="navbar-secondary">
                    <nav class="navbar-navigation">
                        <a href="/" class="navbar-link">Beranda</a>
                        <a href="/katalog" class="navbar-link active">Katalog</a>
                        <a href="#fitting" class="navbar-link">Fitting Appointment</a>
                        <a href="#cara-menyewa" class="navbar-link">Cara Menyewa</a>
                    </nav>
                </div>
            </div>

            <!-- Menu Mobile Drawer -->
            <div id="mobile-menu-drawer" class="navbar-mobile" style="display: none;">
                <div class="navbar-mobile-content">
                    <div class="navbar-search navbar-mobile-search">
                        <form id="navbar-search-mobile-form" onsubmit="event.preventDefault(); submitNavbarSearch();" style="display: flex; width: 100%; align-items: center;">
                            <input
                                id="navbar-search-mobile-input"
                                type="text"
                                placeholder="Cari dress..."
                                class="navbar-search-input"
                                style="width: 100%;"
                                oninput="onNavbarSearchInput(this.value)"
                            />
                            <button
                                type="submit"
                                class="navbar-search-button"
                                aria-label="Cari"
                            >
                                <svg
                                    class="navbar-search-icon"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                    />
                                </svg>
                            </button>
                        </form>
                    </div>

                    <!-- Navigasi Mobile -->
                    <nav class="navbar-mobile-links">
                        <a href="/" class="navbar-mobile-link">Beranda</a>
                        <a href="/katalog" class="navbar-mobile-link font-semibold text-rose-600">Katalog</a>
                        <a href="#fitting" class="navbar-mobile-link">Fitting Appointment</a>
                        <a href="#cara-menyewa" class="navbar-mobile-link">Cara Menyewa</a>
                    </nav>

                    <!-- Aksi Mobile -->
                    <div class="navbar-mobile-actions">
                        <button type="button" class="navbar-mobile-action">
                            <svg
                                class="navbar-mobile-action-icon"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                />
                            </svg>
                            Wishlist
                        </button>

                        <button type="button" class="navbar-mobile-action">
                            <svg
                                class="navbar-mobile-action-icon"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M14 6a2 2 0 10-4 0c0 1.66 1.34 2.5 2 3.5l8 6.5H4l8-6.5"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M3 18a1 1 0 001 1h16a1 1 0 001-1"
                                />
                            </svg>
                            Bandingkan Dress
                        </button>

                        <button type="button" class="navbar-mobile-action">
                            <svg
                                class="navbar-mobile-action-icon"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                />
                            </svg>
                            Masuk
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- ==============================================================
             Area Konten Utama Katalog Dress
             ============================================================== -->
        <main class="catalog-page">
            <div class="catalog-container">

                <!-- Header Katalog (Tanpa breadcrumb) -->
                <div class="catalog-header">
                    <div class="catalog-header-main">
                        <div>
                            <h1 class="catalog-title">Katalog Dress</h1>
                            <p class="catalog-subtitle">
                                Temukan gaun dan kebaya terbaik untuk berbagai momen spesialmu, mulai dari pesta pernikahan, wisuda, hingga acara formal.
                            </p>
                        </div>
                        <div class="catalog-count-badge">
                            Menampilkan <span id="catalog-count" class="catalog-count-number">0</span> dress
                        </div>
                    </div>
                </div>

                <!-- Kontrol Filter & Pengurutan (catalog-controls) -->
                <div class="catalog-controls">
                    <!-- Baris Atas: Tombol Filter & Dropdown Urutkan -->
                    <div class="catalog-controls-bar">
                        <div class="catalog-controls-left">
                            <button
                                type="button"
                                id="filter-toggle-btn"
                                class="catalog-filter-toggle-btn is-active"
                                onclick="toggleFilterPanel()"
                                aria-expanded="true"
                                aria-controls="catalog-filter-panel"
                            >
                                <svg class="catalog-filter-btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                <span>Filter</span>
                                <span id="active-filter-badge" class="catalog-filter-count-badge" style="display: none;">0</span>
                                <svg id="filter-chevron-icon" class="catalog-filter-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <span class="catalog-results-hint" id="catalog-results-hint">
                                <span id="hint-count">0</span> dress ditemukan
                            </span>
                        </div>

                        <div class="catalog-controls-right">
                            <div class="catalog-sort-wrapper">
                                <label for="catalog-sort-select" class="catalog-sort-label">Urutkan:</label>
                                <div class="catalog-select-container">
                                    <select
                                        id="catalog-sort-select"
                                        class="catalog-sort-select"
                                        onchange="handleSortChange(this.value)"
                                    >
                                        <option value="popular">Terpopuler</option>
                                        <option value="newest">Terbaru</option>
                                        <option value="price-asc">Harga Terendah</option>
                                        <option value="price-desc">Harga Tertinggi</option>
                                    </select>
                                    <svg class="catalog-select-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Panel Filter Lengkap (Dapat dibuka / ditutup) -->
                    <div id="catalog-filter-panel" class="catalog-filter-panel">
                        <div class="catalog-filter-grid">
                            <!-- Kelompok 1: Brand -->
                            <div class="catalog-filter-section">
                                <div class="catalog-filter-section-header">
                                    <span class="catalog-filter-label">Brand</span>
                                    <span class="catalog-filter-sublabel">(Multi-pilih)</span>
                                </div>
                                <div class="catalog-filter-options" id="brand-filters">
                                    <!-- Rendered dynamically -->
                                </div>
                            </div>

                            <!-- Kelompok 2: Kategori Produk -->
                            <div class="catalog-filter-section">
                                <div class="catalog-filter-section-header">
                                    <span class="catalog-filter-label">Kategori</span>
                                </div>
                                <div class="catalog-filter-options" id="category-filters">
                                    <!-- Rendered dynamically -->
                                </div>
                            </div>

                            <!-- Kelompok 3: Tipe & Kebutuhan (Acara, Gaya, Karakteristik) -->
                            <div class="catalog-filter-section">
                                <div class="catalog-filter-section-header">
                                    <span class="catalog-filter-label">Tipe & Kebutuhan</span>
                                </div>

                                <div class="catalog-subfilter-group">
                                    <span class="catalog-subfilter-title">Kebutuhan Acara:</span>
                                    <div class="catalog-filter-options" id="event-filters">
                                        <!-- Rendered dynamically -->
                                    </div>
                                </div>

                                <div class="catalog-subfilter-group">
                                    <span class="catalog-subfilter-title">Gaya Dress:</span>
                                    <div class="catalog-filter-options" id="style-filters">
                                        <!-- Rendered dynamically -->
                                    </div>
                                </div>

                                <div class="catalog-subfilter-group">
                                    <span class="catalog-subfilter-title">Karakteristik:</span>
                                    <div class="catalog-filter-options" id="characteristic-filters">
                                        <!-- Rendered dynamically -->
                                    </div>
                                </div>
                            </div>

                            <!-- Kelompok 4: Ukuran -->
                            <div class="catalog-filter-section">
                                <div class="catalog-filter-section-header">
                                    <span class="catalog-filter-label">Ukuran</span>
                                </div>
                                <div class="catalog-filter-options" id="size-filters">
                                    <!-- Rendered dynamically -->
                                </div>
                            </div>

                            <!-- Kelompok 5: Warna -->
                            <div class="catalog-filter-section">
                                <div class="catalog-filter-section-header">
                                    <span class="catalog-filter-label">Warna</span>
                                </div>
                                <div class="catalog-filter-options" id="color-filters">
                                    <!-- Rendered dynamically with swatches -->
                                </div>
                            </div>

                            <!-- Kelompok 6: Rentang Harga -->
                            <div class="catalog-filter-section">
                                <div class="catalog-filter-section-header">
                                    <span class="catalog-filter-label">Rentang Harga</span>
                                    <span class="catalog-filter-sublabel">(per hari)</span>
                                </div>
                                <div class="catalog-price-inputs">
                                    <div class="catalog-price-field">
                                        <span class="catalog-price-prefix">Rp</span>
                                        <input
                                            type="number"
                                            id="price-min-input"
                                            class="catalog-price-input"
                                            placeholder="Min (85.000)"
                                            min="0"
                                            step="10000"
                                            oninput="onPriceInputChange()"
                                        />
                                    </div>
                                    <span class="catalog-price-dash">—</span>
                                    <div class="catalog-price-field">
                                        <span class="catalog-price-prefix">Rp</span>
                                        <input
                                            type="number"
                                            id="price-max-input"
                                            class="catalog-price-input"
                                            placeholder="Maks (450.000)"
                                            min="0"
                                            step="10000"
                                            oninput="onPriceInputChange()"
                                        />
                                    </div>
                                    <button
                                        type="button"
                                        class="catalog-price-apply-btn"
                                        onclick="applyPriceFilter()"
                                    >
                                        Terapkan
                                    </button>
                                </div>
                                <span id="price-validation-error" class="catalog-price-error" style="display: none;">
                                    Harga minimum tidak boleh lebih besar dari harga maksimum.
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Chip Filter Aktif & Reset Bar -->
                    <div id="catalog-active-bar" class="catalog-active-filters-bar" style="display: none;">
                        <div class="catalog-chips-container">
                            <span class="catalog-chips-label">Filter aktif:</span>
                            <div id="catalog-chips-list" class="catalog-chips-list">
                                <!-- Chips rendered dynamically -->
                            </div>
                        </div>
                        <button type="button" class="catalog-reset-btn" onclick="resetAllFilters()">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reset Filter
                        </button>
                    </div>
                </div>

                <!-- Grid Kartu Dress -->
                <div id="catalog-grid" class="collection-grid">
                    <!-- Diisi secara dinamis oleh JavaScript -->
                </div>

                <!-- Empty State: Ketika tidak ada hasil filter / pencarian -->
                <div id="catalog-empty" class="catalog-empty-state" style="display: none;">
                    <div class="catalog-empty-icon">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2" />
                        </svg>
                    </div>
                    <h2 class="catalog-empty-title">Dress Tidak Ditemukan</h2>
                    <p class="catalog-empty-desc">
                        Maaf, tidak ada dress yang sesuai dengan kata kunci atau kombinasi filter yang Anda pilih. Coba atur ulang filter pencarian Anda.
                    </p>
                    <button type="button" class="catalog-empty-btn" onclick="resetAllFilters()">
                        Tampilkan Semua Dress
                    </button>
                </div>

            </div>
        </main>

        <!-- ==============================================================
             The Footer (Konsisten dengan Homepage)
             ============================================================== -->
        <footer class="footer">
            <div class="footer-main">
                <div class="footer-grid">
                    <!-- Brand Column -->
                    <div class="footer-brand">
                        <a href="/" class="footer-logo">
                            <span class="footer-logo-icon">🌸</span>
                            <span class="footer-logo-text">Dressell</span>
                        </a>
                        <p class="footer-description">
                            Platform penyewaan dress premium terpercaya. Tampil memukau di setiap momen spesialmu bersama Dressell.
                        </p>
                        <div class="footer-socials">
                            <a href="#" class="footer-social-link" aria-label="Instagram">
                                <span class="footer-social-icon">📸</span>
                            </a>
                            <a href="#" class="footer-social-link" aria-label="TikTok">
                                <span class="footer-social-icon">🎵</span>
                            </a>
                            <a href="#" class="footer-social-link" aria-label="WhatsApp">
                                <span class="footer-social-icon">💬</span>
                            </a>
                        </div>
                    </div>

                    <!-- Company Links -->
                    <div class="footer-column">
                        <h3 class="footer-heading">Perusahaan</h3>
                        <ul class="footer-link-list">
                            <li><a href="#" class="footer-link">Tentang Kami</a></li>
                            <li><a href="#" class="footer-link">Karir</a></li>
                            <li><a href="#" class="footer-link">Blog & Artikel</a></li>
                            <li><a href="#" class="footer-link">Kebijakan Privasi</a></li>
                        </ul>
                    </div>

                    <!-- Help Links -->
                    <div class="footer-column">
                        <h3 class="footer-heading">Bantuan</h3>
                        <ul class="footer-link-list">
                            <li><a href="#cara-menyewa" class="footer-link">Cara Menyewa</a></li>
                            <li><a href="#" class="footer-link">Panduan Ukuran</a></li>
                            <li><a href="#" class="footer-link">FAQ</a></li>
                            <li><a href="#" class="footer-link">Syarat & Ketentuan</a></li>
                        </ul>
                    </div>

                    <!-- Information Links -->
                    <div class="footer-column">
                        <h3 class="footer-heading">Informasi</h3>
                        <ul class="footer-link-list">
                            <li><a href="#" class="footer-link">Lokasi Butik</a></li>
                            <li><a href="#fitting" class="footer-link">Fitting Appointment</a></li>
                            <li><a href="#" class="footer-link">Perawatan Dress</a></li>
                            <li><a href="#" class="footer-link">Hubungi Kami</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="footer-bottom">
                <div class="footer-bottom-container">
                    <div class="footer-bottom-content">
                        <p class="footer-copyright">
                            &copy; 2026 Dressell. Hak Cipta Dilindungi Undang-Undang.
                        </p>
                        <div class="footer-payments">
                            <span class="footer-payment-label">Metode Pembayaran:</span>
                            <span class="footer-payment-method">BCA</span>
                            <span class="footer-payment-method">Mandiri</span>
                            <span class="footer-payment-method">BNI</span>
                            <span class="footer-payment-method">QRIS</span>
                            <span class="footer-payment-method">GoPay</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- ==============================================================
             Logika Interaksi Frontend Katalog (Pencarian, Filter, Sort, Kartu)
             ============================================================== -->
        <script>
            // Data katalog produk dress Dressell lengkap dengan metadata Brand, Tipe & Kebutuhan, Ukuran, Warna, dan Harga
            // Catatan: Nilai rentalCount adalah data dummy simulasi transaksi penyewaan untuk pengurutan Terpopuler
            // Nilai createdAt adalah tanggal simulasi penambahan produk ke katalog untuk pengurutan Terbaru
            const allProducts = [
                {
                    id: 1,
                    modelCode: 'DRS-001',
                    brand: 'Syaza Atelier',
                    name: 'Gaun Pesta Elegan Mawar',
                    category: 'Dress Pesta',
                    events: ['Pesta', 'Ulang tahun'],
                    style: 'Modern',
                    characteristics: ['Hijab-friendly'],
                    color: 'Rose',
                    colorHex: '#f43f5e',
                    price: 150000,
                    sizes: ['S', 'M', 'L'],
                    available: true,
                    rentalCount: 42,
                    createdAt: '2026-10-15',
                    image: 'https://picsum.photos/seed/prod-1/400/533',
                },
                {
                    id: 2,
                    modelCode: 'KBY-012',
                    brand: 'Arunika Kebaya',
                    name: 'Kebaya Modern Songket',
                    category: 'Kebaya Modern',
                    events: ['Wisuda', 'Pernikahan', 'Acara formal'],
                    style: 'Tradisional',
                    characteristics: ['Hijab-friendly', 'Busui-friendly'],
                    color: 'Merah Marun',
                    colorHex: '#991b1b',
                    price: 200000,
                    sizes: ['M', 'L', 'XL'],
                    available: true,
                    rentalCount: 35,
                    createdAt: '2026-10-18',
                    image: 'https://picsum.photos/seed/prod-2/400/533',
                },
                {
                    id: 3,
                    modelCode: 'GWN-003',
                    brand: 'Syaza Atelier',
                    name: 'Gaun Pengantin Aurora',
                    category: 'Gaun Pernikahan',
                    events: ['Pernikahan'],
                    style: 'Modern',
                    characteristics: ['Hijab-friendly'],
                    color: 'Putih',
                    colorHex: '#ffffff',
                    price: 450000,
                    sizes: ['S', 'M'],
                    available: true,
                    rentalCount: 58,
                    createdAt: '2026-09-20',
                    image: 'https://picsum.photos/seed/prod-3/400/533',
                },
                {
                    id: 4,
                    modelCode: 'BTK-021',
                    brand: 'Batik Danar',
                    name: 'Midi Dress Batik Parang',
                    category: 'Batik & Tenun',
                    events: ['Acara formal', 'Wisuda'],
                    style: 'Tradisional',
                    characteristics: ['Busui-friendly'],
                    color: 'Cokelat',
                    colorHex: '#78350f',
                    price: 120000,
                    sizes: ['S', 'M', 'L', 'XL'],
                    available: true,
                    rentalCount: 28,
                    createdAt: '2026-10-02',
                    image: 'https://picsum.photos/seed/prod-4/400/533',
                },
                {
                    id: 5,
                    modelCode: 'CSL-008',
                    brand: 'Lumiere Studio',
                    name: 'Dress Casual Linen Putih',
                    category: 'Dress Casual',
                    events: ['Acara kasual', 'Ulang tahun'],
                    style: 'Korean style',
                    characteristics: [],
                    color: 'Putih',
                    colorHex: '#ffffff',
                    price: 85000,
                    sizes: ['XS', 'S', 'M'],
                    available: true,
                    rentalCount: 19,
                    createdAt: '2026-10-22',
                    image: 'https://picsum.photos/seed/prod-5/400/533',
                },
                {
                    id: 6,
                    modelCode: 'MXD-015',
                    brand: 'Lumiere Studio',
                    name: 'Maxi Dress Floral Garden',
                    category: 'Maxi Dress',
                    events: ['Acara kasual', 'Pesta'],
                    style: 'Japanese style',
                    characteristics: ['Hijab-friendly'],
                    color: 'Sage Green',
                    colorHex: '#15803d',
                    price: 110000,
                    sizes: ['M', 'L'],
                    available: true,
                    rentalCount: 47,
                    createdAt: '2026-10-10',
                    image: 'https://picsum.photos/seed/prod-6/400/533',
                },
                {
                    id: 7,
                    modelCode: 'FRM-009',
                    brand: 'Syaza Atelier',
                    name: 'Gaun Formal Velvet Navy',
                    category: 'Gaun Formal',
                    events: ['Acara formal', 'Pesta'],
                    style: 'Modern',
                    characteristics: ['Hijab-friendly'],
                    color: 'Navy',
                    colorHex: '#1e3a8a',
                    price: 185000,
                    sizes: ['S', 'M', 'L'],
                    available: false,
                    rentalCount: 15,
                    createdAt: '2026-09-12',
                    image: 'https://picsum.photos/seed/prod-7/400/533',
                },
                {
                    id: 8,
                    modelCode: 'DRS-017',
                    brand: 'Glamour House',
                    name: 'Dress Pesta Sequin Merah',
                    category: 'Dress Pesta',
                    events: ['Pesta', 'Ulang tahun'],
                    style: 'Korean style',
                    characteristics: [],
                    color: 'Merah',
                    colorHex: '#dc2626',
                    price: 220000,
                    sizes: ['M', 'L'],
                    available: true,
                    rentalCount: 31,
                    createdAt: '2026-10-25',
                    image: 'https://picsum.photos/seed/prod-8/400/533',
                },
            ];

            // Master data filter yang diambil dari atribut produk nyata
            const availableCategories = ['Dress Pesta', 'Kebaya Modern', 'Gaun Pernikahan', 'Batik & Tenun', 'Dress Casual', 'Maxi Dress', 'Gaun Formal'];
            const availableBrands = ['Syaza Atelier', 'Arunika Kebaya', 'Batik Danar', 'Lumiere Studio', 'Glamour House'];
            const availableEvents = ['Pesta', 'Pernikahan', 'Ulang tahun', 'Wisuda', 'Acara formal', 'Acara kasual'];
            const availableStyles = ['Korean style', 'Japanese style', 'Modern', 'Tradisional'];
            const availableCharacteristics = ['Hijab-friendly', 'Busui-friendly'];
            const availableSizes = ['XS', 'S', 'M', 'L', 'XL'];
            const availableColors = [
                { name: 'Rose', hex: '#f43f5e' },
                { name: 'Merah', hex: '#dc2626' },
                { name: 'Merah Marun', hex: '#991b1b' },
                { name: 'Putih', hex: '#ffffff', hasBorder: true },
                { name: 'Navy', hex: '#1e3a8a' },
                { name: 'Sage Green', hex: '#15803d' },
                { name: 'Cokelat', hex: '#78350f' },
            ];

            // State Pencarian, Filter & Sorting
            let searchQuery = '';
            let currentCategory = 'all';
            let selectedBrands = new Set();
            let selectedEvents = new Set();
            let selectedStyles = new Set();
            let selectedCharacteristics = new Set();
            let selectedSizes = new Set();
            let selectedColors = new Set();
            let priceMin = null;
            let priceMax = null;
            let currentSort = 'popular';
            let isFilterPanelOpen = true; // Terbuka secara default agar pengguna langsung melihat filter
            const wishlistState = new Set();

            // Format Harga Rupiah
            function formatPrice(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }

            // Escape HTML untuk mencegah XSS pada string dinamis
            function escapeHtml(str) {
                if (!str) return '';
                return String(str)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#39;');
            }

            // Toggle Panel Filter
            function toggleFilterPanel() {
                isFilterPanelOpen = !isFilterPanelOpen;
                const panel = document.getElementById('catalog-filter-panel');
                const btn = document.getElementById('filter-toggle-btn');
                if (panel) {
                    panel.style.display = isFilterPanelOpen ? 'block' : 'none';
                }
                if (btn) {
                    btn.setAttribute('aria-expanded', isFilterPanelOpen);
                    btn.classList.toggle('is-active', isFilterPanelOpen);
                }
            }

            // Hitung total filter yang aktif (selain kata kunci pencarian)
            function getActiveFilterCount() {
                let count = 0;
                if (currentCategory !== 'all') count++;
                count += selectedBrands.size;
                count += selectedEvents.size;
                count += selectedStyles.size;
                count += selectedCharacteristics.size;
                count += selectedSizes.size;
                count += selectedColors.size;
                if (priceMin !== null || priceMax !== null) count++;
                return count;
            }

            // Sinkronisasi status URL (search params)
            function updateUrlParams() {
                const url = new URL(window.location.href);
                if (searchQuery.trim()) {
                    url.searchParams.set('search', searchQuery.trim());
                } else {
                    url.searchParams.delete('search');
                }
                if (currentCategory !== 'all') {
                    url.searchParams.set('kategori', currentCategory);
                } else {
                    url.searchParams.delete('kategori');
                }
                window.history.replaceState({}, '', url.toString());
            }

            // Render opsi tombol filter (Brand, Kategori, Acara, Gaya, Karakteristik, Ukuran, Warna)
            function renderFilterControls() {
                // Brand
                const brandContainer = document.getElementById('brand-filters');
                if (brandContainer) {
                    brandContainer.innerHTML = availableBrands.map(brand => {
                        const active = selectedBrands.has(brand) ? 'active' : '';
                        return `<button type="button" class="catalog-pill-btn ${active}" onclick="toggleBrand('${escapeHtml(brand)}')">${escapeHtml(brand)}</button>`;
                    }).join('');
                }

                // Kategori
                const categoryContainer = document.getElementById('category-filters');
                if (categoryContainer) {
                    let html = `<button type="button" class="catalog-pill-btn ${currentCategory === 'all' ? 'active' : ''}" onclick="setCategory('all')">Semua</button>`;
                    html += availableCategories.map(cat => {
                        const active = currentCategory === cat ? 'active' : '';
                        return `<button type="button" class="catalog-pill-btn ${active}" onclick="setCategory('${escapeHtml(cat)}')">${escapeHtml(cat)}</button>`;
                    }).join('');
                    categoryContainer.innerHTML = html;
                }

                // Kebutuhan Acara
                const eventContainer = document.getElementById('event-filters');
                if (eventContainer) {
                    eventContainer.innerHTML = availableEvents.map(ev => {
                        const active = selectedEvents.has(ev) ? 'active' : '';
                        return `<button type="button" class="catalog-pill-btn ${active}" onclick="toggleEvent('${escapeHtml(ev)}')">${escapeHtml(ev)}</button>`;
                    }).join('');
                }

                // Gaya Dress
                const styleContainer = document.getElementById('style-filters');
                if (styleContainer) {
                    styleContainer.innerHTML = availableStyles.map(st => {
                        const active = selectedStyles.has(st) ? 'active' : '';
                        return `<button type="button" class="catalog-pill-btn ${active}" onclick="toggleStyle('${escapeHtml(st)}')">${escapeHtml(st)}</button>`;
                    }).join('');
                }

                // Karakteristik
                const charContainer = document.getElementById('characteristic-filters');
                if (charContainer) {
                    charContainer.innerHTML = availableCharacteristics.map(ch => {
                        const active = selectedCharacteristics.has(ch) ? 'active' : '';
                        return `<button type="button" class="catalog-pill-btn ${active}" onclick="toggleCharacteristic('${escapeHtml(ch)}')">${escapeHtml(ch)}</button>`;
                    }).join('');
                }

                // Ukuran
                const sizeContainer = document.getElementById('size-filters');
                if (sizeContainer) {
                    sizeContainer.innerHTML = availableSizes.map(sz => {
                        const active = selectedSizes.has(sz) ? 'active' : '';
                        return `<button type="button" class="catalog-pill-btn catalog-pill-size ${active}" onclick="toggleSize('${escapeHtml(sz)}')">${escapeHtml(sz)}</button>`;
                    }).join('');
                }

                // Warna
                const colorContainer = document.getElementById('color-filters');
                if (colorContainer) {
                    colorContainer.innerHTML = availableColors.map(c => {
                        const active = selectedColors.has(c.name) ? 'active' : '';
                        const borderClass = c.hasBorder ? 'has-border' : '';
                        return `
                            <button type="button" class="catalog-pill-btn ${active}" onclick="toggleColor('${escapeHtml(c.name)}')">
                                <span class="catalog-color-dot ${borderClass}" style="background-color: ${c.hex};"></span>
                                <span>${escapeHtml(c.name)}</span>
                            </button>
                        `;
                    }).join('');
                }
            }

            // Render Chip Filter Aktif
            function renderActiveChips() {
                const activeBar = document.getElementById('catalog-active-bar');
                const chipsList = document.getElementById('catalog-chips-list');
                const badge = document.getElementById('active-filter-badge');

                const activeCount = getActiveFilterCount();
                const hasSearch = searchQuery.trim().length > 0;

                // Update badge pada tombol filter
                if (badge) {
                    if (activeCount > 0) {
                        badge.textContent = activeCount;
                        badge.style.display = 'inline-flex';
                    } else {
                        badge.style.display = 'none';
                    }
                }

                if (!hasSearch && activeCount === 0) {
                    if (activeBar) activeBar.style.display = 'none';
                    return;
                }

                if (activeBar) activeBar.style.display = 'flex';

                const chips = [];

                // Chip Pencarian
                if (hasSearch) {
                    chips.push(`
                        <span class="catalog-chip">
                            <span>Pencarian: "<strong>${escapeHtml(searchQuery.trim())}</strong>"</span>
                            <button type="button" class="catalog-chip-remove" onclick="clearSearch()" aria-label="Hapus pencarian">&times;</button>
                        </span>
                    `);
                }

                // Chip Kategori
                if (currentCategory !== 'all') {
                    chips.push(`
                        <span class="catalog-chip">
                            <span>Kategori: ${escapeHtml(currentCategory)}</span>
                            <button type="button" class="catalog-chip-remove" onclick="setCategory('all')" aria-label="Hapus filter kategori">&times;</button>
                        </span>
                    `);
                }

                // Chip Brand
                selectedBrands.forEach(b => {
                    chips.push(`
                        <span class="catalog-chip">
                            <span>Brand: ${escapeHtml(b)}</span>
                            <button type="button" class="catalog-chip-remove" onclick="toggleBrand('${escapeHtml(b)}')" aria-label="Hapus filter brand">&times;</button>
                        </span>
                    `);
                });

                // Chip Acara
                selectedEvents.forEach(ev => {
                    chips.push(`
                        <span class="catalog-chip">
                            <span>Acara: ${escapeHtml(ev)}</span>
                            <button type="button" class="catalog-chip-remove" onclick="toggleEvent('${escapeHtml(ev)}')" aria-label="Hapus filter acara">&times;</button>
                        </span>
                    `);
                });

                // Chip Gaya
                selectedStyles.forEach(st => {
                    chips.push(`
                        <span class="catalog-chip">
                            <span>Gaya: ${escapeHtml(st)}</span>
                            <button type="button" class="catalog-chip-remove" onclick="toggleStyle('${escapeHtml(st)}')" aria-label="Hapus filter gaya">&times;</button>
                        </span>
                    `);
                });

                // Chip Karakteristik
                selectedCharacteristics.forEach(ch => {
                    chips.push(`
                        <span class="catalog-chip">
                            <span>${escapeHtml(ch)}</span>
                            <button type="button" class="catalog-chip-remove" onclick="toggleCharacteristic('${escapeHtml(ch)}')" aria-label="Hapus filter karakteristik">&times;</button>
                        </span>
                    `);
                });

                // Chip Ukuran
                selectedSizes.forEach(sz => {
                    chips.push(`
                        <span class="catalog-chip">
                            <span>Ukuran: ${escapeHtml(sz)}</span>
                            <button type="button" class="catalog-chip-remove" onclick="toggleSize('${escapeHtml(sz)}')" aria-label="Hapus filter ukuran">&times;</button>
                        </span>
                    `);
                });

                // Chip Warna
                selectedColors.forEach(c => {
                    chips.push(`
                        <span class="catalog-chip">
                            <span>Warna: ${escapeHtml(c)}</span>
                            <button type="button" class="catalog-chip-remove" onclick="toggleColor('${escapeHtml(c)}')" aria-label="Hapus filter warna">&times;</button>
                        </span>
                    `);
                });

                // Chip Rentang Harga
                if (priceMin !== null || priceMax !== null) {
                    const minText = priceMin !== null ? `Rp ${formatPrice(priceMin)}` : 'Min';
                    const maxText = priceMax !== null ? `Rp ${formatPrice(priceMax)}` : 'Maks';
                    chips.push(`
                        <span class="catalog-chip">
                            <span>Harga: ${minText} – ${maxText}</span>
                            <button type="button" class="catalog-chip-remove" onclick="clearPriceFilter()" aria-label="Hapus filter harga">&times;</button>
                        </span>
                    `);
                }

                if (chipsList) {
                    chipsList.innerHTML = chips.join('');
                }
            }

            // Logika Penyaringan Produk
            function getFilteredProducts() {
                return allProducts.filter(item => {
                    // Filter Pencarian Navbar (Nama dress, Kode dress, Brand, Kategori, Warna, Gaya, Acara, Karakteristik)
                    if (searchQuery.trim()) {
                        const q = searchQuery.toLowerCase().trim();
                        const matchName = item.name.toLowerCase().includes(q);
                        const matchCode = item.modelCode.toLowerCase().includes(q);
                        const matchBrand = item.brand.toLowerCase().includes(q);
                        const matchCategory = item.category.toLowerCase().includes(q);
                        const matchColor = item.color.toLowerCase().includes(q);
                        const matchStyle = item.style.toLowerCase().includes(q);
                        const matchEvents = item.events.some(e => e.toLowerCase().includes(q));
                        const matchCharacteristics = item.characteristics.some(c => c.toLowerCase().includes(q));

                        if (!matchName && !matchCode && !matchBrand && !matchCategory && !matchColor && !matchStyle && !matchEvents && !matchCharacteristics) {
                            return false;
                        }
                    }

                    // Filter Kategori
                    if (currentCategory !== 'all' && item.category !== currentCategory) {
                        return false;
                    }

                    // Filter Brand (Multi-pilih)
                    if (selectedBrands.size > 0 && !selectedBrands.has(item.brand)) {
                        return false;
                    }

                    // Filter Kebutuhan Acara (Multi-pilih)
                    if (selectedEvents.size > 0) {
                        const matchEv = item.events.some(ev => selectedEvents.has(ev));
                        if (!matchEv) return false;
                    }

                    // Filter Gaya Dress (Multi-pilih)
                    if (selectedStyles.size > 0 && !selectedStyles.has(item.style)) {
                        return false;
                    }

                    // Filter Karakteristik (Harus memenuhi karakteristik yang dipilih)
                    if (selectedCharacteristics.size > 0) {
                        for (const ch of selectedCharacteristics) {
                            if (!item.characteristics.includes(ch)) {
                                return false;
                            }
                        }
                    }

                    // Filter Ukuran (Multi-pilih)
                    if (selectedSizes.size > 0) {
                        const matchSz = item.sizes.some(sz => selectedSizes.has(sz));
                        if (!matchSz) return false;
                    }

                    // Filter Warna (Multi-pilih)
                    if (selectedColors.size > 0 && !selectedColors.has(item.color)) {
                        return false;
                    }

                    // Filter Rentang Harga
                    if (priceMin !== null && !isNaN(priceMin) && item.price < priceMin) {
                        return false;
                    }
                    if (priceMax !== null && !isNaN(priceMax) && item.price > priceMax) {
                        return false;
                    }

                    return true;
                });
            }

            // Logika Pengurutan Produk (Sort)
            function sortProducts(products) {
                const list = [...products];
                switch (currentSort) {
                    case 'popular':
                        // Terpopuler: dasar pengurutan dari jumlah rental/transaksi penyewaan (rentalCount dummy simulation)
                        return list.sort((a, b) => (b.rentalCount || 0) - (a.rentalCount || 0));
                    case 'newest':
                        // Terbaru: dasar pengurutan dari tanggal penambahan produk (createdAt descending)
                        return list.sort((a, b) => new Date(b.createdAt).getTime() - new Date(a.createdAt).getTime());
                    case 'price-asc':
                        // Harga terendah ke tertinggi
                        return list.sort((a, b) => a.price - b.price);
                    case 'price-desc':
                        // Harga tertinggi ke terendah
                        return list.sort((a, b) => b.price - a.price);
                    default:
                        return list;
                }
            }

            // Render Halaman Katalog
            function renderCatalog() {
                const grid = document.getElementById('catalog-grid');
                const emptyState = document.getElementById('catalog-empty');
                const countBadge = document.getElementById('catalog-count');
                const hintCount = document.getElementById('hint-count');

                renderFilterControls();
                renderActiveChips();

                // Dapatkan hasil terfilter dan terurut
                const filtered = getFilteredProducts();
                const sorted = sortProducts(filtered);

                // Perbarui jumlah produk
                if (countBadge) {
                    countBadge.textContent = sorted.length;
                }
                if (hintCount) {
                    hintCount.textContent = sorted.length;
                }

                // Tampilkan Empty State bila tidak ada produk
                if (sorted.length === 0) {
                    grid.innerHTML = '';
                    emptyState.style.display = 'flex';
                    return;
                }

                emptyState.style.display = 'none';

                // Buat kartu dress sesuai ketentuan
                // Format: "Nama Brand | Kode Dress" dalam satu baris pada collection-product-meta
                grid.innerHTML = sorted.map(product => {
                    const isWishlisted = wishlistState.has(product.id);
                    const sizesHtml = product.sizes.map(s => `<span class="collection-size">${escapeHtml(s)}</span>`).join('');

                    return `
                        <div class="collection-card catalog-card" data-id="${product.id}">
                            <!-- Image Container -->
                            <div class="collection-image-wrapper">
                                <img
                                    src="${product.image}"
                                    alt="${escapeHtml(product.name)}"
                                    class="collection-image"
                                    loading="lazy"
                                />

                                <!-- Wishlist Button (Pojok Kanan Atas) -->
                                <button
                                    type="button"
                                    class="catalog-wishlist-btn ${isWishlisted ? 'is-active' : ''}"
                                    aria-label="Tambah ke favorit"
                                    title="${isWishlisted ? 'Hapus dari favorit' : 'Tambah ke favorit'}"
                                    onclick="toggleWishlist(${product.id}, event)"
                                >
                                    <svg class="collection-wishlist-icon" fill="${isWishlisted ? '#e11d48' : 'none'}" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </button>

                                <!-- Tombol Lihat Detail / Quick View (Slide up dari bawah) -->
                                <div class="catalog-quickview-overlay">
                                    <a
                                        href="#detail-${product.id}"
                                        class="catalog-quickview-btn"
                                        onclick="handleDetailClick('${escapeHtml(product.name)}', '${escapeHtml(product.modelCode)}', event)"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>

                            <!-- Product Information -->
                            <div class="collection-product-info">
                                <!-- Informasi Brand & Kode Dress dalam Satu Baris -->
                                <div class="collection-product-meta">
                                    <span class="catalog-brand-code" title="${escapeHtml(product.brand)} | ${escapeHtml(product.modelCode)}">
                                        <span class="catalog-brand-name">${escapeHtml(product.brand)}</span>
                                        <span class="catalog-brand-separator">|</span>
                                        <span class="catalog-model-code">${escapeHtml(product.modelCode)}</span>
                                    </span>
                                    <span class="collection-category">${escapeHtml(product.category)}</span>
                                </div>

                                <!-- Nama Dress -->
                                <h2 class="collection-product-name" title="${escapeHtml(product.name)}">
                                    ${escapeHtml(product.name)}
                                </h2>

                                <!-- Ukuran -->
                                <div class="collection-sizes">
                                    <span class="collection-size-label">Ukuran:</span>
                                    ${sizesHtml}
                                </div>

                                <!-- Harga -->
                                <div class="collection-product-footer">
                                    <div class="catalog-price-container">
                                        <p class="collection-price">
                                            Rp ${formatPrice(product.price)}
                                        </p>
                                        <span class="catalog-price-period">/hari</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }).join('');
            }

            // Wishlist Toggle
            function toggleWishlist(id, event) {
                event.stopPropagation();
                if (wishlistState.has(id)) {
                    wishlistState.delete(id);
                } else {
                    wishlistState.add(id);
                }
                renderCatalog();
            }

            // Lihat Detail Action
            function handleDetailClick(name, code, event) {
                event.preventDefault();
                alert(`Detail ${name} (${code}) akan tersedia pada tahap pengembangan rute detail dress berikutnya.`);
            }

            // Handler Filter Brand
            function toggleBrand(brand) {
                if (selectedBrands.has(brand)) {
                    selectedBrands.delete(brand);
                } else {
                    selectedBrands.add(brand);
                }
                renderCatalog();
            }

            // Handler Filter Kategori
            function setCategory(cat) {
                currentCategory = cat;
                updateUrlParams();
                renderCatalog();
            }

            // Handler Filter Kebutuhan Acara
            function toggleEvent(ev) {
                if (selectedEvents.has(ev)) {
                    selectedEvents.delete(ev);
                } else {
                    selectedEvents.add(ev);
                }
                renderCatalog();
            }

            // Handler Filter Gaya
            function toggleStyle(st) {
                if (selectedStyles.has(st)) {
                    selectedStyles.delete(st);
                } else {
                    selectedStyles.add(st);
                }
                renderCatalog();
            }

            // Handler Filter Karakteristik
            function toggleCharacteristic(ch) {
                if (selectedCharacteristics.has(ch)) {
                    selectedCharacteristics.delete(ch);
                } else {
                    selectedCharacteristics.add(ch);
                }
                renderCatalog();
            }

            // Handler Filter Ukuran
            function toggleSize(sz) {
                if (selectedSizes.has(sz)) {
                    selectedSizes.delete(sz);
                } else {
                    selectedSizes.add(sz);
                }
                renderCatalog();
            }

            // Handler Filter Warna
            function toggleColor(c) {
                if (selectedColors.has(c)) {
                    selectedColors.delete(c);
                } else {
                    selectedColors.add(c);
                }
                renderCatalog();
            }

            // Handler Input Harga
            function onPriceInputChange() {
                const errorEl = document.getElementById('price-validation-error');
                if (errorEl) errorEl.style.display = 'none';
            }

            function applyPriceFilter() {
                const minInput = document.getElementById('price-min-input');
                const maxInput = document.getElementById('price-max-input');
                const errorEl = document.getElementById('price-validation-error');

                const minVal = minInput && minInput.value !== '' ? parseInt(minInput.value, 10) : null;
                const maxVal = maxInput && maxInput.value !== '' ? parseInt(maxInput.value, 10) : null;

                if (minVal !== null && maxVal !== null && minVal > maxVal) {
                    if (errorEl) errorEl.style.display = 'block';
                    return;
                }

                if (errorEl) errorEl.style.display = 'none';
                priceMin = minVal;
                priceMax = maxVal;
                renderCatalog();
            }

            function clearPriceFilter() {
                priceMin = null;
                priceMax = null;
                const minInput = document.getElementById('price-min-input');
                const maxInput = document.getElementById('price-max-input');
                const errorEl = document.getElementById('price-validation-error');
                if (minInput) minInput.value = '';
                if (maxInput) maxInput.value = '';
                if (errorEl) errorEl.style.display = 'none';
                renderCatalog();
            }

            // Handler Dropdown Urutkan
            function handleSortChange(sortVal) {
                currentSort = sortVal;
                renderCatalog();
            }

            // Handler Pencarian Navbar
            function onNavbarSearchInput(val) {
                searchQuery = val;
                const desktopInput = document.getElementById('navbar-search-input');
                const mobileInput = document.getElementById('navbar-search-mobile-input');
                if (desktopInput && desktopInput.value !== val) desktopInput.value = val;
                if (mobileInput && mobileInput.value !== val) mobileInput.value = val;

                updateUrlParams();
                renderCatalog();
            }

            function submitNavbarSearch() {
                const desktopInput = document.getElementById('navbar-search-input');
                const mobileInput = document.getElementById('navbar-search-mobile-input');
                const val = (desktopInput ? desktopInput.value : '') || (mobileInput ? mobileInput.value : '');
                onNavbarSearchInput(val);
            }

            function clearSearch() {
                searchQuery = '';
                const desktopInput = document.getElementById('navbar-search-input');
                const mobileInput = document.getElementById('navbar-search-mobile-input');
                if (desktopInput) desktopInput.value = '';
                if (mobileInput) mobileInput.value = '';
                updateUrlParams();
                renderCatalog();
            }

            // Reset Semua Filter & Pencarian
            function resetAllFilters() {
                searchQuery = '';
                currentCategory = 'all';
                selectedBrands.clear();
                selectedEvents.clear();
                selectedStyles.clear();
                selectedCharacteristics.clear();
                selectedSizes.clear();
                selectedColors.clear();
                priceMin = null;
                priceMax = null;

                const minInput = document.getElementById('price-min-input');
                const maxInput = document.getElementById('price-max-input');
                const errorEl = document.getElementById('price-validation-error');
                if (minInput) minInput.value = '';
                if (maxInput) maxInput.value = '';
                if (errorEl) errorEl.style.display = 'none';

                const desktopInput = document.getElementById('navbar-search-input');
                const mobileInput = document.getElementById('navbar-search-mobile-input');
                if (desktopInput) desktopInput.value = '';
                if (mobileInput) mobileInput.value = '';

                updateUrlParams();
                renderCatalog();
            }

            // Mobile Menu Drawer Toggle
            function toggleMobileMenu() {
                const drawer = document.getElementById('mobile-menu-drawer');
                const btn = document.getElementById('mobile-menu-toggle');
                if (!drawer) return;
                const isOpen = drawer.style.display !== 'none';
                drawer.style.display = isOpen ? 'none' : 'block';
                btn.setAttribute('aria-expanded', !isOpen);

                const icon = document.getElementById('mobile-menu-icon');
                if (icon) {
                    if (!isOpen) {
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
                    } else {
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />';
                    }
                }
            }

            // Inisialisasi awal saat DOM siap
            document.addEventListener('DOMContentLoaded', () => {
                // Periksa query parameter URL jika ada misal ?search=... atau ?kategori=...
                const urlParams = new URLSearchParams(window.location.search);
                const qParam = urlParams.get('search');
                const catParam = urlParams.get('kategori');

                if (qParam) {
                    searchQuery = qParam;
                    const desktopInput = document.getElementById('navbar-search-input');
                    const mobileInput = document.getElementById('navbar-search-mobile-input');
                    if (desktopInput) desktopInput.value = qParam;
                    if (mobileInput) mobileInput.value = qParam;
                }

                if (catParam && (availableCategories.includes(catParam) || catParam === 'all')) {
                    currentCategory = catParam;
                }

                renderCatalog();
            });
        </script>
    </body>
</html>
