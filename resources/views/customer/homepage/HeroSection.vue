<template>
    <section class="hero-section" id="beranda">
        <div class="hero-container">

            <!-- Intro Header Section -->
            <div class="hero-intro">
                <div>
                    <h1 class="hero-title">
                        Temukan Dress untuk <em>Setiap Momen</em>
                    </h1>
                </div>

                <a href="/katalog" class="hero-collection-link">
                    <span>Lihat Semua Koleksi</span>
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

            <!-- Grid Kategori Dress -->
            <div class="hero-category-grid">
                <a
                    v-for="cat in heroCategories"
                    :key="cat.id"
                    :href="'/katalog?kategori=' + encodeURIComponent(cat.name)"
                    class="hero-category-card"
                >
                    <img
                        :src="cat.image"
                        :alt="cat.name"
                        class="hero-category-image"
                        loading="lazy"
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
                <a href="/katalog" class="hero-mobile-link">
                    Lihat semua koleksi →
                </a>
            </div>

        </div>
    </section>
</template>

<script setup>
// Kategori gaun unggulan Dressell dengan aset foto studio nyata
const heroCategories = [
    {
        id: 1,
        name: 'Dress Pesta',
        count: 48,
        image: '/assets/img/dressell/drs-001.jpg',
    },
    {
        id: 2,
        name: 'Kebaya Modern',
        count: 35,
        image: '/assets/img/dressell/kby-012.jpg',
    },
    {
        id: 3,
        name: 'Gaun Pernikahan',
        count: 27,
        image: '/assets/img/dressell/gwn-003.jpg',
    },
    {
        id: 4,
        name: 'Dress Formal',
        count: 56,
        image: '/assets/img/dressell/frm-009.jpg',
    },
];
</script>
