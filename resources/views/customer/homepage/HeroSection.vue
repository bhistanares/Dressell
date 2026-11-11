<template>
    <section class="hero-section" id="kategori">
        <div class="hero-container">

            <!-- Intro Header Section -->
            <div class="hero-intro">
                <div>
                    <span v-if="eyebrow" class="hero-eyebrow">{{ eyebrow }}</span>
                    <h1 class="hero-title" v-html="title"></h1>
                </div>

                <a v-if="showViewAll" href="/katalog" class="hero-collection-link">
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

            <!-- Grid 8 Kategori Dress (Susunan 4x2 di Desktop, 2 Kolom di Mobile) -->
            <div class="hero-category-grid">
                <a
                    v-for="cat in heroCategories"
                    :key="cat.id"
                    :href="'/katalog?kategori=' + encodeURIComponent(cat.name)"
                    class="hero-category-card"
                    :title="cat.name + ' — ' + cat.description"
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
            <div v-if="showViewAll" class="hero-mobile-link-wrapper">
                <a href="/katalog" class="hero-mobile-link">
                    Lihat semua koleksi →
                </a>
            </div>

        </div>
    </section>
</template>

<script setup>
defineProps({
    title: {
        type: String,
        default: 'Temukan Dress untuk <em>Setiap Momen</em>',
    },
    eyebrow: {
        type: String,
        default: '',
    },
    showViewAll: {
        type: Boolean,
        default: true,
    },
});

// 8 Kategori Resmi Dressell (Elegant Gowns, Modern Kebaya, Wedding Dress, Party Dress, Hijab-Friendly, Special Moments, Minimalist Suits, International Traditional)
const heroCategories = [
    {
        id: 1,
        name: 'Elegant Gowns',
        description: 'Gaun panjang untuk dinner, prom, dan acara formal.',
        count: 42,
        image: '/assets/img/dressell/frm-009.jpg',
    },
    {
        id: 2,
        name: 'Modern Kebaya',
        description: 'Kebaya modern dengan setelan atasan dan bawahan.',
        count: 35,
        image: '/assets/img/dressell/kby-012.jpg',
    },
    {
        id: 3,
        name: 'Wedding Dress',
        description: 'Gaun pengantin untuk akad, resepsi, dan pre-wedding.',
        count: 28,
        image: '/assets/img/dressell/gwn-003.jpg',
    },
    {
        id: 4,
        name: 'Party Dress',
        description: 'Dress dengan panjang mini hingga midi untuk pesta dan perayaan.',
        count: 39,
        image: '/assets/img/dressell/drs-017.jpg',
    },
    {
        id: 5,
        name: 'Hijab-Friendly',
        description: 'Dress panjang dan tertutup, termasuk pilihan hijab atau pashmina.',
        count: 45,
        image: '/assets/img/dressell/drs-001.jpg',
    },
    {
        id: 6,
        name: 'Special Moments',
        description: 'Dress maternity dan busana flowy untuk sesi pemotretan.',
        count: 24,
        image: '/assets/img/dressell/mxd-015.jpg',
    },
    {
        id: 7,
        name: 'Minimalist Suits',
        description: 'Dress satin minimalis dan setelan blazer.',
        count: 31,
        image: '/assets/img/dressell/csl-008.jpg',
    },
    {
        id: 8,
        name: 'International Traditional',
        description: 'Hanbok, Cheongsam/Qipao, Kimono, dan Ao Dai.',
        count: 20,
        image: '/assets/img/dressell/ed-batik.jpg',
    },
];
</script>
