<template>
    <!-- Collection Section -->
    <section class="py-10 bg-white" id="koleksi">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 lg:px-12">

            <!-- Section Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-rose-500 text-xs font-semibold uppercase tracking-wider mb-1">Pilihan Terbaik</p>
                    <h2 class="text-xl font-bold text-gray-900">Koleksi Dress Terpopuler</h2>
                </div>
                <a href="#" class="flex items-center gap-1 text-sm font-medium text-rose-600 hover:text-rose-700 transition-colors">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 lg:gap-4">
                <div v-for="product in products" :key="product.id"
                     class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-gray-200 hover:shadow-md transition-all duration-200">

                    <!-- Image Container -->
                    <div class="relative overflow-hidden aspect-[3/4]">
                        <img
                            :src="product.image"
                            :alt="product.name"
                            class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-400"
                        />

                        <!-- Badge (kiri atas) -->
                        <div v-if="product.badge" class="absolute top-2.5 left-2.5">
                            <span :class="[
                                'text-xs font-semibold px-2 py-1 rounded-full',
                                product.badge === 'Terlaris' ? 'bg-rose-500 text-white' : 'bg-amber-400 text-white'
                            ]">{{ product.badge }}</span>
                        </div>

                        <!-- Ketersediaan (kiri bawah) -->
                        <div class="absolute bottom-2.5 left-2.5">
                            <span :class="[
                                'text-xs font-medium px-2 py-0.5 rounded-full',
                                product.available
                                    ? 'bg-white/90 text-green-700'
                                    : 'bg-white/90 text-gray-400'
                            ]">
                                {{ product.available ? '✓ Tersedia' : 'Tidak Tersedia' }}
                            </span>
                        </div>

                        <!-- Wishlist (kanan bawah — sesuai permintaan) -->
                        <button class="absolute bottom-2.5 right-2.5 w-8 h-8 bg-white/85 rounded-full flex items-center justify-center hover:bg-white hover:text-rose-500 transition-all shadow-sm backdrop-blur-sm"
                                aria-label="Tambah ke wishlist">
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Info Produk -->
                    <div class="p-3">
                        <!-- Kode model & kategori -->
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs text-gray-400 font-mono">{{ product.modelCode }}</span>
                            <span class="text-xs text-gray-400">{{ product.category }}</span>
                        </div>

                        <!-- Nama dress -->
                        <h3 class="text-sm font-semibold text-gray-800 mb-1.5 line-clamp-1">{{ product.name }}</h3>

                        <!-- Ukuran tersedia -->
                        <div class="flex items-center gap-1 mb-2.5">
                            <span class="text-xs text-gray-400 mr-0.5">Ukuran:</span>
                            <span v-for="size in product.sizes" :key="size"
                                  class="text-xs border border-gray-200 text-gray-600 px-1.5 py-0.5 rounded">
                                {{ size }}
                            </span>
                        </div>

                        <!-- Harga & Tombol Sewa -->
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-bold text-rose-600">Rp {{ formatPrice(product.pricePerDay) }}</p>
                                <p class="text-xs text-gray-400">per hari</p>
                            </div>
                            <button
                                :disabled="!product.available"
                                :class="[
                                    'text-xs font-semibold px-3 py-1.5 rounded-full transition-all duration-200',
                                    product.available
                                        ? 'bg-rose-50 hover:bg-rose-500 text-rose-600 hover:text-white'
                                        : 'bg-gray-100 text-gray-400 cursor-not-allowed'
                                ]">
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

<style scoped>
.line-clamp-1 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
}
</style>
