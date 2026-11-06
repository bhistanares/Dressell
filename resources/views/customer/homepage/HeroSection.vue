<template>
    <section class="hero-section" id="beranda">
        <div class="hero-container">

            <!-- Intro -->
            <div class="hero-intro">
                <div>
                    <h1 class="hero-title">
                        Temukan Dress untuk Setiap Momen
                    </h1>

                    <p class="hero-subtitle">
                        Sewa dress premium, mulai dari Rp 85.000/hari
                    </p>
                </div>

                <a href="#koleksi" class="hero-collection-link">
                    Lihat Semua Koleksi

                    <svg
                        class="hero-link-icon"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>
                </a>
            </div>

            <!-- Grid Kategori -->
            <div class="hero-category-grid">
                <a
                    v-for="cat in heroCategories"
                    :key="cat.id"
                    href="#koleksi"
                    class="hero-category-card"
                >
                    <img
                        :src="cat.image"
                        :alt="cat.name"
                        class="hero-category-image"
                    />

                    <div class="hero-category-overlay"></div>

                    <div class="hero-category-label">
                        <span class="hero-category-name">
                            {{ cat.name }}
                        </span>

                        <span class="hero-category-count">
                            {{ cat.count }} pilihan
                        </span>
                    </div>

                    <div class="hero-category-border"></div>
                </a>
            </div>

            <!-- Link Mobile -->
            <div class="hero-mobile-link-wrapper">
                <a href="#koleksi" class="hero-mobile-link">
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