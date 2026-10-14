<template>
    <div class="min-h-screen bg-white font-sans antialiased">
        <TheNavbar />
        <main>
            <Homepage />
        </main>
        <TheFooter />
    </div>
</template>

<script setup>
import TheNavbar from '../views/components/TheNavbar.vue';
import Homepage from '../views/pages/customer/Homepage.vue';
import TheFooter from '../views/components/TheFooter.vue';

// Catatan: FeaturesSection, HowToSection, NewsletterSection disimpan di components/
// untuk keamanan dan komponen bersama di masa mendatang.
</script>