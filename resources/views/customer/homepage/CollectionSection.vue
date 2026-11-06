<template>
    <!-- Collection Section -->
    <section class="collection-section" id="koleksi">
        <div class="collection-container">

            <!-- Section Header -->
            <div class="collection-header">
                <div>
                    <p class="collection-eyebrow">Pilihan Terbaik</p>
                    <h2 class="collection-title">Koleksi Dress Terpopuler</h2>
                </div>

                <a href="#" class="collection-all-link">
                    Lihat Semua
                    <svg class="collection-link-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Products Grid -->
            <div class="collection-grid">
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="collection-card"
                >
                    <!-- Image Container -->
                    <div class="collection-image-wrapper">
                        <img
                            :src="product.image"
                            :alt="product.name"
                            class="collection-image"
                        />

                        <!-- Badge -->
                        <div v-if="product.badge" class="collection-badge-wrapper">
                            <span
                                :class="[
                                    'collection-badge',
                                    product.badge === 'Terlaris'
                                        ? 'collection-badge-bestseller'
                                        : 'collection-badge-favorite'
                                ]"
                            >
                                {{ product.badge }}
                            </span>
                        </div>

                        <!-- Availability -->
                        <div class="collection-availability-wrapper">
                            <span
                                :class="[
                                    'collection-availability',
                                    product.available
                                        ? 'collection-availability-available'
                                        : 'collection-availability-unavailable'
                                ]"
                            >
                                {{ product.available ? '✓ Tersedia' : 'Tidak Tersedia' }}
                            </span>
                        </div>

                        <!-- Wishlist -->
                        <button
                            class="collection-wishlist"
                            aria-label="Tambah ke wishlist"
                        >
                            <svg class="collection-wishlist-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Product Information -->
                    <div class="collection-product-info">

                        <!-- Model Code & Category -->
                        <div class="collection-product-meta">
                            <span class="collection-model-code">{{ product.modelCode }}</span>
                            <span class="collection-category">{{ product.category }}</span>
                        </div>

                        <!-- Dress Name -->
                        <h3 class="collection-product-name">{{ product.name }}</h3>

                        <!-- Available Sizes -->
                        <div class="collection-sizes">
                            <span class="collection-size-label">Ukuran:</span>

                            <span
                                v-for="size in product.sizes"
                                :key="size"
                                class="collection-size"
                            >
                                {{ size }}
                            </span>
                        </div>

                        <!-- Price & Rental Button -->
                        <div class="collection-product-footer">
                            <div>
                                <p class="collection-price">
                                    Rp {{ formatPrice(product.pricePerDay) }}
                                </p>
                                <p class="collection-price-period">per hari</p>
                            </div>

                            <button
                                :disabled="!product.available"
                                :class="[
                                    'collection-rent-button',
                                    product.available
                                        ? 'collection-rent-available'
                                        : 'collection-rent-unavailable'
                                ]"
                            >
                                Sewa
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</template>

<script setup>
const formatPrice = (price) => {
    return new Intl.NumberFormat('id-ID').format(price);
};

// Data dummy produk dress dengan struktur yang sesuai untuk penyewaan
// Siap untuk diintegrasikan dengan database
// modelCode = kode model/desain dress (bukan kode unit fisik)
const products = [
    {
        id: 1,
        modelCode: 'DRS-001',
        name: 'Gaun Pesta Elegan Mawar',
        category: 'Dress Pesta',
        pricePerDay: 150000,
        sizes: ['S', 'M', 'L'],
        available: true,
        badge: 'Terlaris',
        image: 'https://picsum.photos/seed/prod-1/400/533',
    },
    {
        id: 2,
        modelCode: 'KBY-012',
        name: 'Kebaya Modern Songket',
        category: 'Kebaya Modern',
        pricePerDay: 200000,
        sizes: ['M', 'L', 'XL'],
        available: true,
        badge: null,
        image: 'https://picsum.photos/seed/prod-2/400/533',
    },
    {
        id: 3,
        modelCode: 'GWN-003',
        name: 'Gaun Pengantin Aurora',
        category: 'Gaun Pernikahan',
        pricePerDay: 450000,
        sizes: ['S', 'M'],
        available: true,
        badge: 'Favorit',
        image: 'https://picsum.photos/seed/prod-3/400/533',
    },
    {
        id: 4,
        modelCode: 'BTK-021',
        name: 'Midi Dress Batik Parang',
        category: 'Batik & Tenun',
        pricePerDay: 120000,
        sizes: ['S', 'M', 'L', 'XL'],
        available: true,
        badge: null,
        image: 'https://picsum.photos/seed/prod-4/400/533',
    },
    {
        id: 5,
        modelCode: 'CSL-008',
        name: 'Dress Casual Linen Putih',
        category: 'Dress Casual',
        pricePerDay: 85000,
        sizes: ['XS', 'S', 'M'],
        available: true,
        badge: null,
        image: 'https://picsum.photos/seed/prod-5/400/533',
    },
    {
        id: 6,
        modelCode: 'MXD-015',
        name: 'Maxi Dress Floral Garden',
        category: 'Maxi Dress',
        pricePerDay: 110000,
        sizes: ['M', 'L'],
        available: true,
        badge: 'Terlaris',
        image: 'https://picsum.photos/seed/prod-6/400/533',
    },
    {
        id: 7,
        modelCode: 'FRM-009',
        name: 'Gaun Formal Velvet Navy',
        category: 'Gaun Formal',
        pricePerDay: 185000,
        sizes: ['S', 'M', 'L'],
        available: false,
        badge: null,
        image: 'https://picsum.photos/seed/prod-7/400/533',
    },
    {
        id: 8,
        modelCode: 'DRS-017',
        name: 'Dress Pesta Sequin Merah',
        category: 'Dress Pesta',
        pricePerDay: 220000,
        sizes: ['M', 'L'],
        available: true,
        badge: null,
        image: 'https://picsum.photos/seed/prod-8/400/533',
    },
];
</script>
