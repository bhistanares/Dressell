<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Katalog Dress &amp; Kebaya Eksklusif — Dressell</title>

        <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-dressell.png') }}">

        {{-- Tipografi Editorial: Cormorant Garamond (Serif) + Instrument Sans (Sans) --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,500i,600,600i|instrument-sans:400,500,600,700&display=swap">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/catalog.css') }}">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-[#FAF7F2] text-gray-900 min-h-screen antialiased">
        <!-- ==============================================================
             Navbar Dressell (TheNavbar.vue)
             ============================================================== -->
        @php
            $currentUser = Auth::guard('web')->user();
            $userPayload = $currentUser ? [
                'name' => $currentUser->name,
                'email' => $currentUser->email,
            ] : null;
        @endphp

        <div
            id="navbar-app"
            data-user="{{ json_encode($userPayload) }}"
            data-logout-url="{{ route('logout') }}"
            data-csrf="{{ csrf_token() }}"
        ></div>

        <!-- ==============================================================
             Backdrop Overlay untuk Filter Drawer dari Kanan
             ============================================================== -->
        <div id="catalog-drawer-backdrop" class="catalog-drawer-backdrop" onclick="closeFilterDrawer()" aria-hidden="true"></div>

        <!-- ==============================================================
             Area Konten Utama Katalog Dress
             ============================================================== -->
        <main class="catalog-page">
            <div class="catalog-container">

                <!-- 1. Header Katalog Editorial (Tanpa Label Atelier) -->
                <header class="catalog-header">
                    <h1 class="catalog-title">Katalog <em>Koleksi Dress</em></h1>
                    <p class="catalog-subtitle">
                        Temukan pilihan gaun dan kebaya eksklusif Dressell untuk setiap momen istimewa Anda, mulai dari resepsi pernikahan, wisuda, hingga acara formal.
                    </p>
                </header>

                <!-- 2. Controls Bar: Search Bar, Tombol Filter, Jumlah Produk, Pengurutan -->
                <div class="catalog-controls-bar">
                    <!-- Kiri: Search Bar & Tombol Filter Drawer -->
                    <div class="catalog-controls-left">
                        <!-- Search Bar -->
                        <div class="catalog-search-box">
                            <svg class="catalog-search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input
                                id="catalog-search-input"
                                type="text"
                                placeholder="Cari gaun, kode, brand, warna..."
                                class="catalog-search-input"
                                oninput="onSearchInput(this.value)"
                            />
                            <button
                                type="button"
                                id="catalog-search-clear"
                                class="catalog-search-clear-btn"
                                style="display: none;"
                                onclick="clearSearch()"
                                aria-label="Hapus pencarian"
                            >
                                &times;
                            </button>
                        </div>

                        <!-- Tombol Filter Drawer (Muncul di Semua Ukuran Layar) -->
                        <button
                            type="button"
                            id="catalog-filter-btn"
                            class="catalog-filter-btn"
                            onclick="openFilterDrawer()"
                            aria-expanded="false"
                            aria-controls="catalog-sidebar"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            <span>Filter</span>
                            <span id="active-filter-badge" class="catalog-filter-badge" style="display: none;">0</span>
                        </button>
                    </div>

                    <!-- Kanan: Informasi Jumlah Dress & Dropdown Pengurutan -->
                    <div class="catalog-controls-right">
                        <div class="catalog-count-info">
                            <span>Menampilkan <strong id="hint-count">0</strong> dari <strong id="hint-total">0</strong> gaun</span>
                        </div>

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

                <!-- 3. Active Chips Bar (Menampilkan filter aktif yang sudah diterapkan) -->
                <div id="catalog-active-bar" class="catalog-active-filters-bar" style="display: none;">
                    <div class="catalog-chips-container">
                        <span class="catalog-chips-label">Filter aktif:</span>
                        <div id="catalog-chips-list" class="catalog-chips-list">
                            <!-- Chips diisi dinamis oleh JavaScript -->
                        </div>
                        <button
                            type="button"
                            class="catalog-reset-all-btn"
                            onclick="resetAllFilters()"
                        >
                            Hapus Semua
                        </button>
                    </div>
                </div>

                <!-- 4. Product Grid Area (Terbuka Penuh Tanpa Sidebar Kiri Permanen) -->
                <section class="catalog-grid-section">
                    <div id="catalog-grid" class="catalog-product-grid collection-grid">
                        <!-- Rendered by JavaScript -->
                    </div>

                    <!-- Empty State -->
                    <div id="catalog-empty" class="catalog-empty-state" style="display: none;">
                        <div class="catalog-empty-icon">👗</div>
                        <h3 class="catalog-empty-title">Tidak Ada Gaun yang Cocok</h3>
                        <p class="catalog-empty-desc">
                            Coba sesuaikan kata kunci pencarian atau bersihkan filter untuk menemukan koleksi gaun impianmu.
                        </p>
                        <button
                            type="button"
                            class="catalog-empty-reset-btn"
                            onclick="resetAllFilters()"
                        >
                            Reset Filter Pencarian
                        </button>
                    </div>
                </section>

            </div>
        </main>

        <!-- ==============================================================
             5. Filter Drawer dari Sisi Kanan (Staged Filter with Apply & Reset)
             id="catalog-sidebar" dipertahankan untuk kompatibilitas pengujian
             ============================================================== -->
        <aside id="catalog-sidebar" class="catalog-filter-drawer" aria-label="Panel Filter Koleksi" role="dialog" aria-modal="true">
            <!-- Header Drawer -->
            <div class="catalog-drawer-header">
                <div class="catalog-drawer-title-wrapper">
                    <svg class="w-4 h-4 text-[#26221F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <h2 class="catalog-drawer-title">Filter Koleksi</h2>
                    <span id="drawer-staged-badge" class="catalog-drawer-badge" style="display: none;">0</span>
                </div>
                <button
                    type="button"
                    class="catalog-drawer-close"
                    onclick="closeFilterDrawer()"
                    aria-label="Tutup Panel Filter"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Body Drawer Scrollable (Semua Kategori Filter Dipertahankan 100%) -->
            <div class="catalog-drawer-body">

                <!-- Kelompok 1: Kategori -->
                <div class="catalog-filter-section">
                    <div class="catalog-filter-section-header">
                        <span class="catalog-filter-label">Kategori</span>
                    </div>
                    <div class="catalog-filter-options" id="category-filters">
                        <!-- Rendered dynamically -->
                    </div>
                </div>

                <!-- Kelompok 2: Brand -->
                <div class="catalog-filter-section">
                    <div class="catalog-filter-section-header">
                        <span class="catalog-filter-label">Brand</span>
                        <span class="catalog-filter-sublabel">(Multi-pilih)</span>
                    </div>
                    <div class="catalog-filter-options" id="brand-filters">
                        <!-- Rendered dynamically -->
                    </div>
                </div>

                <!-- Kelompok 3: Tipe & Kebutuhan Acara -->
                <div class="catalog-filter-section">
                    <div class="catalog-filter-section-header">
                        <span class="catalog-filter-label">Tipe &amp; Kebutuhan</span>
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
                        <!-- Rendered dynamically -->
                    </div>
                </div>

                <!-- Kelompok 6: Rentang Harga (per 4 hari) -->
                <div class="catalog-filter-section">
                    <div class="catalog-filter-section-header">
                        <span class="catalog-filter-label">Rentang Harga</span>
                        <span class="catalog-filter-sublabel">(nominal sewa)</span>
                    </div>
                    <div class="catalog-price-inputs">
                        <div class="catalog-price-field">
                            <span class="catalog-price-prefix">Rp</span>
                            <input
                                type="number"
                                id="price-min-input"
                                class="catalog-price-input"
                                placeholder="Min"
                                min="0"
                                step="10000"
                                oninput="onStagedPriceChange()"
                            />
                        </div>
                        <span class="catalog-price-dash">—</span>
                        <div class="catalog-price-field">
                            <span class="catalog-price-prefix">Rp</span>
                            <input
                                type="number"
                                id="price-max-input"
                                class="catalog-price-input"
                                placeholder="Maks"
                                min="0"
                                step="10000"
                                oninput="onStagedPriceChange()"
                            />
                        </div>
                    </div>
                    <span id="price-validation-error" class="catalog-price-error" style="display: none;">
                        Harga minimum tidak boleh lebih besar dari harga maksimum.
                    </span>
                </div>

            </div>

            <!-- Footer Drawer Action Buttons: Terapkan Filter & Reset -->
            <div class="catalog-drawer-footer">
                <button
                    type="button"
                    class="catalog-drawer-reset-btn"
                    onclick="resetDrawerFilters()"
                >
                    Reset
                </button>
                <button
                    type="button"
                    class="catalog-drawer-apply-btn"
                    onclick="applyDrawerFilters()"
                >
                    Terapkan Filter
                </button>
            </div>
        </aside>

        <!-- ==============================================================
             Footer Dressell
             ============================================================== -->
        <footer class="footer">
            <div class="footer-main">
                <div class="footer-grid">
                    <!-- Brand Column -->
                    <div class="footer-brand">
                        <a href="/" class="footer-logo" aria-label="Dressell Beranda">
                            <img
                                src="{{ asset('assets/img/logo-dressell.png') }}"
                                alt="Dressell Logo"
                                class="footer-logo-img"
                            />
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
                            <li><a href="#" class="footer-link">Blog &amp; Artikel</a></li>
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
                            <li><a href="#" class="footer-link">Syarat &amp; Ketentuan</a></li>
                        </ul>
                    </div>

                    <!-- Information Links -->
                    <div class="footer-column">
                        <h3 class="footer-heading">Informasi</h3>
                        <ul class="footer-link-list">
                            <li><a href="#" class="footer-link">Lokasi Butik</a></li>
                            <li><a href="#fitting" class="footer-link">Fitting Appointment</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-bottom-container">
                    <p class="footer-copyright">
                        &copy; {{ date('Y') }} Dressell. Hak Cipta Dilindungi Undang-Undang.
                    </p>
                    <div class="footer-legal-links">
                        <a href="#" class="footer-legal-link">Syarat &amp; Ketentuan</a>
                        <span class="footer-dot">&bull;</span>
                        <a href="#" class="footer-legal-link">Kebijakan Privasi</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- ==============================================================
             Logika Interaktif Katalog Dressell (Staged Filter Drawer)
             ============================================================== -->
        <script>
            // Data otentikasi Customer aktif (jika ada)
            const currentCustomer = @json($userPayload);

            // Data katalog produk dress Dressell lengkap dengan metadata Brand, Tipe & Kebutuhan, Ukuran, Warna, dan Harga
            // Menggunakan aset foto gaun nyata pada public/assets/img/dressell/
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
                    image: '/assets/img/dressell/drs-001.jpg',
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
                    image: '/assets/img/dressell/kby-012.jpg',
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
                    image: '/assets/img/dressell/gwn-003.jpg',
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
                    rentalCount: 29,
                    createdAt: '2026-10-01',
                    image: '/assets/img/dressell/btk-021.jpg',
                },
                {
                    id: 5,
                    modelCode: 'CSL-008',
                    brand: 'Lumiere Studio',
                    name: 'Dress Casual Linen Putih',
                    category: 'Dress Casual',
                    events: ['Acara kasual', 'Photoshoot'],
                    style: 'Minimalis',
                    characteristics: [],
                    color: 'Putih',
                    colorHex: '#ffffff',
                    price: 85000,
                    sizes: ['XS', 'S', 'M'],
                    available: true,
                    rentalCount: 64,
                    createdAt: '2026-10-05',
                    image: '/assets/img/dressell/csl-008.jpg',
                },
                {
                    id: 6,
                    modelCode: 'MXD-015',
                    brand: 'Glamour House',
                    name: 'Maxi Dress Floral Garden',
                    category: 'Maxi Dress',
                    events: ['Pesta', 'Photoshoot', 'Acara kasual'],
                    style: 'Korean style',
                    characteristics: ['Hijab-friendly'],
                    color: 'Sage Green',
                    colorHex: '#15803d',
                    price: 110000,
                    sizes: ['M', 'L'],
                    available: true,
                    rentalCount: 48,
                    createdAt: '2026-10-12',
                    image: '/assets/img/dressell/mxd-015.jpg',
                },
                {
                    id: 7,
                    modelCode: 'FRM-009',
                    brand: 'Syaza Atelier',
                    name: 'Gaun Formal Velvet Navy',
                    category: 'Gaun Formal',
                    events: ['Acara formal', 'Pesta'],
                    style: 'Glamor',
                    characteristics: ['Hijab-friendly'],
                    color: 'Navy',
                    colorHex: '#1e3a8a',
                    price: 185000,
                    sizes: ['S', 'M', 'L'],
                    available: false,
                    rentalCount: 22,
                    createdAt: '2026-09-28',
                    image: '/assets/img/dressell/frm-009.jpg',
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
                    image: '/assets/img/dressell/drs-017.jpg',
                },
            ];

            // Master data pilihan filter (WAJIB DIPERTAHANKAN)
            const availableCategories = ['Dress Pesta', 'Kebaya Modern', 'Gaun Pernikahan', 'Batik & Tenun', 'Dress Casual', 'Maxi Dress', 'Gaun Formal'];
            const availableBrands = ['Syaza Atelier', 'Arunika Kebaya', 'Batik Danar', 'Lumiere Studio', 'Glamour House'];
            const availableEvents = ['Pesta', 'Pernikahan', 'Ulang tahun', 'Wisuda', 'Acara formal', 'Acara kasual'];
            const availableStyles = ['Korean style', 'Japanese style', 'Modern', 'Tradisional'];
            const availableCharacteristics = ['Hijab-friendly', 'Busui-friendly'];
            const availableSizes = ['XS', 'S', 'M', 'L', 'XL'];
            const availableColors = [
                { name: 'Rose', hex: '#f43f5e' },
                { name: 'Merah Marun', hex: '#991b1b' },
                { name: 'Putih', hex: '#ffffff', hasBorder: true },
                { name: 'Cokelat', hex: '#78350f' },
                { name: 'Sage Green', hex: '#15803d' },
                { name: 'Navy', hex: '#1e3a8a' },
                { name: 'Merah', hex: '#dc2626' }
            ];

            // ==============================================================
            // State Filter Aktif (Applied State)
            // ==============================================================
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
            let wishlistState = new Set();

            // ==============================================================
            // State Filter Sementara / Draft di Drawer (Staged State)
            // Pilihan sementara sebelum pengguna menekan 'Terapkan Filter'
            // ==============================================================
            let stagedCategory = 'all';
            let stagedBrands = new Set();
            let stagedEvents = new Set();
            let stagedStyles = new Set();
            let stagedCharacteristics = new Set();
            let stagedSizes = new Set();
            let stagedColors = new Set();
            let stagedPriceMin = null;
            let stagedPriceMax = null;

            function formatPrice(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }

            function escapeHtml(str) {
                if (!str) return '';
                return String(str)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }

            // ==============================================================
            // Mekanisme Filter Drawer dari Sisi Kanan
            // ==============================================================
            function openFilterDrawer() {
                const drawer = document.getElementById('catalog-sidebar');
                const backdrop = document.getElementById('catalog-drawer-backdrop');
                const btn = document.getElementById('catalog-filter-btn');

                // Salin filter aktif saat ini ke dalam staged filter (pilihan sementara)
                stagedCategory = currentCategory;
                stagedBrands = new Set(selectedBrands);
                stagedEvents = new Set(selectedEvents);
                stagedStyles = new Set(selectedStyles);
                stagedCharacteristics = new Set(selectedCharacteristics);
                stagedSizes = new Set(selectedSizes);
                stagedColors = new Set(selectedColors);
                stagedPriceMin = priceMin;
                stagedPriceMax = priceMax;

                // Sinkronkan input harga di dalam drawer
                const minInput = document.getElementById('price-min-input');
                const maxInput = document.getElementById('price-max-input');
                const errorEl = document.getElementById('price-validation-error');
                if (minInput) minInput.value = stagedPriceMin !== null ? stagedPriceMin : '';
                if (maxInput) maxInput.value = stagedPriceMax !== null ? stagedPriceMax : '';
                if (errorEl) errorEl.style.display = 'none';

                // Render tampilan pill di dalam drawer berdasarkan staged state
                renderStagedFilterControls();

                if (drawer) drawer.classList.add('is-open');
                if (backdrop) backdrop.classList.add('is-open');
                if (btn) btn.setAttribute('aria-expanded', 'true');
                document.body.classList.add('drawer-open');
            }

            function closeFilterDrawer() {
                const drawer = document.getElementById('catalog-sidebar');
                const backdrop = document.getElementById('catalog-drawer-backdrop');
                const btn = document.getElementById('catalog-filter-btn');

                if (drawer) drawer.classList.remove('is-open');
                if (backdrop) backdrop.classList.remove('is-open');
                if (btn) btn.setAttribute('aria-expanded', 'false');
                document.body.classList.remove('drawer-open');
                // Pilihan staged yang belum diterapkan otomatis diabaikan karena tidak di-commit
            }

            // Keyboard ESC handler untuk menutup drawer
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    closeFilterDrawer();
                }
            });

            // Menghitung jumlah filter aktif yang diterapkan
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

            // Menghitung jumlah filter sementara di drawer
            function getStagedFilterCount() {
                let count = 0;
                if (stagedCategory !== 'all') count++;
                count += stagedBrands.size;
                count += stagedEvents.size;
                count += stagedStyles.size;
                count += stagedCharacteristics.size;
                count += stagedSizes.size;
                count += stagedColors.size;
                if (stagedPriceMin !== null || stagedPriceMax !== null) count++;
                return count;
            }

            // ==============================================================
            // Render Pilihan Staged Filter di Dalam Drawer (Draft)
            // ==============================================================
            function renderStagedFilterControls() {
                // Update Badge di Drawer Header
                const stagedBadge = document.getElementById('drawer-staged-badge');
                const count = getStagedFilterCount();
                if (stagedBadge) {
                    if (count > 0) {
                        stagedBadge.textContent = count;
                        stagedBadge.style.display = 'inline-flex';
                    } else {
                        stagedBadge.style.display = 'none';
                    }
                }

                // 1. Kategori
                const categoryContainer = document.getElementById('category-filters');
                if (categoryContainer) {
                    let html = `<button type="button" class="catalog-pill-btn ${stagedCategory === 'all' ? 'active' : ''}" onclick="toggleStagedCategory('all')">Semua</button>`;
                    html += availableCategories.map(cat => {
                        const active = stagedCategory === cat ? 'active' : '';
                        return `<button type="button" class="catalog-pill-btn ${active}" onclick="toggleStagedCategory('${escapeHtml(cat)}')">${escapeHtml(cat)}</button>`;
                    }).join('');
                    categoryContainer.innerHTML = html;
                }

                // 2. Brand (Multi-pilih)
                const brandContainer = document.getElementById('brand-filters');
                if (brandContainer) {
                    brandContainer.innerHTML = availableBrands.map(brand => {
                        const active = stagedBrands.has(brand) ? 'active' : '';
                        return `<button type="button" class="catalog-pill-btn ${active}" onclick="toggleStagedBrand('${escapeHtml(brand)}')">${escapeHtml(brand)}</button>`;
                    }).join('');
                }

                // 3. Tipe & Kebutuhan Acara
                const eventContainer = document.getElementById('event-filters');
                if (eventContainer) {
                    eventContainer.innerHTML = availableEvents.map(ev => {
                        const active = stagedEvents.has(ev) ? 'active' : '';
                        return `<button type="button" class="catalog-pill-btn ${active}" onclick="toggleStagedEvent('${escapeHtml(ev)}')">${escapeHtml(ev)}</button>`;
                    }).join('');
                }

                // Gaya Dress
                const styleContainer = document.getElementById('style-filters');
                if (styleContainer) {
                    styleContainer.innerHTML = availableStyles.map(st => {
                        const active = stagedStyles.has(st) ? 'active' : '';
                        return `<button type="button" class="catalog-pill-btn ${active}" onclick="toggleStagedStyle('${escapeHtml(st)}')">${escapeHtml(st)}</button>`;
                    }).join('');
                }

                // Karakteristik
                const charContainer = document.getElementById('characteristic-filters');
                if (charContainer) {
                    charContainer.innerHTML = availableCharacteristics.map(ch => {
                        const active = stagedCharacteristics.has(ch) ? 'active' : '';
                        return `<button type="button" class="catalog-pill-btn ${active}" onclick="toggleStagedCharacteristic('${escapeHtml(ch)}')">${escapeHtml(ch)}</button>`;
                    }).join('');
                }

                // 4. Ukuran
                const sizeContainer = document.getElementById('size-filters');
                if (sizeContainer) {
                    sizeContainer.innerHTML = availableSizes.map(sz => {
                        const active = stagedSizes.has(sz) ? 'active' : '';
                        return `<button type="button" class="catalog-pill-btn catalog-pill-size ${active}" onclick="toggleStagedSize('${escapeHtml(sz)}')">${escapeHtml(sz)}</button>`;
                    }).join('');
                }

                // 5. Warna
                const colorContainer = document.getElementById('color-filters');
                if (colorContainer) {
                    colorContainer.innerHTML = availableColors.map(c => {
                        const active = stagedColors.has(c.name) ? 'active' : '';
                        const borderClass = c.hasBorder ? 'has-border' : '';
                        return `
                            <button type="button" class="catalog-pill-btn ${active}" onclick="toggleStagedColor('${escapeHtml(c.name)}')">
                                <span class="catalog-color-dot ${borderClass}" style="background-color: ${c.hex};"></span>
                                <span>${escapeHtml(c.name)}</span>
                            </button>
                        `;
                    }).join('');
                }
            }

            // Staged Toggle Handlers (Hanya mengubah state sementara di dalam drawer)
            function toggleStagedCategory(cat) {
                stagedCategory = cat;
                renderStagedFilterControls();
            }

            function toggleStagedBrand(brand) {
                if (stagedBrands.has(brand)) {
                    stagedBrands.delete(brand);
                } else {
                    stagedBrands.add(brand);
                }
                renderStagedFilterControls();
            }

            function toggleStagedEvent(ev) {
                if (stagedEvents.has(ev)) {
                    stagedEvents.delete(ev);
                } else {
                    stagedEvents.add(ev);
                }
                renderStagedFilterControls();
            }

            function toggleStagedStyle(st) {
                if (stagedStyles.has(st)) {
                    stagedStyles.delete(st);
                } else {
                    stagedStyles.add(st);
                }
                renderStagedFilterControls();
            }

            function toggleStagedCharacteristic(ch) {
                if (stagedCharacteristics.has(ch)) {
                    stagedCharacteristics.delete(ch);
                } else {
                    stagedCharacteristics.add(ch);
                }
                renderStagedFilterControls();
            }

            function toggleStagedSize(sz) {
                if (stagedSizes.has(sz)) {
                    stagedSizes.delete(sz);
                } else {
                    stagedSizes.add(sz);
                }
                renderStagedFilterControls();
            }

            function toggleStagedColor(col) {
                if (stagedColors.has(col)) {
                    stagedColors.delete(col);
                } else {
                    stagedColors.add(col);
                }
                renderStagedFilterControls();
            }

            function onStagedPriceChange() {
                const errorEl = document.getElementById('price-validation-error');
                if (errorEl) errorEl.style.display = 'none';
            }

            // ==============================================================
            // Tombol "Terapkan Filter" & "Reset" di Drawer
            // ==============================================================
            function applyDrawerFilters() {
                const minInput = document.getElementById('price-min-input');
                const maxInput = document.getElementById('price-max-input');
                const errorEl = document.getElementById('price-validation-error');

                const minVal = minInput && minInput.value !== '' ? parseFloat(minInput.value) : null;
                const maxVal = maxInput && maxInput.value !== '' ? parseFloat(maxInput.value) : null;

                if (minVal !== null && maxVal !== null && minVal > maxVal) {
                    if (errorEl) errorEl.style.display = 'block';
                    return;
                }

                if (errorEl) errorEl.style.display = 'none';
                stagedPriceMin = minVal;
                stagedPriceMax = maxVal;

                // Terapkan seluruh pilihan sementara ke filter aktif
                currentCategory = stagedCategory;
                selectedBrands = new Set(stagedBrands);
                selectedEvents = new Set(stagedEvents);
                selectedStyles = new Set(stagedStyles);
                selectedCharacteristics = new Set(stagedCharacteristics);
                selectedSizes = new Set(stagedSizes);
                selectedColors = new Set(stagedColors);
                priceMin = stagedPriceMin;
                priceMax = stagedPriceMax;

                // Tutup panel drawer dan terapkan ke tampilan produk
                closeFilterDrawer();
                updateUrlParams();
                renderCatalog();
            }

            function resetDrawerFilters() {
                // Reset state sementara dan filter aktif sekaligus
                stagedCategory = 'all';
                stagedBrands.clear();
                stagedEvents.clear();
                stagedStyles.clear();
                stagedCharacteristics.clear();
                stagedSizes.clear();
                stagedColors.clear();
                stagedPriceMin = null;
                stagedPriceMax = null;

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

                renderStagedFilterControls();
                closeFilterDrawer();
                updateUrlParams();
                renderCatalog();
            }

            // Perbarui URL dengan parameter pencarian / kategori
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

            // Render Chip Filter Aktif
            function renderActiveChips() {
                const activeBar = document.getElementById('catalog-active-bar');
                const chipsList = document.getElementById('catalog-chips-list');
                const badge = document.getElementById('active-filter-badge');

                const activeCount = getActiveFilterCount();
                const hasSearch = searchQuery.trim().length > 0;

                // Update badge pada tombol filter utama
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
                            <button type="button" class="catalog-chip-remove" onclick="removeActiveCategory()" aria-label="Hapus filter kategori">&times;</button>
                        </span>
                    `);
                }

                // Chip Brand
                selectedBrands.forEach(b => {
                    chips.push(`
                        <span class="catalog-chip">
                            <span>Brand: ${escapeHtml(b)}</span>
                            <button type="button" class="catalog-chip-remove" onclick="removeActiveBrand('${escapeHtml(b)}')" aria-label="Hapus filter brand">&times;</button>
                        </span>
                    `);
                });

                // Chip Acara
                selectedEvents.forEach(ev => {
                    chips.push(`
                        <span class="catalog-chip">
                            <span>Acara: ${escapeHtml(ev)}</span>
                            <button type="button" class="catalog-chip-remove" onclick="removeActiveEvent('${escapeHtml(ev)}')" aria-label="Hapus filter acara">&times;</button>
                        </span>
                    `);
                });

                // Chip Gaya
                selectedStyles.forEach(st => {
                    chips.push(`
                        <span class="catalog-chip">
                            <span>Gaya: ${escapeHtml(st)}</span>
                            <button type="button" class="catalog-chip-remove" onclick="removeActiveStyle('${escapeHtml(st)}')" aria-label="Hapus filter gaya">&times;</button>
                        </span>
                    `);
                });

                // Chip Karakteristik
                selectedCharacteristics.forEach(ch => {
                    chips.push(`
                        <span class="catalog-chip">
                            <span>${escapeHtml(ch)}</span>
                            <button type="button" class="catalog-chip-remove" onclick="removeActiveCharacteristic('${escapeHtml(ch)}')" aria-label="Hapus filter karakteristik">&times;</button>
                        </span>
                    `);
                });

                // Chip Ukuran
                selectedSizes.forEach(sz => {
                    chips.push(`
                        <span class="catalog-chip">
                            <span>Ukuran: ${escapeHtml(sz)}</span>
                            <button type="button" class="catalog-chip-remove" onclick="removeActiveSize('${escapeHtml(sz)}')" aria-label="Hapus filter ukuran">&times;</button>
                        </span>
                    `);
                });

                // Chip Warna
                selectedColors.forEach(c => {
                    chips.push(`
                        <span class="catalog-chip">
                            <span>Warna: ${escapeHtml(c)}</span>
                            <button type="button" class="catalog-chip-remove" onclick="removeActiveColor('${escapeHtml(c)}')" aria-label="Hapus filter warna">&times;</button>
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
                            <button type="button" class="catalog-chip-remove" onclick="removeActivePrice()" aria-label="Hapus filter harga">&times;</button>
                        </span>
                    `);
                }

                if (chipsList) {
                    chipsList.innerHTML = chips.join('');
                }
            }

            // Quick Chip Removers
            function removeActiveCategory() {
                currentCategory = 'all';
                stagedCategory = 'all';
                updateUrlParams();
                renderCatalog();
            }

            function removeActiveBrand(b) {
                selectedBrands.delete(b);
                stagedBrands.delete(b);
                renderCatalog();
            }

            function removeActiveEvent(ev) {
                selectedEvents.delete(ev);
                stagedEvents.delete(ev);
                renderCatalog();
            }

            function removeActiveStyle(st) {
                selectedStyles.delete(st);
                stagedStyles.delete(st);
                renderCatalog();
            }

            function removeActiveCharacteristic(ch) {
                selectedCharacteristics.delete(ch);
                stagedCharacteristics.delete(ch);
                renderCatalog();
            }

            function removeActiveSize(sz) {
                selectedSizes.delete(sz);
                stagedSizes.delete(sz);
                renderCatalog();
            }

            function removeActiveColor(c) {
                selectedColors.delete(c);
                stagedColors.delete(c);
                renderCatalog();
            }

            function removeActivePrice() {
                priceMin = null;
                priceMax = null;
                stagedPriceMin = null;
                stagedPriceMax = null;
                const minInput = document.getElementById('price-min-input');
                const maxInput = document.getElementById('price-max-input');
                if (minInput) minInput.value = '';
                if (maxInput) maxInput.value = '';
                renderCatalog();
            }

            // ==============================================================
            // Logika Penyaringan Produk (Berdasarkan Applied State)
            // ==============================================================
            function getFilteredProducts() {
                return allProducts.filter(item => {
                    // Filter Pencarian
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

                    // Filter Karakteristik (Multi-pilih)
                    if (selectedCharacteristics.size > 0) {
                        const matchChar = item.characteristics.some(ch => selectedCharacteristics.has(ch));
                        if (!matchChar) return false;
                    }

                    // Filter Ukuran (Multi-pilih)
                    if (selectedSizes.size > 0) {
                        const matchSize = item.sizes.some(s => selectedSizes.has(s));
                        if (!matchSize) return false;
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
                        return list.sort((a, b) => (b.rentalCount || 0) - (a.rentalCount || 0));
                    case 'newest':
                        return list.sort((a, b) => new Date(b.createdAt).getTime() - new Date(a.createdAt).getTime());
                    case 'price-asc':
                        return list.sort((a, b) => a.price - b.price);
                    case 'price-desc':
                        return list.sort((a, b) => b.price - a.price);
                    default:
                        return list;
                }
            }

            // ==============================================================
            // Render Halaman Katalog & Card Dress
            // Susunan Informasi Card:
            // Baris 1: Kode dress di kiri, Kategori dress di kanan
            // Baris 2: Nama dress
            // Baris berikutnya: Ukuran yang tersedia
            // Bagian harga: Nominal sewa / 4 hari
            // Hapus badge ketersediaan & tombol Sewa
            // ==============================================================
            function renderCatalog() {
                const grid = document.getElementById('catalog-grid');
                const emptyState = document.getElementById('catalog-empty');
                const hintCount = document.getElementById('hint-count');
                const hintTotal = document.getElementById('hint-total');

                renderActiveChips();

                // Dapatkan hasil terfilter dan terurut
                const filtered = getFilteredProducts();
                const sorted = sortProducts(filtered);

                if (hintCount) hintCount.textContent = sorted.length;
                if (hintTotal) hintTotal.textContent = allProducts.length;

                // Tampilkan Empty State bila tidak ada produk
                if (sorted.length === 0) {
                    grid.innerHTML = '';
                    emptyState.style.display = 'flex';
                    return;
                }

                emptyState.style.display = 'none';

                // Buat kartu dress sesuai format baru
                grid.innerHTML = sorted.map(product => {
                    const isWishlisted = wishlistState.has(product.id);
                    const sizesHtml = product.sizes.map(s => `<span class="collection-size">${escapeHtml(s)}</span>`).join('');

                    return `
                        <div class="collection-card catalog-card" data-id="${product.id}" onclick="handleCardClick(${product.id}, event)">
                            <!-- Image Container -->
                            <div class="collection-image-wrapper">
                                <img
                                    src="${product.image}"
                                    alt="${escapeHtml(product.name)}"
                                    class="collection-image"
                                    loading="lazy"
                                />

                                <!-- Wishlist Button: Hanya untuk Customer yang Login (Muncul saat Hover Desktop, Tersedia di Mobile) -->
                                ${currentCustomer ? `
                                    <button
                                        type="button"
                                        class="catalog-wishlist-btn ${isWishlisted ? 'is-active' : ''}"
                                        onclick="toggleWishlist(${product.id}, event)"
                                        aria-label="Simpan ${escapeHtml(product.name)} ke favorit"
                                        title="${isWishlisted ? 'Hapus dari favorit' : 'Tambah ke favorit'}"
                                    >
                                        <svg class="collection-wishlist-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                ` : ''}

                                <!-- Tombol Lihat Detail / Quick View (Muncul saat Hover Desktop) -->
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
                                        <span>Lihat Detail</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Product Info: Susunan Konsisten dengan Card Dashboard Customer -->
                            <div class="collection-product-info">
                                <!-- Baris Pertama: Kode di Kiri, Kategori di Kanan -->
                                <div class="collection-product-meta">
                                    <span class="collection-model-code">${escapeHtml(product.modelCode)}</span>
                                    <span class="collection-category">${escapeHtml(product.category.toUpperCase())}</span>
                                </div>

                                <!-- Baris Kedua: Nama Dress -->
                                <h3 class="collection-product-name" title="${escapeHtml(product.name)}">
                                    ${escapeHtml(product.name)}
                                </h3>

                                <!-- Baris Berikutnya: Informasi Ukuran yang Tersedia -->
                                <div class="collection-sizes">
                                    <span class="collection-size-label">Ukuran:</span>
                                    ${sizesHtml}
                                </div>

                                <!-- Bagian Harga: Nominal sewa per 4 hari (Tombol Sewa Dihapus) -->
                                <div class="collection-product-footer">
                                    <div class="catalog-price-container">
                                        <p class="collection-price">
                                            Rp ${formatPrice(product.price)}
                                        </p>
                                        <span class="catalog-price-period">/ 4 hari</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }).join('');
            }

            // Card Click Handler (Memungkinkan ketukan pada card di mobile membuka detail gaun)
            function handleCardClick(id, event) {
                // Abaikan jika klik terjadi pada tombol wishlist atau quickview button
                if (event.target.closest('.catalog-wishlist-btn') || event.target.closest('.catalog-quickview-btn')) {
                    return;
                }
                const product = allProducts.find(p => p.id === id);
                if (product) {
                    handleDetailClick(product.name, product.modelCode, event);
                }
            }

            // Wishlist Toggle
            function toggleWishlist(id, event) {
                if (event) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                if (wishlistState.has(id)) {
                    wishlistState.delete(id);
                } else {
                    wishlistState.add(id);
                }
                renderCatalog();
            }

            function handleDetailClick(name, code, event) {
                if (event) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                alert(`Detail ${name} (${code}) siap diakses.`);
            }

            // Handler Dropdown Urutkan
            function handleSortChange(sortVal) {
                currentSort = sortVal;
                renderCatalog();
            }

            // Handler Pencarian
            function onSearchInput(val) {
                searchQuery = val;
                const clearBtn = document.getElementById('catalog-search-clear');
                if (clearBtn) {
                    clearBtn.style.display = val.trim().length > 0 ? 'inline-flex' : 'none';
                }
                updateUrlParams();
                renderCatalog();
            }

            function clearSearch() {
                searchQuery = '';
                const searchInput = document.getElementById('catalog-search-input');
                const clearBtn = document.getElementById('catalog-search-clear');
                if (searchInput) searchInput.value = '';
                if (clearBtn) clearBtn.style.display = 'none';
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

                stagedCategory = 'all';
                stagedBrands.clear();
                stagedEvents.clear();
                stagedStyles.clear();
                stagedCharacteristics.clear();
                stagedSizes.clear();
                stagedColors.clear();
                stagedPriceMin = null;
                stagedPriceMax = null;

                const searchInput = document.getElementById('catalog-search-input');
                const clearBtn = document.getElementById('catalog-search-clear');
                if (searchInput) searchInput.value = '';
                if (clearBtn) clearBtn.style.display = 'none';

                const minInput = document.getElementById('price-min-input');
                const maxInput = document.getElementById('price-max-input');
                const errorEl = document.getElementById('price-validation-error');
                if (minInput) minInput.value = '';
                if (maxInput) maxInput.value = '';
                if (errorEl) errorEl.style.display = 'none';

                closeFilterDrawer();
                updateUrlParams();
                renderCatalog();
            }

            // Inisialisasi awal saat DOM siap
            document.addEventListener('DOMContentLoaded', () => {
                const urlParams = new URLSearchParams(window.location.search);
                const qParam = urlParams.get('search');
                const catParam = urlParams.get('kategori');

                if (qParam) {
                    searchQuery = qParam;
                    const searchInput = document.getElementById('catalog-search-input');
                    const clearBtn = document.getElementById('catalog-search-clear');
                    if (searchInput) searchInput.value = qParam;
                    if (clearBtn) clearBtn.style.display = 'inline-flex';
                }

                if (catParam && (availableCategories.includes(catParam) || catParam === 'all')) {
                    currentCategory = catParam;
                }

                renderCatalog();
            });
        </script>
    </body>
</html>
