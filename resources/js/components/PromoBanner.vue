<template>
    <!-- Promo Banner Section -->
    <!-- id="promo" untuk anchor navigasi dari navbar -->
    <section class="py-10 bg-white" id="promo">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-rose-800 to-rose-600 min-h-[260px]">
                <!-- Background decorative elements -->
                <div class="absolute inset-0 overflow-hidden">
                    <div class="absolute -right-20 -top-20 w-64 h-64 rounded-full bg-white/5"></div>
                    <div class="absolute -left-10 -bottom-20 w-80 h-80 rounded-full bg-white/5"></div>
                    <div class="absolute right-1/4 top-1/2 -translate-y-1/2 w-32 h-32 rounded-full bg-white/5"></div>
                </div>

                <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-0 min-h-[260px]">
                    <!-- Left: Text content -->
                    <div class="flex flex-col justify-center px-8 py-10 lg:px-12">
                        <div class="inline-flex items-center gap-2 bg-white/20 text-white text-xs font-semibold px-3 py-1.5 rounded-full w-fit mb-4">
                            🎉 Penawaran Spesial
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-bold text-white leading-tight mb-3">
                            Diskon 30% untuk<br/>
                            <span class="text-rose-200">Penyewaan Pertama</span>
                        </h2>
                        <p class="text-white/75 text-sm lg:text-base mb-6 leading-relaxed max-w-sm">
                            Gunakan kode <strong class="text-white bg-white/20 px-2 py-0.5 rounded">DRESSFIRST</strong> saat checkout. Berlaku untuk semua kategori dress.
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <a href="#" class="bg-white text-rose-700 font-semibold text-sm px-6 py-3 rounded-full hover:bg-rose-50 transition-colors shadow-sm">
                                Gunakan Sekarang
                            </a>
                            <div class="flex items-center gap-2 text-white/80 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Berakhir dalam 3 hari
                            </div>
                        </div>
                    </div>

                    <!-- Right: Image -->
                    <div class="relative hidden lg:block">
                        <img
                            src="https://picsum.photos/seed/promo-banner/600/400"
                            alt="Promo Dressell"
                            class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-40"
                        />
                        <!-- Floating stats card -->
                        <div class="absolute bottom-8 right-8 bg-white rounded-2xl p-4 shadow-xl">
                            <p class="text-xs text-gray-500 mb-1">Sudah disewa oleh</p>
                            <p class="text-2xl font-bold text-rose-600">12,500+</p>
                            <p class="text-xs text-gray-500">pelanggan puas</p>
                        </div>
                        <!-- Floating badge -->
                        <div class="absolute top-8 right-8 bg-amber-400 text-white rounded-full w-16 h-16 flex items-center justify-center shadow-lg flex-col">
                            <span class="text-lg font-bold leading-none">30%</span>
                            <span class="text-xs leading-none">OFF</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
</script>
