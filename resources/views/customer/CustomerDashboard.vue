<template>
    <div class="customer-dashboard">
        <!-- A. Pencarian dan Penentuan Tanggal Acara -->
        <CustomerSearchSection :user="user" />

        <!-- B. Koleksi Dress (Kartu Dress dengan Wishlist Hover, Harga per 2 hari, Tanpa Ukuran & Ketersediaan) -->
        <CollectionSection
            :user="user"
            title="Koleksi Dress Pilihan"
            eyebrow="Koleksi Studio"
        />

        <!-- C. Kategori Dress (8 Kategori Resmi Dressell) -->
        <HeroSection
            title="Jelajahi Berdasarkan <em>Kategori</em>"
            eyebrow="Kategori Busana"
            :show-view-all="true"
        />

        <!-- D. Koleksi Dress Populer (Koleksi Editorial Unggulan) -->
        <CategoriesSection
            title="Koleksi Dress Populer"
            eyebrow="Tren Favorit"
        />

        <!-- E. Testimoni (Sama dengan Dashboard Guest) -->
        <TestimonialsSection />
    </div>
</template>

<script setup>
import CustomerSearchSection from './homepage/CustomerSearchSection.vue';
import CollectionSection from './homepage/CollectionSection.vue';
import HeroSection from './homepage/HeroSection.vue';
import CategoriesSection from './homepage/CategoriesSection.vue';
import TestimonialsSection from './homepage/TestimonialsSection.vue';

defineProps({
    user: {
        type: Object,
        default: null,
    },
});
</script>