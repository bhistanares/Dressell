<template>
    <div class="min-h-screen bg-[#FBF8F2] text-[#26221F] font-sans antialiased flex flex-row overflow-hidden h-screen">
        <!-- 1. Sidebar Navigasi Admin -->
        <!-- Desktop Sidebar -->
        <AdminSidebar
            :is-collapsed="isSidebarCollapsed"
            @toggle-collapse="isSidebarCollapsed = !isSidebarCollapsed"
            class="hidden md:flex"
        />

        <!-- Mobile Drawer Overlay & Sidebar (Ponsel & Tablet) -->
        <div
            v-if="isMobileSidebarOpen"
            class="fixed inset-0 z-40 bg-[#26221F]/40 backdrop-blur-xs md:hidden transition-opacity"
            @click="isMobileSidebarOpen = false"
            aria-hidden="true"
        ></div>

        <div
            :class="[
                'fixed inset-y-0 left-0 z-50 transform md:hidden transition-transform duration-300 ease-in-out',
                isMobileSidebarOpen ? 'translate-x-0' : '-translate-x-full'
            ]"
        >
            <AdminSidebar
                :is-collapsed="false"
                @toggle-collapse="isMobileSidebarOpen = false"
            />
        </div>

        <!-- 2. Area Konten Utama -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-[#FBF8F2]">
            <!-- Header Topbar Admin -->
            <AdminHeader
                :admin="adminUser"
                :logout-url="logoutUrl"
                :csrf-token="csrfToken"
                @toggle-mobile-sidebar="isMobileSidebarOpen = !isMobileSidebarOpen"
            />

            <!-- Main Scrollable Content Viewport -->
            <main class="flex-1 overflow-y-auto px-5 sm:px-8 py-6 sm:py-8">
                <div class="max-w-7xl mx-auto">
                    <!-- Dynamic Section (Tahap 1: OverviewSection) -->
                    <OverviewSection />
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import AdminSidebar from './components/AdminSidebar.vue';
import AdminHeader from './components/AdminHeader.vue';
import OverviewSection from './overview/OverviewSection.vue';

const props = defineProps({
    initialAdmin: {
        type: Object,
        default: () => ({
            name: 'Admin Dressell',
            email: 'admin@dressell.test',
            role: 'admin',
        }),
    },
    logoutUrl: {
        type: String,
        default: '/admin/logout',
    },
    csrfToken: {
        type: String,
        default: '',
    },
});

// State Sidebar
const isSidebarCollapsed = ref(false);
const isMobileSidebarOpen = ref(false);

const adminUser = computed(() => props.initialAdmin);
</script>
