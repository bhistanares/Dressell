<template>
    <div class="homepage">
        <!-- Hero: Kategori dress langsung di atas fold -->
        <HeroSection />
        <!-- Pilihan Editor: koleksi tren -->
        <CategoriesSection />
        <!-- Koleksi produk lengkap -->
        <CollectionSection />
        <!-- Promo banner -->
        <PromoBanner />
    </div>
</template>

<script setup>
import HeroSection from './sections/HeroSection.vue';
import CategoriesSection from './sections/CategoriesSection.vue';
import CollectionSection from './sections/CollectionSection.vue';
import PromoBanner from './sections/PromoBanner.vue';
</script>
