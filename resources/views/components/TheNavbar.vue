<template>
    <header class="navbar">
        <div class="navbar-container">
            <div class="navbar-main">
                <!-- 1. Logo Dressell di Kiri -->
                <a :href="currentUser ? '/customer/dashboard' : '/'" class="navbar-logo" aria-label="Dressell Beranda">
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

                <!-- 3. Aksi di Kanan: Guest vs Customer -->
                <div class="navbar-actions">
                    <!-- Kondisi GUEST (Belum Login): Tombol Masuk & Tombol Daftar -->
                    <template v-if="!currentUser">
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

                        <a
                            href="/register"
                            class="navbar-register-btn"
                            title="Daftar Akun Baru Dressell"
                        >
                            <span>Daftar</span>
                        </a>
                    </template>

                    <!-- Kondisi CUSTOMER (Sudah Login): 3 Ikon (Wishlist, Hold/Compare, Profil) -->
                    <template v-else>
                        <div class="navbar-customer-group">
                            <!-- 1. Ikon Wishlist (Outline) -->
                            <a
                                href="#wishlist"
                                class="navbar-icon-btn"
                                title="Wishlist Gaun Favorit"
                                aria-label="Wishlist Gaun Favorit"
                                @click.prevent="showFeatureNotice('Wishlist')"
                            >
                                <svg class="navbar-icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                                </svg>
                            </a>

                            <!-- 2. Ikon Hold Dress / Compare (Outline) -->
                            <a
                                href="#hold-compare"
                                class="navbar-icon-btn"
                                title="Hold & Bandingkan Gaun"
                                aria-label="Hold & Bandingkan Gaun"
                                @click.prevent="showFeatureNotice('Hold & Bandingkan Gaun')"
                            >
                                <svg class="navbar-icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 3a3 3 0 0 0-3 3c0 1.25.75 2 2 2.5L2 15a2 2 0 0 0 1.2 2.6c.3.1.5.1.8.1h16a2 2 0 0 0 2-2c0-.3 0-.6-.2-.9L13 8.5C14.25 8 15 7.25 15 6a3 3 0 0 0-3-3z"/>
                                    <path d="M12 8.5V11"/>
                                </svg>
                            </a>

                            <!-- 3. Ikon Profil Customer & Dropdown -->
                            <div class="navbar-profile-wrapper" id="navbar-profile-container">
                                <button
                                    type="button"
                                    id="navbar-profile-trigger"
                                    class="navbar-icon-btn navbar-profile-trigger"
                                    :class="{ 'is-active': profileDropdownOpen }"
                                    aria-label="Menu Profil Pelanggan"
                                    aria-haspopup="true"
                                    :aria-expanded="profileDropdownOpen"
                                    @click="toggleProfileDropdown"
                                >
                                    <svg class="navbar-icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                </button>

                                <!-- Dropdown Profil Customer -->
                                <transition name="navbar-dropdown-fade">
                                    <div
                                        v-if="profileDropdownOpen"
                                        id="navbar-profile-menu"
                                        class="navbar-profile-dropdown"
                                        role="menu"
                                    >
                                        <!-- Info Customer -->
                                        <div class="navbar-profile-header">
                                            <p class="navbar-profile-name">{{ currentUser.name }}</p>
                                            <p class="navbar-profile-email">{{ currentUser.email }}</p>
                                        </div>

                                        <!-- Menu List -->
                                        <ul class="navbar-profile-menu">
                                            <li role="none">
                                                <div class="navbar-profile-item" role="menuitem" tabindex="0">
                                                    <span>Profil Saya</span>
                                                </div>
                                            </li>
                                            <li role="none">
                                                <div class="navbar-profile-item" role="menuitem" tabindex="0">
                                                    <span>Riwayat Penyewaan</span>
                                                </div>
                                            </li>
                                            <li role="none">
                                                <div class="navbar-profile-item" role="menuitem" tabindex="0">
                                                    <span>Riwayat Fitting</span>
                                                </div>
                                            </li>
                                            <li role="none">
                                                <div class="navbar-profile-item" role="menuitem" tabindex="0">
                                                    <span>Pengaturan Akun</span>
                                                </div>
                                            </li>
                                        </ul>

                                        <div class="navbar-profile-divider"></div>

                                        <!-- Tombol Logout Customer (Memakai mekanisme /logout terpadu) -->
                                        <div class="navbar-profile-logout-form">
                                            <form :action="logoutUrl" method="POST">
                                                <input type="hidden" name="_token" :value="activeCsrfToken">
                                                <input type="hidden" name="redirect_to" value="/">
                                                <button
                                                    type="submit"
                                                    class="navbar-profile-logout-btn"
                                                    role="menuitem"
                                                >
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                    </svg>
                                                    <span>Keluar</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </transition>
                            </div>
                        </div>
                    </template>

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
                    <!-- Customer Header jika sudah login -->
                    <div v-if="currentUser" class="navbar-mobile-user-card">
                        <p class="navbar-mobile-user-name">{{ currentUser.name }}</p>
                        <p class="navbar-mobile-user-email">{{ currentUser.email }}</p>
                    </div>

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

                        <!-- Menu Khusus Customer di Mobile -->
                        <template v-if="currentUser">
                            <div class="navbar-mobile-divider"></div>
                            <a href="#wishlist" class="navbar-mobile-link" @click.prevent="mobileMenuOpen = false; showFeatureNotice('Wishlist')">
                                Wishlist Gaun
                            </a>
                            <a href="#hold-compare" class="navbar-mobile-link" @click.prevent="mobileMenuOpen = false; showFeatureNotice('Hold & Bandingkan Gaun')">
                                Hold & Bandingkan
                            </a>
                            <a href="#profil" class="navbar-mobile-link" @click.prevent="mobileMenuOpen = false">
                                Profil Saya
                            </a>
                            <a href="#riwayat-sewa" class="navbar-mobile-link" @click.prevent="mobileMenuOpen = false">
                                Riwayat Penyewaan
                            </a>
                            <a href="#riwayat-fitting" class="navbar-mobile-link" @click.prevent="mobileMenuOpen = false">
                                Riwayat Fitting
                            </a>
                            <a href="#pengaturan" class="navbar-mobile-link" @click.prevent="mobileMenuOpen = false">
                                Pengaturan Akun
                            </a>
                        </template>
                    </nav>

                    <div class="navbar-mobile-auth">
                        <!-- Guest Mobile Buttons -->
                        <template v-if="!currentUser">
                            <a
                                href="/login"
                                class="navbar-mobile-login-btn"
                                @click="mobileMenuOpen = false"
                            >
                                Masuk ke Akun
                            </a>
                            <a
                                href="/register"
                                class="navbar-mobile-register-btn"
                                @click="mobileMenuOpen = false"
                            >
                                Daftar Akun Baru
                            </a>
                        </template>

                        <!-- Customer Mobile Logout -->
                        <template v-else>
                            <form :action="logoutUrl" method="POST" class="w-full">
                                <input type="hidden" name="_token" :value="activeCsrfToken">
                                <input type="hidden" name="redirect_to" value="/">
                                <button
                                    type="submit"
                                    class="navbar-mobile-logout-btn"
                                >
                                    Keluar dari Akun
                                </button>
                            </form>
                        </template>
                    </div>
                </div>
            </div>
        </transition>
    </header>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue';

