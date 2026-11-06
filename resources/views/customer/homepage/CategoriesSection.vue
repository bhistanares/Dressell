<template>
    <!-- Featured Collection Section -->
    <section class="featured-section" id="pilihan-editor">
        <div class="featured-container">

            <!-- Section Header -->
            <div class="featured-header">
                <div>
                    <p class="featured-eyebrow">Pilihan Editor</p>
                    <h2 class="featured-title">Koleksi yang Sedang Tren</h2>
                </div>

                <a href="#koleksi" class="featured-all-link">
                    Lihat Semua
                    <svg class="featured-link-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Grid: 1 besar + 3 kecil -->
            <div class="featured-grid">

                <!-- Card besar -->
                <a href="#koleksi" class="featured-card featured-card-main">
                    <img
                        :src="featuredItems[0].image"
                        :alt="featuredItems[0].name"
                        class="featured-image featured-image-main"
                    />

                    <div class="featured-overlay featured-overlay-main"></div>

                    <div class="featured-content featured-content-main">
                        <span class="featured-tag">
                            {{ featuredItems[0].tag }}
                        </span>

                        <p class="featured-name featured-name-main">
                            {{ featuredItems[0].name }}
                        </p>

                        <p class="featured-category featured-category-main">
                            {{ featuredItems[0].category }}
                        </p>
                    </div>
                </a>

                <!-- 3 card kecil -->
                <a
                    v-for="item in featuredItems.slice(1)"
                    :key="item.id"
                    href="#koleksi"
                    class="featured-card featured-card-small"
                >
                    <img
                        :src="item.image"
                        :alt="item.name"
                        class="featured-image"
                    />

                    <div class="featured-overlay featured-overlay-small"></div>

                    <div class="featured-content featured-content-small">
                        <p class="featured-name featured-name-small">
                            {{ item.name }}
                        </p>

                        <p class="featured-category featured-category-small">
                            {{ item.category }}
                        </p>
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
