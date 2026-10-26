<template>
    <header class="navbar">
        <div class="navbar-container">
            <!-- Baris Pertama: Logo, Search, Aksi -->
            <div class="navbar-main">

                <!-- Logo -->
                <a href="/" class="navbar-logo">
                    <span class="navbar-logo-icon">🌸</span>
                    <span class="navbar-logo-text">Dressell</span>
                </a>

                <!-- Search desktop dan tablet -->
                <div class="navbar-search-desktop">
                    <form @submit.prevent="handleSearch" class="navbar-search">
                        <input
                            v-model="searchQuery"
                            type="text"
                            placeholder="Cari dress..."
                            class="navbar-search-input"
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

                <!-- Ikon aksi -->
                <div class="navbar-actions">

                    <!-- Wishlist -->
                    <button
                        type="button"
                        class="navbar-action-button"
                        aria-label="Wishlist"
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

                    <!-- Bandingkan / Dress Ditahan -->
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

                    <!-- Tombol menu mobile -->
                    <button
                        type="button"
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="navbar-menu-button"
                        aria-label="Menu"
                        :aria-expanded="mobileMenuOpen"
                    >
                        <svg
                            class="navbar-menu-icon"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                v-if="!mobileMenuOpen"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />

                            <path
                                v-else
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>

                </div>
            </div>

            <!-- Baris Kedua: Navigasi Desktop -->
            <div class="navbar-secondary">
                <nav class="navbar-navigation">
                    <a
                        v-for="item in navItems"
                        :key="item.label"
                        :href="item.href"
                        :class="[
                            'navbar-link',
                            { active: item.active }
                        ]"
                    >
                        {{ item.label }}
                    </a>
                </nav>
            </div>
        </div>

        <!-- Menu mobile -->
        <div
            v-if="mobileMenuOpen"
            class="navbar-mobile"
        >
            <div class="navbar-mobile-content">

                <!-- Search mobile -->
                <div class="navbar-search navbar-mobile-search">
                    <form @submit.prevent="handleSearch" style="display: flex; width: 100%; align-items: center;">
                        <input
                            v-model="searchQuery"
                            type="text"
                            placeholder="Cari dress..."
                            class="navbar-search-input"
                            style="width: 100%;"
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

                <!-- Navigasi mobile -->
                <nav class="navbar-mobile-links">
                    <a
                        v-for="item in navItems"
                        :key="item.label"
                        :href="item.href"
                        class="navbar-mobile-link"
                    >
                        {{ item.label }}
                    </a>
                </nav>

                <!-- Aksi mobile -->
                <div class="navbar-mobile-actions">

                    <button
                        type="button"
                        class="navbar-mobile-action"
                    >
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

                    <button
                        type="button"
                        class="navbar-mobile-action"
                    >
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

                    <button
                        type="button"
                        class="navbar-mobile-action"
                    >
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
</template>

<script setup>
import { ref } from 'vue';

const mobileMenuOpen = ref(false);
const searchQuery = ref('');

const handleSearch = () => {
    const q = searchQuery.value.trim();
    if (q) {
        window.location.href = `/katalog?search=${encodeURIComponent(q)}`;
    } else {
        window.location.href = '/katalog';
    }
};

const navItems = [
    { label: 'Beranda', href: '/', active: true },
    { label: 'Katalog', href: '/katalog', active: false },
    { label: 'Fitting Appointment', href: '#fitting', active: false },
    { label: 'Cara Menyewa', href: '#cara-menyewa', active: false },
];
</script>