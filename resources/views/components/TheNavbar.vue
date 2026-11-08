<template>
    <header class="navbar">
        <div class="navbar-container">
            <div class="navbar-main">
                <!-- 1. Logo Dressell di Kiri -->
                <a href="/" class="navbar-logo" aria-label="Dressell Beranda">
                    <img
                        :src="'/assets/img/logo-dressell.png'"
                        alt="Dressell Logo"
                        class="navbar-logo-img"
                    />
                    <span class="navbar-logo-text">Dressell</span>
                </a>

                <!-- 2. Navigasi Teks di Tengah (Desktop) -->
                <nav class="navbar-navigation" aria-label="Navigasi Utama">
                    <a
                        v-for="item in navItems"
                        :key="item.label"
                        :href="item.href"
                        :class="[
                            'navbar-link',
                            { 'is-active': item.active }
                        ]"
                    >
                        {{ item.label }}
                    </a>
                </nav>

                <!-- 3. Tombol Akses di Kanan (Login) -->
                <div class="navbar-actions">
                    <a
                        href="/login"
                        class="navbar-login-btn"
                        title="Masuk ke Akun Dressell"
                    >
                        <svg class="navbar-login-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <span>Masuk</span>
                    </a>

                    <!-- Tombol Menu Mobile (Hamburger) -->
                    <button
                        type="button"
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="navbar-menu-button"
                        aria-label="Buka Menu"
                        :aria-expanded="mobileMenuOpen"
                    >
                        <svg
                            v-if="!mobileMenuOpen"
                            class="navbar-menu-icon"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg
                            v-else
                            class="navbar-menu-icon"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <transition name="navbar-fade">
            <div
                v-if="mobileMenuOpen"
                class="navbar-mobile"
            >
                <div class="navbar-mobile-content">
                    <nav class="navbar-mobile-links">
                        <a
                            v-for="item in navItems"
                            :key="item.label"
                            :href="item.href"
                            :class="[
                                'navbar-mobile-link',
                                { 'is-active': item.active }
                            ]"
                            @click="mobileMenuOpen = false"
                        >
                            {{ item.label }}
                        </a>
                    </nav>

                    <div class="navbar-mobile-auth">
                        <a
                            href="/login"
                            class="navbar-mobile-login-btn"
                            @click="mobileMenuOpen = false"
                        >
                            Masuk ke Akun
                        </a>
                    </div>
                </div>
            </div>
        </transition>
    </header>
</template>

<script setup>
import { ref } from 'vue';

const mobileMenuOpen = ref(false);

const navItems = [
    { label: 'Beranda', href: '/', active: true },
    { label: 'Katalog', href: '/katalog', active: false },
    { label: 'Fitting Appointment', href: '#fitting', active: false },
    { label: 'Cara Menyewa', href: '#cara-menyewa', active: false },
];
</script>
