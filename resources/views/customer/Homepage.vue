<template>
    <div class="homepage">
        <HeroSection />
        <CategoriesSection />
        <CollectionSection :user="user" />
        <PromoBanner />
    </div>
</template>

<script setup>
import HeroSection from './homepage/HeroSection.vue';
import CategoriesSection from './homepage/CategoriesSection.vue';
import CollectionSection from './homepage/CollectionSection.vue';
import PromoBanner from './homepage/PromoBanner.vue';

defineProps({
    user: {
        type: Object,
        default: null,
    },
});
</script>
