<template>
    <!-- Featured Collection Section (Pilihan Editor) -->
    <section class="featured-section" id="pilihan-editor">
        <div class="featured-container">

            <!-- Section Header -->
            <div class="featured-header">
                <div>
                    <span class="featured-eyebrow">Pilihan Editor</span>
                    <h2 class="featured-title">Koleksi yang Sedang Tren</h2>
                </div>

                <a href="/katalog" class="featured-all-link">
                    <span>Lihat Semua</span>
                    <svg class="featured-link-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Asymmetric Editorial Grid: 1 Main Feature + 3 Companion Cards -->
            <div class="featured-grid">

                <!-- 1. Card Utama (Hero Feature) -->
                <a
                    :href="'/katalog?search=' + encodeURIComponent(featuredItems[0].name)"
                    class="featured-card featured-card-main"
                >
                    <img
                        :src="featuredItems[0].image"
                        :alt="featuredItems[0].name"
                        class="featured-image featured-image-main"
                        loading="lazy"
                    />

                    <div class="featured-overlay featured-overlay-main"></div>

                    <div class="featured-content featured-content-main">
                        <span v-if="featuredItems[0].tag" class="featured-tag">
                            {{ featuredItems[0].tag }}
                        </span>

                        <h3 class="featured-name featured-name-main">
                            {{ featuredItems[0].name }}
                        </h3>

                        <p class="featured-category featured-category-main">
                            {{ featuredItems[0].category }}
                        </p>
                    </div>
                </a>

                <!-- 2. Grid 3 Card Pendamping -->
                <div class="featured-subgrid">
                    <a
                        v-for="item in featuredItems.slice(1)"
                        :key="item.id"
                        :href="'/katalog?search=' + encodeURIComponent(item.name)"
                        class="featured-card featured-card-small"
                    >
                        <img
                            :src="item.image"
                            :alt="item.name"
                            class="featured-image"
                            loading="lazy"
                        />

                        <div class="featured-overlay featured-overlay-small"></div>

                        <div class="featured-content featured-content-small">
                            <span v-if="item.tag" class="featured-tag featured-tag-small">
                                {{ item.tag }}
                            </span>
                            <h3 class="featured-name featured-name-small">
                                {{ item.name }}
                            </h3>

                            <p class="featured-category featured-category-small">
                                {{ item.category }}
                            </p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>
</template>

<script setup>
// Koleksi pilihan editor dengan kurasi gaun terbaik Dressell
const featuredItems = [
    {
        id: 1,
        name: 'Gaun Pengantin Aurora',
        category: 'Gaun Pernikahan',
        tag: 'Paling Diminati',
        image: '/assets/img/dressell/ed-aurora.jpg',
    },
    {
        id: 2,
        name: 'Kebaya Songket Merah',
        category: 'Kebaya Modern',
        tag: null,
        image: '/assets/img/dressell/ed-kebaya.jpg',
    },
    {
        id: 3,
        name: 'Midi Dress Batik Parang',
        category: 'Batik & Tenun',
        tag: null,
        image: '/assets/img/dressell/ed-batik.jpg',
    },
    {
        id: 4,
        name: 'Maxi Dress Floral',
        category: 'Maxi Dress',
        tag: null,
        image: '/assets/img/dressell/mxd-015.jpg',
    },
];
</script>
