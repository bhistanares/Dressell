<template>
    <!-- Featured Collection Section — menggantikan Categories Section -->
    <!-- Mempertahankan tata letak gambar dress yang sudah disukai, namun menampilkan koleksi pilihan -->
    <section class="py-8 bg-[#fdf6f0]" id="pilihan-editor">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="flex items-center justify-between mb-5">
                <div>
                    <p class="text-rose-500 text-xs font-semibold uppercase tracking-wider mb-1">Pilihan Editor</p>
                    <h2 class="text-xl font-bold text-gray-900">Koleksi yang Sedang Tren</h2>
                </div>
                <a href="#koleksi" class="flex items-center gap-1 text-sm font-medium text-rose-600 hover:text-rose-700 transition-colors">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Grid: tata letak asimetris — 1 besar + 3 kecil -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">

                <!-- Card besar (span 2 kolom di desktop) -->
                <a href="#koleksi"
                   class="group relative rounded-2xl overflow-hidden md:col-span-2 aspect-[4/5] md:aspect-auto block shadow-sm hover:shadow-md transition-shadow">
                    <img
                        :src="featuredItems[0].image"
                        :alt="featuredItems[0].name"
                        class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-400 min-h-[220px] md:min-h-[340px]"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <span class="inline-block bg-rose-500 text-white text-xs font-semibold px-2.5 py-1 rounded-full mb-2">
                            {{ featuredItems[0].tag }}
                        </span>
                        <p class="text-white font-semibold text-base leading-tight">{{ featuredItems[0].name }}</p>
                        <p class="text-white/70 text-xs mt-0.5">{{ featuredItems[0].category }}</p>
                    </div>
                </a>

                <!-- 3 card kecil -->
                <a v-for="item in featuredItems.slice(1)" :key="item.id"
                   href="#koleksi"
                   class="group relative rounded-2xl overflow-hidden aspect-[3/4] block shadow-sm hover:shadow-md transition-shadow">
                    <img
                        :src="item.image"
                        :alt="item.name"
                        class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-400"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/5 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-3">
                        <p class="text-white text-sm font-semibold leading-tight">{{ item.name }}</p>
                        <p class="text-white/70 text-xs mt-0.5">{{ item.category }}</p>
                    </div>
                </a>
            </div>
        </div>
    </section>
</template>

<script setup>
// Data dummy koleksi pilihan — berbeda dari kategori di hero, berfokus pada item spesifik
const featuredItems = [
    {
        id: 1,
        name: 'Gaun Pengantin Aurora',
        category: 'Gaun Pernikahan',
        tag: 'Paling Diminati',
        image: 'https://picsum.photos/seed/feat-wedding/600/750',
    },
    {
        id: 2,
        name: 'Kebaya Songket Merah',
        category: 'Kebaya Modern',
        tag: null,
        image: 'https://picsum.photos/seed/feat-kebaya/400/533',
    },
    {
        id: 3,
        name: 'Midi Dress Batik Parang',
        category: 'Batik & Tenun',
        tag: null,
        image: 'https://picsum.photos/seed/feat-batik/400/533',
    },
    {
        id: 4,
        name: 'Maxi Dress Floral',
        category: 'Maxi Dress',
        tag: null,
        image: 'https://picsum.photos/seed/feat-maxi/400/533',
    },
];
</script>
