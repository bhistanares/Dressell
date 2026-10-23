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
                        <form id="navbar-search-form" onsubmit="event.preventDefault(); syncNavbarSearch();" class="navbar-search">
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
                        <input
                            type="text"
                            placeholder="Cari dress..."
                            class="navbar-search-input"
                            style="width: 100%;"
                            oninput="onNavbarSearchInput(this.value)"
                        />
                        <button
                            type="button"
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

                <!-- Header Katalog -->
                <div class="catalog-header">
                    <nav class="catalog-breadcrumb" aria-label="Breadcrumb">
                        <a href="/">Beranda</a>
                        <span class="catalog-breadcrumb-separator">/</span>
                        <span class="text-gray-900 font-medium">Katalog</span>
                    </nav>

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

                <!-- Kontrol Pencarian & Filter -->
                <div class="catalog-controls">
                    <!-- Input Pencarian -->
                    <div class="catalog-search-wrapper">
                        <svg class="catalog-search-icon-left" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input
                            id="catalog-search-input"
                            type="text"
                            placeholder="Cari dress berdasarkan nama, kode model (misal: DRS-001), atau kategori..."
                            class="catalog-search-input"
                            oninput="handleSearch(this.value)"
                        />
                        <button
                            id="catalog-search-clear-btn"
                            type="button"
                            class="catalog-search-clear"
                            onclick="clearSearch()"
                            style="display: none;"
                            aria-label="Hapus pencarian"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Filter Kategori & Ukuran -->
                    <div class="catalog-filters">
                        <!-- Kategori Filter -->
                        <div class="catalog-filter-group">
                            <span class="catalog-filter-label">Kategori:</span>
                            <div class="catalog-filter-options" id="category-filters">
                                <button type="button" class="catalog-pill-btn active" onclick="setCategory('all')">Semua</button>
                                <button type="button" class="catalog-pill-btn" onclick="setCategory('Dress Pesta')">Dress Pesta</button>
                                <button type="button" class="catalog-pill-btn" onclick="setCategory('Kebaya Modern')">Kebaya Modern</button>
                                <button type="button" class="catalog-pill-btn" onclick="setCategory('Gaun Pernikahan')">Gaun Pernikahan</button>
                                <button type="button" class="catalog-pill-btn" onclick="setCategory('Batik & Tenun')">Batik & Tenun</button>
                                <button type="button" class="catalog-pill-btn" onclick="setCategory('Dress Casual')">Dress Casual</button>
                                <button type="button" class="catalog-pill-btn" onclick="setCategory('Maxi Dress')">Maxi Dress</button>
                                <button type="button" class="catalog-pill-btn" onclick="setCategory('Gaun Formal')">Gaun Formal</button>
                            </div>
                        </div>

                        <!-- Ukuran Filter -->
                        <div class="catalog-filter-group">
                            <span class="catalog-filter-label">Ukuran:</span>
                            <div class="catalog-filter-options" id="size-filters">
                                <button type="button" class="catalog-pill-btn catalog-pill-size active" onclick="setSize('all')">Semua</button>
                                <button type="button" class="catalog-pill-btn catalog-pill-size" onclick="setSize('XS')">XS</button>
                                <button type="button" class="catalog-pill-btn catalog-pill-size" onclick="setSize('S')">S</button>
                                <button type="button" class="catalog-pill-btn catalog-pill-size" onclick="setSize('M')">M</button>
                                <button type="button" class="catalog-pill-btn catalog-pill-size" onclick="setSize('L')">L</button>
                                <button type="button" class="catalog-pill-btn catalog-pill-size" onclick="setSize('XL')">XL</button>
                            </div>
                        </div>
                    </div>

                    <!-- Reset Bar jika ada filter aktif -->
                    <div id="catalog-active-bar" class="catalog-active-filters-bar" style="display: none;">
                        <span id="catalog-filter-status" class="text-gray-500">Filter aktif diterapkan</span>
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
             Logika Interaksi Frontend Katalog (Pencarian, Filter, Wishlist)
             ============================================================== -->
        <script>
            // Data produk dress Dressell yang sudah tersedia pada sistem
            const allProducts = [
                {
                    id: 1,
                    modelCode: 'DRS-001',
                    name: 'Gaun Pesta Elegan Mawar',
                    category: 'Dress Pesta',
                    price: 150000,
                    sizes: ['S', 'M', 'L'],
                    available: true,
                    image: 'https://picsum.photos/seed/prod-1/400/533',
                },
                {
                    id: 2,
                    modelCode: 'KBY-012',
                    name: 'Kebaya Modern Songket',
                    category: 'Kebaya Modern',
                    price: 200000,
                    sizes: ['M', 'L', 'XL'],
                    available: true,
                    image: 'https://picsum.photos/seed/prod-2/400/533',
                },
                {
                    id: 3,
                    modelCode: 'GWN-003',
                    name: 'Gaun Pengantin Aurora',
                    category: 'Gaun Pernikahan',
                    price: 450000,
                    sizes: ['S', 'M'],
                    available: true,
                    image: 'https://picsum.photos/seed/prod-3/400/533',
                },
                {
                    id: 4,
                    modelCode: 'BTK-021',
                    name: 'Midi Dress Batik Parang',
                    category: 'Batik & Tenun',
                    price: 120000,
                    sizes: ['S', 'M', 'L', 'XL'],
                    available: true,
                    image: 'https://picsum.photos/seed/prod-4/400/533',
                },
                {
                    id: 5,
                    modelCode: 'CSL-008',
                    name: 'Dress Casual Linen Putih',
                    category: 'Dress Casual',
                    price: 85000,
                    sizes: ['XS', 'S', 'M'],
                    available: true,
                    image: 'https://picsum.photos/seed/prod-5/400/533',
                },
                {
                    id: 6,
                    modelCode: 'MXD-015',
                    name: 'Maxi Dress Floral Garden',
                    category: 'Maxi Dress',
                    price: 110000,
                    sizes: ['M', 'L'],
                    available: true,
                    image: 'https://picsum.photos/seed/prod-6/400/533',
                },
                {
                    id: 7,
                    modelCode: 'FRM-009',
                    name: 'Gaun Formal Velvet Navy',
                    category: 'Gaun Formal',
                    price: 185000,
                    sizes: ['S', 'M', 'L'],
                    available: false,
                    image: 'https://picsum.photos/seed/prod-7/400/533',
                },
                {
                    id: 8,
                    modelCode: 'DRS-017',
                    name: 'Dress Pesta Sequin Merah',
                    category: 'Dress Pesta',
                    price: 220000,
                    sizes: ['M', 'L'],
                    available: true,
                    image: 'https://picsum.photos/seed/prod-8/400/533',
                },
            ];

            // State Halaman
            let currentCategory = 'all';
            let currentSize = 'all';
            let searchQuery = '';
            const wishlistState = new Set(); // Menyimpan ID produk yang difavoritkan

            // Format Harga Rupiah
            function formatPrice(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }

            // Render Kartu Katalog
            function renderCatalog() {
                const grid = document.getElementById('catalog-grid');
                const emptyState = document.getElementById('catalog-empty');
                const countBadge = document.getElementById('catalog-count');
                const activeBar = document.getElementById('catalog-active-bar');
                const clearBtn = document.getElementById('catalog-search-clear-btn');

                // Toggle Clear Button
                if (clearBtn) {
                    clearBtn.style.display = searchQuery.trim() ? 'flex' : 'none';
                }

                // Filter data
                const filtered = allProducts.filter(item => {
                    const matchCategory = currentCategory === 'all' || item.category === currentCategory;
                    const matchSize = currentSize === 'all' || item.sizes.includes(currentSize);
                    const q = searchQuery.toLowerCase().trim();
                    const matchSearch = !q ||
                        item.name.toLowerCase().includes(q) ||
                        item.modelCode.toLowerCase().includes(q) ||
                        item.category.toLowerCase().includes(q);

                    return matchCategory && matchSize && matchSearch;
                });

                // Update Jumlah Produk
                if (countBadge) {
                    countBadge.textContent = filtered.length;
                }

                // Tampilkan active bar jika ada filter/search aktif
                const isFiltered = currentCategory !== 'all' || currentSize !== 'all' || searchQuery.trim().length > 0;
                if (activeBar) {
                    activeBar.style.display = isFiltered ? 'flex' : 'none';
                }

                // Tampilkan Empty State bila kosong
                if (filtered.length === 0) {
                    grid.innerHTML = '';
                    emptyState.style.display = 'flex';
                    return;
                }

                emptyState.style.display = 'none';

                // Buat HTML kartu dress
                grid.innerHTML = filtered.map(product => {
                    const isWishlisted = wishlistState.has(product.id);
                    const sizesHtml = product.sizes.map(s => `<span class="collection-size">${s}</span>`).join('');

                    return `
                        <div class="collection-card catalog-card" data-id="${product.id}">
                            <!-- Image Container -->
                            <div class="collection-image-wrapper">
                                <img
                                    src="${product.image}"
                                    alt="${product.name}"
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
                                        onclick="handleDetailClick('${product.name}', '${product.modelCode}', event)"
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
                                <div class="collection-product-meta">
                                    <span class="collection-model-code">${product.modelCode}</span>
                                    <span class="collection-category">${product.category}</span>
                                </div>

                                <h2 class="collection-product-name" title="${product.name}">
                                    ${product.name}
                                </h2>

                                <div class="collection-sizes">
                                    <span class="collection-size-label">Ukuran:</span>
                                    ${sizesHtml}
                                </div>

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

            // Wishlist Toggle Interaction
            function toggleWishlist(id, event) {
                event.stopPropagation();
                if (wishlistState.has(id)) {
                    wishlistState.delete(id);
                } else {
                    wishlistState.add(id);
                }
                renderCatalog();
            }

            // Lihat Detail Click
            function handleDetailClick(name, code, event) {
                event.preventDefault();
                alert(`Detail ${name} (${code}) akan tersedia pada tahap pengembangan rute detail dress berikutnya.`);
            }

            // Filter Kategori
            function setCategory(cat) {
                currentCategory = cat;
                const buttons = document.querySelectorAll('#category-filters .catalog-pill-btn');
                buttons.forEach(btn => {
                    if ((cat === 'all' && btn.textContent.trim() === 'Semua') || btn.textContent.trim() === cat) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                });
                renderCatalog();
            }

            // Filter Ukuran
            function setSize(sz) {
                currentSize = sz;
                const buttons = document.querySelectorAll('#size-filters .catalog-pill-btn');
                buttons.forEach(btn => {
                    if ((sz === 'all' && btn.textContent.trim() === 'Semua') || btn.textContent.trim() === sz) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                });
                renderCatalog();
            }

            // Search Handlers
            function handleSearch(val) {
                searchQuery = val;
                // Sync ke input navbar jika berbeda
                const navInput = document.getElementById('navbar-search-input');
                if (navInput && navInput.value !== val) {
                    navInput.value = val;
                }
                renderCatalog();
            }

            function clearSearch() {
                searchQuery = '';
                const catInput = document.getElementById('catalog-search-input');
                if (catInput) catInput.value = '';
                const navInput = document.getElementById('navbar-search-input');
                if (navInput) navInput.value = '';
                renderCatalog();
            }

            function onNavbarSearchInput(val) {
                const catInput = document.getElementById('catalog-search-input');
                if (catInput) {
                    catInput.value = val;
                }
                handleSearch(val);
            }

            function syncNavbarSearch() {
                const navInput = document.getElementById('navbar-search-input');
                if (navInput) {
                    handleSearch(navInput.value);
                }
            }

            // Reset Semua Filter
            function resetAllFilters() {
                currentCategory = 'all';
                currentSize = 'all';
                searchQuery = '';
                const catInput = document.getElementById('catalog-search-input');
                if (catInput) catInput.value = '';
                const navInput = document.getElementById('navbar-search-input');
                if (navInput) navInput.value = '';

                // Reset buttons
                document.querySelectorAll('#category-filters .catalog-pill-btn').forEach(btn => {
                    btn.classList.toggle('active', btn.textContent.trim() === 'Semua');
                });
                document.querySelectorAll('#size-filters .catalog-pill-btn').forEach(btn => {
                    btn.classList.toggle('active', btn.textContent.trim() === 'Semua');
                });

                renderCatalog();
            }

            // Mobile Menu Toggle
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
                    const catInput = document.getElementById('catalog-search-input');
                    if (catInput) catInput.value = qParam;
                    const navInput = document.getElementById('navbar-search-input');
                    if (navInput) navInput.value = qParam;
                }

                if (catParam) {
                    setCategory(catParam);
                } else {
                    renderCatalog();
                }
            });
        </script>
    </body>
</html>
