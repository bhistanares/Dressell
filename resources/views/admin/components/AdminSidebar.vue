<template>
    <aside
        :class="[
            'relative z-30 flex flex-col bg-[#F4EFE6] border-r border-[#E4D8C6] transition-all duration-300 ease-in-out shrink-0 select-none',
            isCollapsed ? 'w-20' : 'w-64 lg:w-72'
        ]"
    >
        <!-- 1. Brand Identity -->
        <div class="h-16 flex items-center px-4 border-b border-[#E4D8C6] justify-between gap-2 overflow-hidden">
            <div class="flex items-center gap-3 overflow-hidden min-w-0">
                <!-- Logo container with frame -->
                <div class="shrink-0 w-9 h-9 rounded-lg bg-[#FBF8F2] border border-[#E4D8C6] shadow-sm flex items-center justify-center">
                    <img
                        :src="'/assets/img/logo-dressell.png'"
                        alt="Dressell Logo"
                        width="22"
                        height="22"
                        class="w-[22px] h-[22px] object-contain"
                    />
                </div>

                <div v-show="!isCollapsed" class="overflow-hidden min-w-0">
                    <span class="block font-serif text-[19px] font-medium tracking-tight text-[#26221F] leading-none whitespace-nowrap">
                        Dressell
                    </span>
                    <span class="block text-[8.5px] uppercase tracking-[0.32em] text-[#C2A878] font-semibold mt-1.5 leading-none whitespace-nowrap">
                        Admin Panel
                    </span>
                </div>
            </div>

            <!-- Collapse / Expand Button (Desktop) -->
            <button
                type="button"
                @click="$emit('toggle-collapse')"
                class="hidden md:inline-flex shrink-0 items-center justify-center w-7 h-7 rounded-full border border-[#D9CAB4] text-[#8A7B6C] hover:text-[#26221F] hover:bg-[#E4D8C6]/60 transition-colors cursor-pointer"
                :title="isCollapsed ? 'Perluas Sidebar' : 'Ciutkan Sidebar'"
                aria-label="Toggle Sidebar"
            >
                <svg
                    :class="['w-3.5 h-3.5 transition-transform duration-300', isCollapsed ? 'rotate-180' : '']"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
        </div>

        <!-- 2. Navigation Area -->
        <nav class="flex-1 overflow-y-auto py-5">
            <!-- Decorative Separator with Label -->
            <div :class="['mb-3', isCollapsed ? 'px-4' : 'px-5']">
                <div v-if="!isCollapsed" class="flex items-center gap-2.5">
                    <span class="h-px flex-1 bg-[#E4D8C6]"></span>
                    <span class="text-[8px] font-bold tracking-[0.38em] uppercase text-[#C2A878]">Menu</span>
                    <span class="h-px flex-1 bg-[#E4D8C6]"></span>
                </div>
                <div v-else class="h-px bg-[#E4D8C6]"></div>
            </div>

            <!-- Menu Items -->
            <ul :class="['space-y-0.5', isCollapsed ? 'px-2' : 'px-3']">
                <li v-for="item in navigationItems" :key="item.id">
                    <button
                        type="button"
                        @click="handleMenuClick(item)"
                        :class="[
                            'w-full flex items-center gap-3 text-left transition-all duration-200 group cursor-pointer relative overflow-hidden',
                            isCollapsed ? 'justify-center px-0 py-3 rounded-xl' : 'px-3 py-2.5 rounded-xl',
                            item.active
                                ? 'bg-[#FBF8F2] shadow-sm'
                                : 'hover:bg-[#E4D8C6]/30'
                        ]"
                        :title="isCollapsed ? item.label : ''"
                    >
                        <!-- Left Active Indicator Bar (expanded only) -->
                        <span
                            v-if="!isCollapsed"
                            :class="[
                                'absolute left-0 inset-y-2 w-[3px] rounded-r-full transition-all duration-300',
                                item.active ? 'bg-[#C2A878]' : 'bg-transparent'
                            ]"
                        ></span>

                        <!-- Icon Container -->
                        <span
                            :class="[
                                'shrink-0 flex items-center justify-center transition-colors duration-200',
                                isCollapsed ? 'w-9 h-9 rounded-xl' : 'w-5 h-5',
                                item.active
                                    ? (isCollapsed ? 'bg-[#FBF8F2] text-[#C2A878] shadow-sm' : 'text-[#C2A878]')
                                    : (isCollapsed ? 'text-[#8A7B6C] group-hover:bg-[#E4D8C6]/50 group-hover:text-[#26221F]' : 'text-[#8A7B6C] group-hover:text-[#26221F]')
                            ]"
                        >
                            <!-- Dashboard Icon -->
                            <svg v-if="item.icon === 'dashboard'" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <rect x="3" y="3" width="7" height="9" rx="1.5" />
                                <rect x="14" y="3" width="7" height="5" rx="1.5" />
                                <rect x="14" y="12" width="7" height="9" rx="1.5" />
                                <rect x="3" y="16" width="7" height="5" rx="1.5" />
                            </svg>
                        </span>

                        <!-- Label & Active Dot (expanded only) -->
                        <div v-show="!isCollapsed" class="flex-1 flex items-center justify-between overflow-hidden min-w-0">
                            <span
                                :class="[
                                    'text-sm tracking-wide truncate transition-colors duration-200',
                                    item.active ? 'font-semibold text-[#26221F]' : 'font-medium text-[#6B5F53] group-hover:text-[#26221F]'
                                ]"
                            >
                                {{ item.label }}
                            </span>
                            <!-- Champagne dot: active indicator -->
                            <span
                                v-if="item.active"
                                class="w-1.5 h-1.5 rounded-full bg-[#C2A878] shrink-0 ml-2"
                            ></span>
                        </div>
                    </button>
                </li>
            </ul>

            <!-- Catatan Pengembang: Struktur siap untuk menu lanjutan (Katalog, Penyewaan, Fitting, dsb.) -->
        </nav>

        <!-- 3. Bottom Brand Footer (expanded only) -->
        <div
            v-show="!isCollapsed"
            class="px-5 py-3.5 border-t border-[#E4D8C6]/60"
        >
            <span class="text-[9px] tracking-[0.22em] uppercase text-[#A89B8D] font-medium">
                Dressell &middot; v1.0
            </span>
        </div>
    </aside>
</template>

<script setup>
import { ref } from 'vue';

defineProps({
    isCollapsed: {
        type: Boolean,
        default: false,
    },
});

defineEmits(['toggle-collapse', 'navigate']);

/**
 * Struktur Navigasi Menu Admin Dressell
 * Sesuai arahan tahap 1: Hanya menu Dashboard yang aktif.
 * Struktur ini sudah disiapkan agar mudah ditambahkan menu baru nantinya.
 */
const navigationItems = ref([
    {
        id: 'dashboard',
        label: 'Dashboard',
        icon: 'dashboard',
        active: true,
        badge: 'Aktif',
    },
    /*
     * Menu lanjutan dapat ditambahkan di sini saat pengerjaan fitur berikutnya:
     * { id: 'catalog', label: 'Katalog Gaun', icon: 'catalog', active: false },
     * { id: 'rentals', label: 'Penyewaan', icon: 'rentals', active: false },
     * { id: 'fittings', label: 'Jadwal Fitting', icon: 'fittings', active: false },
     * { id: 'customers', label: 'Pelanggan', icon: 'customers', active: false },
     */
]);

function handleMenuClick(item) {
    // Navigasi atau pergantian menu
    navigationItems.value.forEach((nav) => {
        nav.active = nav.id === item.id;
    });
}
</script>
