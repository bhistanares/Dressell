<template>
    <div class="homepage">
        <!-- A. Section Kategori Dress (8 Kategori Utama Dressell) -->
        <HeroSection />

        <!-- B. Section Koleksi yang Sedang Tren (Editorial Pilihan) -->
        <CategoriesSection />

        <!-- C. Section Koleksi Dress (Koleksi Dress Pengunjung Tanpa Ikon Wishlist, Harga per 2 hari) -->
        <CollectionSection :user="user" />

        <!-- D. Testimoni (Pengalaman & Ulasan Pelanggan) -->
        <TestimonialsSection />
    </div>
</template>

<script setup>
import HeroSection from './homepage/HeroSection.vue';
import CategoriesSection from './homepage/CategoriesSection.vue';
import CollectionSection from './homepage/CollectionSection.vue';
import TestimonialsSection from './homepage/TestimonialsSection.vue';

defineProps({
    user: {
        type: Object,
        default: null,
    },
});
</script>
