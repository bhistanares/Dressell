<template>
    <aside
        :class="[
            'relative z-30 flex flex-col bg-[#F4EFE6] border-r border-[#E4D8C6] transition-all duration-300 ease-in-out shrink-0 select-none',
            isCollapsed ? 'w-20' : 'w-64 lg:w-72'
        ]"
    >
        <!-- 1. Brand & Atelier Identity -->
        <div class="h-20 flex items-center px-5 border-b border-[#E4D8C6]/80 justify-between">
            <div class="flex items-center gap-3 overflow-hidden">
                <img
                    :src="'/assets/img/logo-dressell.png'"
                    alt="Dressell Logo"
                    width="36"
                    height="36"
                    class="w-9 h-9 max-w-[36px] max-h-[36px] object-contain shrink-0"
                />
                <div v-show="!isCollapsed" class="transition-opacity duration-200">
                    <span class="block font-serif text-2xl font-medium tracking-tight text-[#26221F] leading-none">
                        Dressell
                    </span>
                    <span class="block text-[10px] uppercase tracking-[0.2em] text-[#8A7B6C] font-semibold mt-1">
                        Atelier Studio
                    </span>
                </div>
            </div>

            <!-- Collapse / Expand Button (Desktop) -->
            <button
                type="button"
                @click="$emit('toggle-collapse')"
                class="hidden md:inline-flex items-center justify-center w-8 h-8 rounded-full border border-[#D9CAB4] text-[#6B5F53] hover:text-[#26221F] hover:bg-[#E4D8C6]/60 transition-colors cursor-pointer"
                :title="isCollapsed ? 'Perluas Sidebar' : 'Ciutkan Sidebar'"
                aria-label="Toggle Sidebar"
            >
                <svg
                    :class="['w-4 h-4 transition-transform duration-300', isCollapsed ? 'rotate-180' : '']"
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
        <nav class="flex-1 py-6 px-3 space-y-1.5 overflow-y-auto">
            <!-- Label Bagian Menu (Hanya Tampil Saat Expanded) -->
            <div v-show="!isCollapsed" class="px-3 pb-2">
                <p class="text-[10px] font-semibold tracking-[0.24em] text-[#8A7B6C] uppercase">
                    Menu Utama
                </p>
            </div>

            <!-- Daftar Menu Dinamis (Tahap 1: Hanya Dashboard Aktif) -->
            <ul class="space-y-1">
                <li v-for="item in navigationItems" :key="item.id">
                    <button
                        type="button"
                        @click="handleMenuClick(item)"
                        :class="[
                            'w-full flex items-center gap-3.5 px-3 py-3 rounded-lg text-left transition-all duration-200 group cursor-pointer',
                            item.active
                                ? 'bg-[#26221F] text-[#FBF8F2] shadow-sm'
                                : 'text-[#6B5F53] hover:bg-[#E4D8C6]/50 hover:text-[#26221F]'
                        ]"
                        :title="isCollapsed ? item.label : ''"
                    >
                        <!-- Icon -->
                        <span
                            :class="[
                                'shrink-0 flex items-center justify-center w-6 h-6 transition-colors',
                                item.active ? 'text-[#C2A878]' : 'text-[#8A7B6C] group-hover:text-[#26221F]'
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

                        <!-- Label & Badge -->
                        <div v-show="!isCollapsed" class="flex-1 flex items-center justify-between overflow-hidden">
                            <span class="text-sm font-medium tracking-wide truncate">
                                {{ item.label }}
                            </span>
                            <span
                                v-if="item.badge"
                                class="text-[10px] font-semibold tracking-wider uppercase px-2 py-0.5 rounded-full bg-[#C2A878]/20 text-[#C2A878] border border-[#C2A878]/30"
                            >
                                {{ item.badge }}
                            </span>
                        </div>
                    </button>
                </li>
            </ul>

            <!-- Catatan Pengembang: Struktur siap untuk menu lanjutan (Katalog, Penyewaan, Fitting, dsb.) -->
        </nav>

        <!-- 3. Bottom Atelier Status Card -->
        <div class="p-3 border-t border-[#E4D8C6]/80">
            <div
                v-if="!isCollapsed"
                class="p-3.5 rounded-xl bg-[#FBF8F2] border border-[#E4D8C6] shadow-2xs space-y-2"
            >
                <div class="flex items-center gap-2">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#C2A878] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[#C2A878]"></span>
                    </span>
                    <span class="text-[11px] font-semibold tracking-wider uppercase text-[#6B5F53]">
                        Studio Aktif
                    </span>
                </div>
                <p class="text-xs text-[#8A7B6C] leading-snug">
                    Layanan sewa gaun & jadwal fitting appointment berjalan normal.
                </p>
            </div>

            <!-- Tampilan Mini Saat Collapsed -->
            <div v-else class="flex justify-center py-2" title="Studio Aktif">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#C2A878] opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-[#C2A878]"></span>
                </span>
            </div>
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
