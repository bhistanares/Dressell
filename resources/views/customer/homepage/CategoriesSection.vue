<template>
    <!-- Featured Collection Section (Pilihan Editor / Koleksi Tren & Populer) -->
    <section class="featured-section" id="koleksi-tren">
        <div class="featured-container">

            <!-- Section Header -->
            <div class="featured-header">
                <div>
                    <span class="featured-eyebrow">{{ eyebrow }}</span>
                    <h2 class="featured-title">{{ title }}</h2>
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
                            <span class="featured-code">{{ featuredItems[0].modelCode }}</span> &bull; {{ featuredItems[0].category }}
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
                                <span class="featured-code">{{ item.modelCode }}</span> &bull; {{ item.category }}
                            </p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>
</template>

<script setup>
defineProps({
    title: {
        type: String,
        default: 'Koleksi yang Sedang Tren',
    },
    eyebrow: {
        type: String,
        default: 'Pilihan Editor',
    },
});

// Koleksi pilihan editorial dengan kode dress dummy konsisten dan 8 kategori resmi
const featuredItems = [
    {
        id: 1,
        modelCode: 'WCE-003',
        name: 'Gaun Celeste',
        category: 'Wedding Dress',
        tag: 'Paling Diminati',
        image: '/assets/img/dressell/ed-aurora.jpg',
    },
    {
        id: 2,
        modelCode: 'KSO-002',
        name: 'Kebaya Songket',
        category: 'Modern Kebaya',
        tag: 'Koleksi Unggulan',
        image: '/assets/img/dressell/ed-kebaya.jpg',
    },
    {
        id: 3,
        modelCode: 'EVE-007',
        name: 'Velvet Navy',
        category: 'Elegant Gowns',
        tag: 'Gaun Malam',
        image: '/assets/img/dressell/frm-009.jpg',
    },
    {
        id: 4,
        modelCode: 'SFL-006',
        name: 'Flowy Garden',
        category: 'Special Moments',
        tag: 'Gaun Studio',
        image: '/assets/img/dressell/mxd-015.jpg',
    },
];
</script>
