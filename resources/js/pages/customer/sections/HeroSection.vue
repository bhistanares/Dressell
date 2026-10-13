<template>
    <!-- Hero Section: Kategori dress langsung di atas fold -->
    <section class="bg-white pt-5 pb-2" id="beranda">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 lg:px-12">

            <!-- Intro singkat (compact, tidak mendominasi) -->
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-xl font-semibold text-gray-900">Temukan Dress untuk Setiap Momen</h1>
                    <p class="text-sm text-gray-500 mt-0.5">Sewa dress premium, mulai dari Rp 85.000/hari</p>
                </div>
                <a href="#koleksi" class="hidden sm:flex items-center gap-1.5 text-sm font-medium text-rose-600 hover:text-rose-700 transition-colors">
                    Lihat Semua Koleksi
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Grid Kategori Dress (4 kolom desktop, 2 mobile) -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                <a v-for="cat in heroCategories" :key="cat.id"
                   href="#koleksi"
                   class="group relative rounded-xl overflow-hidden aspect-[3/4] block cursor-pointer">
                    <img
                        :src="cat.image"
                        :alt="cat.name"
                        class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-400"
                    />
                    <!-- Overlay bawah: ringan, tidak terlalu pekat -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/55 via-black/5 to-transparent"></div>
                    <!-- Label kategori -->
                    <div class="absolute bottom-0 left-0 right-0 p-3.5">
                        <span class="text-white text-sm font-semibold block leading-tight">{{ cat.name }}</span>
                        <span class="text-white/70 text-xs mt-0.5 block">{{ cat.count }} pilihan</span>
                    </div>
                    <!-- Indikator hover -->
                    <div class="absolute inset-0 ring-2 ring-rose-400 ring-inset rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                </a>
            </div>

            <!-- Link "Lihat Semua" mobile -->
            <div class="mt-3 sm:hidden text-center">
                <a href="#koleksi" class="text-sm font-medium text-rose-600 hover:text-rose-700">
                    Lihat semua koleksi →
                </a>
            </div>
        </div>
    </section>
</template>

<script setup>
// Data dummy kategori untuk hero — akan terhubung ke database
const heroCategories = [
    {
        id: 1,
        name: 'Dress Pesta',
        count: 48,
        image: 'https://picsum.photos/seed/cat-pesta/400/533',
    },
    {
        id: 2,
        name: 'Kebaya Modern',
        count: 35,
        image: 'https://picsum.photos/seed/cat-kebaya/400/533',
    },
    {
        id: 3,
        name: 'Gaun Pernikahan',
        count: 27,
        image: 'https://picsum.photos/seed/cat-wedding/400/533',
    },
    {
        id: 4,
        name: 'Dress Formal',
        count: 56,
        image: 'https://picsum.photos/seed/cat-formal/400/533',
    },
];
</script>
