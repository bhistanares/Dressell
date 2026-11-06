<template>
    <header class="h-20 bg-[#FBF8F2] border-b border-[#E4D8C6] px-5 sm:px-8 flex items-center justify-between shrink-0 select-none z-20">
        <!-- 1. Left: Mobile Toggle & Editorial Greeting -->
        <div class="flex items-center gap-4">
            <!-- Mobile Toggle Button (Hanya tampil di tablet/ponsel) -->
            <button
                type="button"
                @click="$emit('toggle-mobile-sidebar')"
                class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg border border-[#D9CAB4] text-[#26221F] bg-[#F4EFE6] hover:bg-[#E4D8C6] transition-colors cursor-pointer"
                aria-label="Toggle Mobile Menu"
            >
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <!-- Greeting & Live Date -->
            <div>
                <h1 class="font-serif text-xl sm:text-2xl font-medium tracking-tight text-[#26221F] leading-tight">
                    Selamat datang, <em class="not-italic text-[#8A7B6C]">{{ adminName }}</em>
                </h1>
                <p class="text-xs text-[#8A7B6C] tracking-wider uppercase mt-0.5">
                    {{ formattedDate }} &nbsp;·&nbsp;
                    <span class="text-[#C2A878] font-medium">Fitting Studio Dressell</span>
                </p>
            </div>
        </div>

        <!-- 2. Right: Notification Bell & Admin Profile Dropdown / Actions -->
        <div class="flex items-center gap-3 sm:gap-5">
            <!-- Quick Link / Return to Store Preview -->
            <a
                href="/"
                target="_blank"
                class="hidden lg:inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-[#6B5F53] hover:text-[#26221F] px-3 py-2 rounded-lg hover:bg-[#F4EFE6] transition-colors"
                title="Buka Website Customer di Tab Baru"
            >
                <svg class="w-3.5 h-3.5 text-[#C2A878]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                </svg>
                <span>Lihat Toko</span>
            </a>

            <!-- Notification Bell Component -->
            <div class="relative" ref="notificationDropdownRef">
                <button
                    type="button"
                    @click="isNotificationOpen = !isNotificationOpen"
                    class="relative w-10 h-10 rounded-full border border-[#D9CAB4] bg-[#F4EFE6] text-[#6B5F53] hover:text-[#26221F] hover:bg-[#E4D8C6]/60 flex items-center justify-center transition-colors cursor-pointer"
                    aria-label="Notifikasi Studio"
                >
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                    <!-- Unread notification pip -->
                    <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-[#C2A878] ring-2 ring-[#FBF8F2]"></span>
                </button>

                <!-- Notifications Dropdown Panel -->
                <div
                    v-if="isNotificationOpen"
                    class="absolute right-0 mt-2 w-80 sm:w-96 bg-[#FBF8F2] border border-[#E4D8C6] rounded-xl shadow-xl overflow-hidden z-50 animate-in fade-in slide-in-from-top-2 duration-150"
                >
                    <div class="p-4 border-b border-[#E4D8C6] flex items-center justify-between bg-[#F4EFE6]/60">
                        <div class="flex items-center gap-2">
                            <span class="font-serif text-base font-medium text-[#26221F]">Notifikasi Studio</span>
                            <span class="text-[10px] font-semibold uppercase tracking-wider px-2 py-0.5 rounded-full bg-[#C2A878]/20 text-[#8A7B6C]">
                                3 Baru
                            </span>
                        </div>
                        <button
                            type="button"
                            @click="isNotificationOpen = false"
                            class="text-xs text-[#8A7B6C] hover:text-[#26221F] cursor-pointer"
                        >
                            Tutup
                        </button>
                    </div>

                    <ul class="divide-y divide-[#E4D8C6]/50 max-h-80 overflow-y-auto">
                        <li
                            v-for="notif in dummyNotifications"
                            :key="notif.id"
                            class="p-3.5 hover:bg-[#F4EFE6]/50 transition-colors cursor-pointer"
                        >
                            <div class="flex items-start gap-3">
                                <span class="w-2 h-2 mt-1.5 rounded-full bg-[#C2A878] shrink-0"></span>
                                <div>
                                    <p class="text-xs font-medium text-[#26221F] leading-snug">
                                        {{ notif.title }}
                                    </p>
                                    <p class="text-[11px] text-[#8A7B6C] mt-0.5">
                                        {{ notif.detail }}
                                    </p>
                                    <span class="text-[10px] text-[#A89B8D] mt-1 block">
                                        {{ notif.time }}
                                    </span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Vertical Divider -->
            <div class="h-6 w-px bg-[#E4D8C6]"></div>

            <!-- Admin Profile Area & Logout -->
            <div class="flex items-center gap-3">
                <!-- Avatar & Role -->
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-full bg-[#26221F] text-[#FBF8F2] flex items-center justify-center font-serif text-sm font-medium border border-[#C2A878]/40 shadow-xs">
                        {{ adminInitials }}
                    </div>
                    <div class="hidden sm:block text-left">
                        <span class="block text-xs font-semibold text-[#26221F] leading-tight">
                            {{ adminName }}
                        </span>
                        <span class="block text-[10px] uppercase tracking-wider text-[#8A7B6C]">
                            {{ adminRole === 'admin' ? 'Master Admin' : 'Atelier Staff' }}
                        </span>
                    </div>
                </div>

                <!-- Logout Button (Submits form to preserve existing auth mechanics) -->
                <form :action="logoutUrl" method="POST" class="inline">
                    <input type="hidden" name="_token" :value="csrfToken" />
                    <button
                        type="submit"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-[#D9CAB4] text-[#6B5F53] hover:text-[#963A44] hover:border-[#963A44]/40 hover:bg-[#F4E7E3]/40 text-xs font-medium transition-colors cursor-pointer"
                        title="Keluar dari sesi Admin"
                    >
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        <span class="hidden md:inline">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </header>
</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    admin: {
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

defineEmits(['toggle-mobile-sidebar']);

const isNotificationOpen = ref(false);

const adminName = computed(() => props.admin?.name || 'Admin Dressell');
const adminRole = computed(() => props.admin?.role || 'admin');

const adminInitials = computed(() => {
    const parts = adminName.value.trim().split(' ');
    if (parts.length >= 2) {
        return (parts[0][0] + parts[1][0]).toUpperCase();
    }
    return adminName.value.substring(0, 2).toUpperCase();
});

// Format tanggal lokal (Indonesia)
const formattedDate = computed(() => {
    const today = new Date();
    const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
    return today.toLocaleDateString('id-ID', options);
});

// Notifikasi dummy untuk aktivitas studio
const dummyNotifications = [
    {
        id: 1,
        title: 'Fitting Baru Terdaftar',
        detail: 'Clarissa Agatha memesan sesi fitting gaun Evening Edit pukul 14:00.',
        time: '15 menit yang lalu',
    },
    {
        id: 2,
        title: 'Permintaan Sewa Gaun',
        detail: 'Sewa gaun Veloutine Noir #DR-0104 menunggu konfirmasi pembayaran.',
        time: '1 jam yang lalu',
    },
    {
        id: 3,
        title: 'Pengembalian Gaun Hari Ini',
        detail: 'Gaun Aurelia Champagne dijadwalkan kembali sebelum pukul 18:00.',
        time: '3 jam yang lalu',
    },
];
</script>
