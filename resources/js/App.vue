<template>
    <div class="min-h-screen bg-white font-sans antialiased">
        <TheNavbar />
        <main>
            <!-- Hero: Kategori dress langsung di atas fold -->
            <HeroSection />
            <!-- Pilihan Editor: koleksi tren (menggantikan Categories section lama) -->
            <CategoriesSection />
            <!-- Koleksi produk lengkap -->
            <CollectionSection />
            <!-- Promo banner -->
            <PromoBanner />
        </main>
        <TheFooter />
    </div>
</template>

<script setup>
import TheNavbar from './components/TheNavbar.vue';
import HeroSection from './components/HeroSection.vue';
import CategoriesSection from './components/CategoriesSection.vue';
import CollectionSection from './components/CollectionSection.vue';
import PromoBanner from './components/PromoBanner.vue';
import TheFooter from './components/TheFooter.vue';

// Catatan: FeaturesSection, HowToSection, NewsletterSection dihapus dari homepage
// sesuai dengan scope redesain. File komponen tidak dihapus untuk keamanan.
</script>