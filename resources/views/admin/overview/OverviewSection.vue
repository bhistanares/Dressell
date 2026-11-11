<template>
    <div class="space-y-10 pb-14">

        <!-- ═══════════════════════════════════════════════════════════════
             SECTION 1 — EDITORIAL HERO / WELCOME HEADER
             Pembuka dashboard: heading serif besar dengan aksen champagne
             ═══════════════════════════════════════════════════════════════ -->
        <section class="pb-8 border-b border-[#E4D8C6]">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6">

                <!-- Left: Editorial Heading dengan Champagne Left Border -->
                <div class="border-l-2 border-[#C2A878] pl-5">
                    <span class="text-[10px] font-semibold uppercase tracking-[0.28em] text-[#8A7B6C] block mb-3">
                        Ringkasan Operasional
                    </span>
                    <h2 class="font-serif text-3xl sm:text-4xl font-medium tracking-tight text-[#26221F] leading-tight">
                        Sirkulasi &amp;<br />Jadwal Fitting
                    </h2>
                    <!-- Editorial short rule + description -->
                    <div class="mt-3.5 flex items-start gap-3">
                        <div class="w-7 h-px bg-[#C2A878] mt-2.5 shrink-0"></div>
                        <p class="text-sm text-[#6B5F53] leading-relaxed max-w-sm">
                            Pantau penyewaan aktif, janji temu fitting, dan pesanan yang memerlukan tindak lanjut.
                        </p>
                    </div>
                </div>

                <!-- Right: Stat Callouts Kompak -->
                <div class="flex gap-6 sm:flex-col sm:gap-3 sm:text-right border-t sm:border-t-0 sm:border-l border-[#E4D8C6] pt-5 sm:pt-0 sm:pl-6 shrink-0">
                    <div>
                        <span class="font-serif text-2xl sm:text-3xl font-medium text-[#26221F] block leading-none">
                            {{ stats.activeRentals }}
                        </span>
                        <span class="text-[10px] uppercase tracking-[0.2em] text-[#8A7B6C] block mt-1.5">
                            Aktif Disewa
                        </span>
                    </div>
                    <div>
                        <span class="font-serif text-2xl sm:text-3xl font-medium text-[#26221F] block leading-none">
                            {{ stats.todayFittings }}
                        </span>
                        <span class="text-[10px] uppercase tracking-[0.2em] text-[#8A7B6C] block mt-1.5">
                            Fitting Hari Ini
                        </span>
                    </div>
                </div>

            </div>
        </section>

        <!-- ═══════════════════════════════════════════════════════════════
             SECTION 2 — STAT CARDS (ASYMMETRIC GRID)
             Card 1 (Penyewaan Aktif) = 2/5 lebar di desktop, full di tablet
             Cards 2-4 = masing-masing 1/5 lebar di desktop
             ═══════════════════════════════════════════════════════════════ -->
        <section aria-labelledby="stat-summary-heading">
            <h3 id="stat-summary-heading" class="sr-only">Ringkasan Statistik Operasional</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-5">

                <!-- Stat 1: Penyewaan Aktif — Featured, col-span-2 di desktop & tablet -->
                <StatCard
                    class="sm:col-span-2 lg:col-span-2"
                    title="Penyewaan Aktif"
                    :value="stats.activeRentals"
                    unit="Gaun"
                    description="4 gaun dijadwalkan kembali hari ini"
                    badge="Sirkulasi"
                    variant="champagne"
                    :featured="true"
                >
                    <template #icon>
                        <svg class="w-4 h-4 text-[#C2A878]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </template>
                </StatCard>

                <!-- Stat 2: Fitting Hari Ini -->
                <StatCard
                    title="Fitting Hari Ini"
                    :value="stats.todayFittings"
                    unit="Sesi"
                    description="2 sesi pagi · 4 sesi sore &amp; malam"
                    badge="Appointment"
                    variant="taupe"
                >
                    <template #icon>
                        <svg class="w-4 h-4 text-[#8A7B6C]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                    </template>
                </StatCard>

                <!-- Stat 3: Menunggu Konfirmasi -->
                <StatCard
                    title="Perlu Konfirmasi"
                    :value="stats.pendingOrders"
                    unit="Pesanan"
                    description="Verifikasi ukuran badan &amp; bukti deposit"
                    badge="Tindakan"
                    variant="blush"
                >
                    <template #icon>
                        <svg class="w-4 h-4 text-[#D48B96]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                    </template>
                </StatCard>

                <!-- Stat 4: Gaun Siap Sewa — Charcoal (inverted), full-width di tablet -->
                <StatCard
                    class="sm:col-span-2 lg:col-span-1"
                    title="Gaun Siap Sewa"
                    :value="stats.availableDresses"
                    unit="Gaun"
                    description="Telah selesai proses dry-cleaning"
                    badge="Ready"
                    variant="charcoal"
                >
                    <template #icon>
                        <svg class="w-4 h-4 text-[#C2A878]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </template>
                </StatCard>

            </div>
        </section>

        <!-- ═══════════════════════════════════════════════════════════════
             SECTION 3 — TWO-COLUMN: FITTING TIMELINE + PENYEWAAN TERBARU
             ═══════════════════════════════════════════════════════════════ -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">

            <!-- ─────────────────────────────────────────────────────────
                 LEFT: Jadwal Fitting Hari Ini (Timeline Editorial)
                 ───────────────────────────────────────────────────────── -->
            <section class="lg:col-span-5 bg-[#FBF8F2] border border-[#E4D8C6] rounded-2xl overflow-hidden shadow-xs">

                <!-- Panel Header -->
                <div class="px-6 pt-5 pb-4 border-b border-[#E4D8C6] flex items-center justify-between">
                    <div>
                        <span class="text-[9px] font-bold tracking-[0.3em] uppercase text-[#8A7B6C] block mb-0.5">
                            Jadwal Janji Temu
                        </span>
                        <h3 class="font-serif text-xl font-medium text-[#26221F]">
                            Fitting Hari Ini
                        </h3>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-[#F4EFE6] text-[#8A7B6C] border border-[#E4D8C6]">
                        {{ todayFittings.length }} Pelanggan
                    </span>
                </div>

                <!-- Timeline Items -->
                <div class="divide-y divide-[#E4D8C6]/50">
                    <div
                        v-for="fitting in todayFittings"
                        :key="fitting.id"
                        class="px-6 py-4 hover:bg-[#F4EFE6]/30 transition-colors"
                    >
                        <div class="flex items-start gap-4">
                            <!-- Time (visual anchor) -->
                            <div class="shrink-0 w-11 pt-0.5">
                                <span class="font-mono text-sm font-bold text-[#26221F] block leading-none">
                                    {{ fitting.time }}
                                </span>
                                <span class="text-[8.5px] text-[#A89B8D] uppercase tracking-wide block mt-1">
                                    WIB
                                </span>
                            </div>

                            <!-- Status Dot -->
                            <div class="shrink-0 mt-1">
                                <div
                                    :class="[
                                        'w-2 h-2 rounded-full border-2',
                                        fitting.status === 'ongoing'
                                            ? 'bg-[#C2A878] border-[#C2A878]'
                                            : fitting.status === 'confirmed'
                                                ? 'bg-[#26221F] border-[#26221F]'
                                                : fitting.status === 'pending'
                                                    ? 'bg-[#F7EFEF] border-[#D48B96]'
                                                    : 'bg-[#E4D8C6] border-[#D9CAB4]'
                                    ]"
                                ></div>
                            </div>

                            <!-- Customer Info -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="min-w-0">
                                        <h4 class="text-sm font-semibold text-[#26221F] leading-tight truncate">
                                            {{ fitting.customerName }}
                                        </h4>
                                        <p class="text-xs text-[#6B5F53] mt-0.5 truncate">
                                            {{ fitting.dressName }}
                                        </p>
                                    </div>
                                    <!-- Status Badge -->
                                    <span
                                        :class="[
                                            'shrink-0 text-[9px] font-bold tracking-widest uppercase px-2 py-0.5 rounded-full border',
                                            getFittingStatusClass(fitting.status)
                                        ]"
                                    >
                                        {{ fitting.statusLabel }}
                                    </span>
                                </div>
                                <!-- Secondary info: room, stylist, notes -->
                                <div class="mt-2 flex flex-wrap items-center gap-x-2.5 gap-y-1 text-[10px] text-[#8A7B6C]">
                                    <span>{{ fitting.room }}</span>
                                    <span class="text-[#D9CAB4]">&middot;</span>
                                    <span>{{ fitting.stylist }}</span>
                                    <template v-if="fitting.notes">
                                        <span class="text-[#D9CAB4]">&middot;</span>
                                        <span class="italic truncate max-w-[130px]">{{ fitting.notes }}</span>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

            <!-- ─────────────────────────────────────────────────────────
                 RIGHT: Penyewaan Terbaru (Sirkulasi Dress)
                 ───────────────────────────────────────────────────────── -->
            <section class="lg:col-span-7 bg-[#FBF8F2] border border-[#E4D8C6] rounded-2xl overflow-hidden shadow-xs">

                <!-- Panel Header -->
                <div class="px-6 pt-5 pb-4 border-b border-[#E4D8C6] flex items-center justify-between">
                    <div>
                        <span class="text-[9px] font-bold tracking-[0.3em] uppercase text-[#8A7B6C] block mb-0.5">
                            Sirkulasi Gaun
                        </span>
                        <h3 class="font-serif text-xl font-medium text-[#26221F]">
                            Penyewaan Terbaru
                        </h3>
                    </div>
                    <span class="text-xs text-[#8A7B6C] hidden sm:block">
                        Menampilkan transaksi terkini
                    </span>
                </div>

                <!-- Table Container -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-[#26221F]">
                        <thead>
                            <tr class="border-b border-[#E4D8C6] bg-[#F4EFE6]/40">
                                <th class="px-6 py-3 text-[9px] font-bold uppercase tracking-[0.2em] text-[#8A7B6C]">
                                    Kode &amp; Pelanggan
                                </th>
                                <th class="px-3 py-3 text-[9px] font-bold uppercase tracking-[0.2em] text-[#8A7B6C]">
                                    Gaun Sewa
                                </th>
                                <th class="px-3 py-3 text-[9px] font-bold uppercase tracking-[0.2em] text-[#8A7B6C] hidden sm:table-cell">
                                    Jadwal
                                </th>
                                <th class="px-6 py-3 text-[9px] font-bold uppercase tracking-[0.2em] text-[#8A7B6C] text-right">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E4D8C6]/60">
                            <tr
                                v-for="rental in recentRentals"
                                :key="rental.id"
                                class="hover:bg-[#F4EFE6]/40 transition-colors"
                            >
                                <!-- Kode & Customer -->
                                <td class="px-6 py-4">
                                    <span class="font-mono text-[10px] font-medium text-[#A89B8D] block leading-none mb-1">
                                        {{ rental.code }}
                                    </span>
                                    <span class="font-semibold text-[#26221F] block text-[13px] leading-tight">
                                        {{ rental.customerName }}
                                    </span>
                                </td>

                                <!-- Gaun -->
                                <td class="px-3 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-11 rounded-lg overflow-hidden bg-[#D9CAB4] shrink-0 border border-[#E4D8C6]">
                                            <img
                                                :src="rental.dressImage"
                                                alt=""
                                                class="w-full h-full object-cover object-center"
                                            />
                                        </div>
                                        <div class="min-w-0">
                                            <span class="font-medium text-[#26221F] block leading-tight text-[12px] line-clamp-2">
                                                {{ rental.dressName }}
                                            </span>
                                            <span class="text-[10px] text-[#8A7B6C] block mt-0.5">
                                                Size {{ rental.size }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Tanggal (hidden on mobile) -->
                                <td class="px-3 py-4 hidden sm:table-cell">
                                    <span class="text-[12px] text-[#26221F] block leading-tight">
                                        {{ rental.dateRange }}
                                    </span>
                                    <span class="text-[10px] text-[#8A7B6C] block mt-0.5">
                                        {{ rental.duration }}
                                    </span>
                                </td>

                                <!-- Status Badge -->
                                <td class="px-6 py-4 text-right">
                                    <span
                                        :class="[
                                            'inline-block text-[9.5px] font-bold tracking-widest uppercase px-2.5 py-1 rounded-full border whitespace-nowrap',
                                            getRentalStatusClass(rental.status)
                                        ]"
                                    >
                                        {{ rental.statusLabel }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </section>

        </div>

    </div>
</template>

<script setup>
import { reactive } from 'vue';
import StatCard from '../components/StatCard.vue';

/**
 * =========================================================================
 * DATA DUMMY AWAL (Untuk Tahap 1 Tampilan Dashboard Admin)
 * Catatan: Struktur data ini dibuat rapi dan modular agar nantinya mudah
 * digantikan oleh data dari Laravel Controller / API Inertia / Blade payload.
 * =========================================================================
 */

// 1. Data Ringkasan Statistik Operasional
const stats = reactive({
    activeRentals: 18,
    todayFittings: 6,
    pendingOrders: 4,
    availableDresses: 42,
});

// 2. Data Jadwal Fitting Appointment Hari Ini
const todayFittings = reactive([
    {
        id: 1,
        time: '11:00',
        customerName: 'Anindya Larasati',
        dressName: 'Aurelia Champagne Evening Gown',
        room: 'Bilik Fitting No. 1',
        stylist: 'Nadia (Senior Stylist)',
        status: 'ongoing',
        statusLabel: 'Sedang Berlangsung',
        notes: 'Fitting final untuk resepsi',
    },
    {
        id: 2,
        time: '13:30',
        customerName: 'Kezia Nathalia',
        dressName: 'Veloutine Noir Mermaid',
        room: 'Bilik Fitting No. 2',
        stylist: 'Sarah',
        status: 'confirmed',
        statusLabel: 'Terkonfirmasi',
        notes: 'Penyesuaian panjang hem gaun',
    },
    {
        id: 3,
        time: '15:00',
        customerName: 'Dian Paramita',
        dressName: 'Celeste Silk Minimalist Dress',
        room: 'Bilik Fitting No. 1',
        stylist: 'Nadia (Senior Stylist)',
        status: 'confirmed',
        statusLabel: 'Terkonfirmasi',
        notes: 'Fitting pertama acara gala',
    },
    {
        id: 4,
        time: '16:30',
        customerName: 'Melani Cynthia',
        dressName: 'Rosette Ivory Bridal Edit',
        room: 'Bilik Fitting VIP',
        stylist: 'Madame Elena',
        status: 'pending',
        statusLabel: 'Menunggu Konfirmasi',
        notes: 'Pelanggan meminta opsi veil tambahan',
    },
]);

// 3. Data Penyewaan Terbaru
const recentRentals = reactive([
    {
        id: 1,
        code: '#DS-2026-081',
        customerName: 'Sabrina Putri',
        dressName: 'Aurelia Champagne Gown',
        dressImage: '/assets/img/login-photo.jpg',
        size: 'S',
        dateRange: '05 Nov – 08 Nov',
        duration: '3 Hari',
        status: 'active',
        statusLabel: 'Sedang Disewa',
    },
    {
        id: 2,
        code: '#DS-2026-080',
        customerName: 'Felicia Tan',
        dressName: 'Veloutine Noir Silhouette',
        dressImage: '/assets/img/img-2.jpeg',
        size: 'M',
        dateRange: '06 Nov – 09 Nov',
        duration: '3 Hari',
        status: 'ready_pickup',
        statusLabel: 'Siap Diambil',
    },
    {
        id: 3,
        code: '#DS-2026-079',
        customerName: 'Jessica Wijaya',
        dressName: 'Seraphina Emerald Silk',
        dressImage: '/assets/img/login-photo.jpg',
        size: 'M',
        dateRange: '03 Nov – 06 Nov',
        duration: '3 Hari',
        status: 'due_today',
        statusLabel: 'Kembali Hari Ini',
    },
    {
        id: 4,
        code: '#DS-2026-078',
        customerName: 'Amanda Clarissa',
        dressName: 'Rosette Ivory Modern',
        dressImage: '/assets/img/img-2.jpeg',
        size: 'XS',
        dateRange: '31 Okt – 04 Nov',
        duration: '4 Hari',
        status: 'completed',
        statusLabel: 'Selesai',
    },
]);

// 4. Data Koleksi Gaun Pilihan — dihapus sesuai keputusan desain (tidak ada fungsi Admin nyata, semua dummy)

// Helper Style Status Fitting
function getFittingStatusClass(status) {
    switch (status) {
        case 'ongoing':
            return 'bg-[#C2A878]/20 text-[#8A7B6C] border-[#C2A878]/40';
        case 'confirmed':
            return 'bg-[#26221F] text-[#FBF8F2] border-[#26221F]';
        case 'pending':
            return 'bg-[#F7EFEF] text-[#963A44] border-[#E2B2B8]';
        default:
            return 'bg-[#E4D8C6]/50 text-[#6B5F53] border-[#D9CAB4]';
    }
}

// Helper Style Status Sewa
function getRentalStatusClass(status) {
    switch (status) {
        case 'active':
            return 'bg-[#C2A878]/15 text-[#8A7B6C] border-[#C2A878]/30';
        case 'ready_pickup':
            return 'bg-[#26221F] text-[#FBF8F2] border-[#26221F]';
        case 'due_today':
            return 'bg-[#F7EFEF] text-[#963A44] border-[#E2B2B8]';
        case 'completed':
            return 'bg-[#E4D8C6]/40 text-[#6B5F53] border-[#D9CAB4]';
        default:
            return 'bg-[#FBF8F2] text-[#26221F] border-[#E4D8C6]';
    }
}
</script>
