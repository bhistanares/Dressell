<template>
    <div class="min-h-screen bg-white font-sans antialiased">
        <TheNavbar
            :user="user"
            :logout-url="logoutUrl"
            :csrf-token="csrfToken"
        />
        <main>
            <Homepage v-if="page === 'home'" :user="user" />
            <CustomerDashboard v-else-if="page === 'customer-dashboard'" :user="user" />
        </main>
        <TheFooter />
    </div>
</template>

<script setup>
import { toRefs } from 'vue';
import TheNavbar from '../views/components/TheNavbar.vue';
import Homepage from '../views/customer/Homepage.vue';
import CustomerDashboard from '../views/customer/CustomerDashboard.vue';
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
