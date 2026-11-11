<template>
    <!-- Collection Section (Koleksi Dress) -->
    <section class="collection-section" id="koleksi">
        <div class="collection-container">

            <!-- Section Header -->
            <div class="collection-header">
                <div>
                    <span class="collection-eyebrow">{{ eyebrow }}</span>
                    <h2 class="collection-title">{{ title }}</h2>
                </div>

                <a href="/katalog" class="collection-all-link">
                    <span>Lihat Semua</span>
                    <svg class="collection-link-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Products Grid (8 Koleksi Dress Pilihan) -->
            <div class="collection-grid">
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="collection-card catalog-card"
                >
                    <!-- Image Container -->
                    <div class="collection-image-wrapper">
                        <img
                            :src="product.image"
                            :alt="product.name"
                            class="collection-image"
                            loading="lazy"
                        />

                        <!-- Badge Koleksi (Top Left - Hanya jika ada penanda) -->
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

                        <!-- Wishlist Button (Hanya Ditampilkan Saat Hover untuk Customer yang Login) -->
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

                    <!-- Product Information: Kode, Kategori, Nama, Harga per 2 hari (Tanpa Ukuran & Tanpa Ketersediaan) -->
                    <div class="collection-product-info">
                        <!-- Model Code & Category Meta -->
                        <div class="collection-product-meta">
                            <span class="collection-model-code">{{ product.modelCode }}</span>
                            <span class="collection-category">{{ product.category.toUpperCase() }}</span>
                        </div>

                        <!-- Dress Name -->
                        <h3 class="collection-product-name" :title="product.name">
                            {{ product.name }}
                        </h3>

                        <!-- Price Footer (/ 2 hari) -->
                        <div class="collection-product-footer">
                            <div class="catalog-price-container">
                                <p class="collection-price">
                                    Rp {{ formatPrice(product.pricePerDay) }}
                                </p>
                                <span class="catalog-price-period">/ 2 hari</span>
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
    title: {
        type: String,
        default: 'Koleksi Dress Terpopuler',
    },
    eyebrow: {
        type: String,
        default: 'Pilihan Terbaik',
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

// Data dummy 8 koleksi dress dengan kode dress standar 6 karakter dan 8 kategori resmi
const products = [
    {
        id: 1,
        modelCode: 'EAU-001',
        name: 'Gaun Aurora',
        category: 'Elegant Gowns',
        pricePerDay: 150000,
        badge: 'Terlaris',
        image: '/assets/img/dressell/drs-001.jpg',
    },
    {
        id: 2,
        modelCode: 'KSO-002',
        name: 'Kebaya Songket',
        category: 'Modern Kebaya',
        pricePerDay: 200000,
        badge: null,
        image: '/assets/img/dressell/kby-012.jpg',
    },
    {
        id: 3,
        modelCode: 'WCE-003',
        name: 'Gaun Celeste',
        category: 'Wedding Dress',
        pricePerDay: 450000,
        badge: 'Favorit',
        image: '/assets/img/dressell/gwn-003.jpg',
    },
    {
        id: 4,
        modelCode: 'PPA-004',
        name: 'Batik Parang',
        category: 'Party Dress',
        pricePerDay: 120000,
        badge: null,
        image: '/assets/img/dressell/btk-021.jpg',
    },
    {
        id: 5,
        modelCode: 'MLI-005',
        name: 'Satin Putih',
        category: 'Minimalist Suits',
        pricePerDay: 85000,
        badge: null,
        image: '/assets/img/dressell/csl-008.jpg',
    },
    {
        id: 6,
        modelCode: 'SFL-006',
        name: 'Flowy Garden',
        category: 'Special Moments',
        pricePerDay: 110000,
        badge: 'Terlaris',
        image: '/assets/img/dressell/mxd-015.jpg',
    },
    {
        id: 7,
        modelCode: 'EVE-007',
        name: 'Velvet Navy',
        category: 'Elegant Gowns',
        pricePerDay: 185000,
        badge: null,
        image: '/assets/img/dressell/frm-009.jpg',
    },
    {
        id: 8,
        modelCode: 'PSE-008',
        name: 'Ruby Sequin',
        category: 'Party Dress',
        pricePerDay: 220000,
        badge: null,
        image: '/assets/img/dressell/drs-017.jpg',
    },
];
</script>
