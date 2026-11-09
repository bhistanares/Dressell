<template>
    <!-- Collection Section (Koleksi Dress Terpopuler) -->
    <section class="collection-section" id="koleksi">
        <div class="collection-container">

            <!-- Section Header -->
            <div class="collection-header">
                <div>
                    <span class="collection-eyebrow">Pilihan Terbaik</span>
                    <h2 class="collection-title">Koleksi Dress Terpopuler</h2>
                </div>

                <a href="/katalog" class="collection-all-link">
                    <span>Lihat Semua</span>
                    <svg class="collection-link-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Products Grid (8 Koleksi Populer) -->
            <div class="collection-grid">
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="collection-card catalog-card"
                >
                    <!-- Image Container (Konsisten dengan pendekatan visual halaman Catalog) -->
                    <div class="collection-image-wrapper">
                        <img
                            :src="product.image"
                            :alt="product.name"
                            class="collection-image"
                            loading="lazy"
                        />

                        <!-- Badge Koleksi (Top Left) -->
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

                        <!-- Wishlist Button (Hanya Ditampilkan Saat Hover untuk Customer Login) -->
                        <button
                            v-if="isCustomer"
                            type="button"
                            :class="[
                                'catalog-wishlist-btn',
                                { 'is-active': isWishlisted(product.id) }
                            ]"
                            :aria-label="'Simpan ' + product.name + ' ke favorit'"
                            :title="isWishlisted(product.id) ? 'Hapus dari favorit' : 'Tambah ke favorit'"
                            @click.stop="toggleWishlist(product.id)"
                        >
                            <svg class="collection-wishlist-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>

                        <!-- Quick View Overlay (Slide-Up dari Bawah — Konsisten dengan Catalog) -->
                        <div class="catalog-quickview-overlay">
                            <a
                                :href="'/katalog?search=' + encodeURIComponent(product.name)"
                                class="catalog-quickview-btn"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span>Lihat Detail</span>
                            </a>
                        </div>
                    </div>

                    <!-- Product Information -->
                    <div class="collection-product-info">
                        <!-- Model Code & Category Meta -->
                        <div class="collection-product-meta">
                            <span class="collection-model-code">{{ product.modelCode }}</span>
                            <span class="collection-category">{{ product.category }}</span>
                        </div>

                        <!-- Dress Name -->
                        <h3 class="collection-product-name" :title="product.name">
                            {{ product.name }}
                        </h3>

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

                        <!-- Price Footer (/ 4 hari) -->
                        <div class="collection-product-footer">
                            <div class="catalog-price-container">
                                <p class="collection-price">
                                    Rp {{ formatPrice(product.pricePerDay) }}
                                </p>
                                <span class="catalog-price-period">/ 4 hari</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';

const props = defineProps({
    user: {
        type: Object,
        default: null,
    },
});

const currentUser = ref(props.user);

watch(
    () => props.user,
    (val) => {
        currentUser.value = val;
    }
);

onMounted(() => {
    if (!currentUser.value && typeof document !== 'undefined') {
        const appEl = document.getElementById('app');
        if (appEl && appEl.dataset.user) {
            try {
                currentUser.value = JSON.parse(appEl.dataset.user);
            } catch (e) {}
        }
    }
});

const isCustomer = computed(() => !!currentUser.value);

const wishlist = ref(new Set());

const isWishlisted = (id) => wishlist.value.has(id);

const toggleWishlist = (id) => {
    if (wishlist.value.has(id)) {
        wishlist.value.delete(id);
    } else {
        wishlist.value.add(id);
    }
};

const formatPrice = (price) => {
    return new Intl.NumberFormat('id-ID').format(price);
};

// Data master 8 gaun terpopuler Dressell dengan aset foto studio yang tersedia
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
        image: '/assets/img/dressell/drs-001.jpg',
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
        image: '/assets/img/dressell/kby-012.jpg',
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
        image: '/assets/img/dressell/gwn-003.jpg',
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
        image: '/assets/img/dressell/btk-021.jpg',
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
        image: '/assets/img/dressell/csl-008.jpg',
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
        image: '/assets/img/dressell/mxd-015.jpg',
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
        image: '/assets/img/dressell/frm-009.jpg',
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
        image: '/assets/img/dressell/drs-017.jpg',
    },
];
</script>