const props = defineProps({
    user: {
        type: Object,
        default: null,
    },
    logoutUrl: {
        type: String,
        default: '/logout',
    },
    csrfToken: {
        type: String,
        default: '',
    },
});

const mobileMenuOpen = ref(false);
const profileDropdownOpen = ref(false);

const currentUser = ref(props.user);
const activeCsrfToken = ref(props.csrfToken);

watch(
    () => props.user,
    (newVal) => {
        currentUser.value = newVal;
    }
);

watch(
    () => props.csrfToken,
    (newVal) => {
        if (newVal) activeCsrfToken.value = newVal;
    }
);

const toggleProfileDropdown = () => {
    profileDropdownOpen.value = !profileDropdownOpen.value;
};

const showFeatureNotice = (featureName) => {
    // Memberikan feedback halus tanpa membuat rute atau tautan palsu
    if (typeof window !== 'undefined' && window.dispatchEvent) {
        window.dispatchEvent(
            new CustomEvent('dressell:feature-notice', {
                detail: { feature: featureName },
            })
        );
    }
};

const handleDocumentClick = (e) => {
    const triggerEl = document.getElementById('navbar-profile-trigger');
    const menuEl = document.getElementById('navbar-profile-menu');
    if (triggerEl && menuEl) {
        if (!triggerEl.contains(e.target) && !menuEl.contains(e.target)) {
            profileDropdownOpen.value = false;
        }
    }
};

const handleKeydown = (e) => {
    if (e.key === 'Escape') {
        profileDropdownOpen.value = false;
    }
};

onMounted(() => {
    // Fallback hydration jika props belum terisi dari SSR / dataset
    if (!currentUser.value && typeof document !== 'undefined') {
        const appEl = document.getElementById('app');
        if (appEl && appEl.dataset.user) {
            try {
                currentUser.value = JSON.parse(appEl.dataset.user);
            } catch (err) {}
        }
    }

    if (!activeCsrfToken.value && typeof document !== 'undefined') {
        const meta = document.querySelector('meta[name="csrf-token"]');
        if (meta) {
            activeCsrfToken.value = meta.getAttribute('content');
        } else {
            const appEl = document.getElementById('app');
            if (appEl && appEl.dataset.csrf) {
                activeCsrfToken.value = appEl.dataset.csrf;
            }
        }
    }

    document.addEventListener('click', handleDocumentClick);
    document.addEventListener('keydown', handleKeydown);
});

onUnmounted(() => {
    document.removeEventListener('click', handleDocumentClick);
    document.removeEventListener('keydown', handleKeydown);
});

const currentPath = typeof window !== 'undefined' ? window.location.pathname : '/';

const navItems = computed(() => {
    const isCust = !!currentUser.value;
    return [
        {
            label: 'Beranda',
            href: isCust ? '/customer/dashboard' : '/',
            active: isCust ? (currentPath === '/customer/dashboard' || currentPath === '/') : currentPath === '/',
        },
        {
            label: 'Katalog',
            href: '/katalog',
            active: currentPath.startsWith('/katalog'),
        },
        {
            label: 'Fitting Appointment',
            href: '#fitting',
            active: false,
        },
        {
            label: 'Cara Menyewa',
            href: '#cara-menyewa',
            active: false,
        },
    ];
});
</script>
