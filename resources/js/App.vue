<template>
    <div class="min-h-screen bg-white font-sans antialiased">
        <TheNavbar
            :user="user"
            :logout-url="logoutUrl"
            :csrf-token="csrfToken"
        />
        <main>
            <Homepage v-if="page === 'home'" :user="user" />
            <div v-else-if="page === 'customer-dashboard'" class="customer-dashboard">
                <HeroSection />
                <CollectionSection :user="user" />
            </div>
        </main>
        <TheFooter />
    </div>
</template>

<script setup>
import { toRefs } from 'vue';
import TheNavbar from '../views/components/TheNavbar.vue';
import Homepage from '../views/customer/Homepage.vue';
import HeroSection from '../views/customer/homepage/HeroSection.vue';
import CollectionSection from '../views/customer/homepage/CollectionSection.vue';
import TheFooter from '../views/components/TheFooter.vue';

const props = defineProps({
    user: {
        type: Object,
        default: null,
    },
    page: {
        type: String,
        default: 'home',
    },
    logoutUrl: {
        type: String,
        default: '/logout',
    },
    csrfToken: {
        type: String,
        default: '',
    },
});

const { user, page, logoutUrl, csrfToken } = toRefs(props);
</script>
