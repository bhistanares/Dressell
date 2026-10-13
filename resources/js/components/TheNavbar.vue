<template>
    <header class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center h-16 gap-4">

                <!-- Logo (kiri) -->
                <a href="/" class="flex items-center gap-2 shrink-0">
                    <span class="text-xl">🌸</span>
                    <span class="text-lg font-semibold text-rose-700 tracking-wide">Dressell</span>
                </a>

                <!-- Navigation Links (tengah, hanya desktop) -->
                <nav class="hidden lg:flex flex-1 items-center justify-center gap-1">
                    <a v-for="item in navItems" :key="item.label"
                       :href="item.href"
                       :class="[
                           'px-3.5 py-2 text-sm font-medium rounded-md transition-colors whitespace-nowrap',
                           item.active
                               ? 'text-rose-700 bg-rose-50'
                               : 'text-gray-600 hover:text-rose-700 hover:bg-gray-50'
                       ]">
                        {{ item.label }}
                    </a>
                </nav>

                <!-- Spacer untuk tablet (di antara logo dan ikon) -->
                <div class="hidden md:block lg:hidden flex-1"></div>

                <!-- Search Bar (desktop & tablet) -->
                <div class="hidden md:flex items-center">
                    <div class="relative">
                        <input
                            type="text"
                            placeholder="Cari dress..."
                            class="w-48 lg:w-56 pl-4 pr-9 py-2 rounded-full border border-gray-200 text-sm focus:outline-none focus:border-rose-300 focus:ring-1 focus:ring-rose-200 bg-gray-50"
                        />
                        <button class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-rose-500">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Right Action Icons -->
                <div class="flex items-center gap-1 shrink-0">
                    <!-- Wishlist -->
                    <button class="hidden md:flex w-9 h-9 items-center justify-center text-gray-500 hover:text-rose-600 hover:bg-rose-50 rounded-full transition-colors" aria-label="Wishlist">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                    <!-- Keranjang -->
                    <button class="hidden md:flex w-9 h-9 items-center justify-center text-gray-500 hover:text-rose-600 hover:bg-rose-50 rounded-full transition-colors relative" aria-label="Keranjang">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span class="absolute top-1 right-1 bg-rose-500 text-white text-[10px] rounded-full w-3.5 h-3.5 flex items-center justify-center leading-none">0</span>
                    </button>
                    <!-- Profil -->
                    <button class="hidden md:flex w-9 h-9 items-center justify-center text-gray-500 hover:text-rose-600 hover:bg-rose-50 rounded-full transition-colors" aria-label="Akun">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </button>

                    <!-- Mobile menu button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                            class="md:hidden w-9 h-9 flex items-center justify-center text-gray-600 hover:bg-gray-100 rounded-full transition-colors"
                            aria-label="Menu">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path v-if="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div v-if="mobileMenuOpen" class="md:hidden border-t border-gray-100 bg-white shadow-lg">
            <div class="px-4 py-3 space-y-1">
                <!-- Search mobile -->
                <div class="relative mb-3">
                    <input
                        type="text"
                        placeholder="Cari dress..."
                        class="w-full pl-4 pr-9 py-2 rounded-full border border-gray-200 text-sm focus:outline-none focus:border-rose-300 bg-gray-50"
                    />
                    <button class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>

                <!-- Nav links mobile -->
                <a v-for="item in navItems" :key="item.label" :href="item.href"
                   class="flex items-center px-3 py-2.5 text-sm text-gray-700 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-colors">
                    {{ item.label }}
                </a>

                <!-- Mobile action icons -->
                <div class="flex items-center gap-4 pt-3 mt-2 border-t border-gray-100">
                    <button class="flex items-center gap-2 text-sm text-gray-600 hover:text-rose-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        Wishlist
                    </button>
                    <button class="flex items-center gap-2 text-sm text-gray-600 hover:text-rose-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Keranjang
                    </button>
                    <button class="flex items-center gap-2 text-sm text-gray-600 hover:text-rose-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Masuk
                    </button>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import { ref } from 'vue';

const mobileMenuOpen = ref(false);

// Halaman yang benar-benar tersedia (hanya route '/')
// Tautan lain mengarah ke section pada homepage atau menggunakan '#' dengan penanganan graceful
const navItems = [
    { label: 'Beranda', href: '/', active: true },
    { label: 'Koleksi', href: '#koleksi', active: false },
    { label: 'Kategori', href: '#kategori', active: false },
    { label: 'Promo', href: '#promo', active: false },
    { label: 'Fitting Appointment', href: '#fitting', active: false },
    { label: 'Cara Menyewa', href: '#cara-menyewa', active: false },
];
</script>
