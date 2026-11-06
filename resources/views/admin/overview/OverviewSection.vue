<template>
    <div class="space-y-8 pb-12">
        <!-- 1. Hero Atelier Welcome Banner -->
        <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#F4EFE6] via-[#FBF8F2] to-[#E4D8C6]/50 border border-[#E4D8C6] p-6 sm:p-8 shadow-xs">
            <!-- Subtle Watermark Graphic in Background -->
            <p class="absolute right-4 bottom-[-15px] font-serif italic text-7xl sm:text-9xl text-[#E4D8C6]/40 select-none pointer-events-none leading-none">
                Atelier
            </p>

            <div class="relative z-10 max-w-2xl">
                <span class="inline-flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.24em] text-[#8A7B6C] mb-2">
                    <span class="w-2 h-2 rounded-full bg-[#C2A878]"></span>
                    Studio Operasional & Sewa Gaun
                </span>
                <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-medium tracking-tight text-[#26221F] leading-tight">
                    Aktivitas & Layanan Fitting Hari Ini
                </h2>
                <p class="mt-2 text-sm text-[#6B5F53] leading-relaxed max-w-xl">
                    Pantau sirkulasi gaun eksklusif Dressell, janji temu fitting pelanggan, dan verifikasi pesanan sewa yang sedang berjalan.
                </p>

                <!-- Quick Operational Badges -->
                <div class="mt-5 flex flex-wrap items-center gap-2.5 pt-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#FBF8F2] border border-[#D9CAB4] text-xs font-medium text-[#26221F]">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#C2A878]"></span>
                        <span>Fitting Studio Buka: 10:00 – 20:00 WIB</span>
                    </div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#FBF8F2] border border-[#D9CAB4] text-xs font-medium text-[#26221F]">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#8A7B6C]"></span>
                        <span>Fitting Room: 3 Bilik Siap Digunakan</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- 2. Operational Stat Cards Grid -->
        <section aria-labelledby="stat-summary-heading">
            <h3 id="stat-summary-heading" class="sr-only">Ringkasan Operasional</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
                <!-- Stat 1: Penyewaan Aktif -->
                <StatCard
                    title="Penyewaan Aktif"
                    :value="stats.activeRentals"
                    unit="Gaun"
                    description="4 gaun dijadwalkan kembali hari ini"
                    badge="Sirkulasi"
                    variant="champagne"
                >
                    <template #icon>
                        <svg class="w-4 h-4 text-[#C2A878]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </template>
                </StatCard>

                <!-- Stat 2: Jadwal Fitting Hari Ini -->
                <StatCard
                    title="Fitting Hari Ini"
                    :value="stats.todayFittings"
                    unit="Sesi"
                    description="2 sesi pagi · 4 sesi sore & malam"
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
                    description="Verifikasi ukuran badan & bukti deposit"
                    badge="Tindakan"
                    variant="blush"
                >
                    <template #icon>
                        <svg class="w-4 h-4 text-[#D48B96]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                    </template>
                </StatCard>

                <!-- Stat 4: Dress Tersedia di Studio -->
                <StatCard
                    title="Gaun Siap Sewa"
                    :value="stats.availableDresses"
                    unit="Gaun"
                    description="Telah selesai proses dry-cleaning"
                    badge="Ready"
                    variant="charcoal"
                >
                    <template #icon>
                        <svg class="w-4 h-4 text-[#FBF8F2]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </template>
                </StatCard>
            </div>
        </section>

        <!-- 3. Two-Column Activity Section (Fitting Schedule & Recent Rentals) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left: Jadwal Fitting Hari Ini (lg:col-span-5) -->
            <section class="lg:col-span-5 bg-[#FBF8F2] border border-[#E4D8C6] rounded-2xl p-6 shadow-xs">
                <div class="flex items-center justify-between pb-4 border-b border-[#E4D8C6]">
                    <div>
                        <span class="text-[10px] font-semibold tracking-[0.2em] uppercase text-[#8A7B6C]">
                            Jadwal Janji Temu
                        </span>
                        <h3 class="font-serif text-xl font-medium text-[#26221F] mt-0.5">
                            Fitting Hari Ini
                        </h3>
                    </div>
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-[#C2A878]/15 text-[#8A7B6C] border border-[#C2A878]/30">
                        {{ todayFittings.length }} Pelanggan
                    </span>
                </div>

                <!-- Timeline / Fitting Cards -->
                <div class="mt-4 space-y-3.5">
                    <div
                        v-for="fitting in todayFittings"
                        :key="fitting.id"
                        class="p-4 rounded-xl border border-[#E4D8C6]/80 bg-[#F4EFE6]/40 hover:bg-[#F4EFE6] transition-colors"
                    >
                        <div class="flex items-start justify-between gap-3">
                            <!-- Time Slot Pill -->
                            <div class="flex items-center gap-2">
                                <span class="font-mono text-xs font-semibold text-[#26221F] bg-[#FBF8F2] px-2.5 py-1 rounded-md border border-[#D9CAB4]">
                                    {{ fitting.time }}
                                </span>
                                <span class="text-xs text-[#8A7B6C]">
                                    {{ fitting.room }}
                                </span>
                            </div>

                            <!-- Status Badge -->
                            <span
                                :class="[
                                    'text-[10px] font-semibold tracking-wider uppercase px-2 py-0.5 rounded-full border',
                                    getFittingStatusClass(fitting.status)
                                ]"
                            >
                                {{ fitting.statusLabel }}
                            </span>
                        </div>

                        <!-- Customer & Target Dress Details -->
                        <div class="mt-3">
                            <h4 class="text-sm font-semibold text-[#26221F]">
                                {{ fitting.customerName }}
                            </h4>
                            <p class="text-xs text-[#6B5F53] mt-0.5 flex items-center gap-1.5">
                                <span class="text-[#C2A878]">●</span>
                                <span>Gaun: {{ fitting.dressName }}</span>
                            </p>
                        </div>

                        <!-- Notes / Tailor Assignment -->
                        <div class="mt-2 pt-2 border-t border-[#E4D8C6]/60 flex items-center justify-between text-[11px] text-[#8A7B6C]">
                            <span>Fitting Stylist: <strong>{{ fitting.stylist }}</strong></span>
                            <span v-if="fitting.notes" class="italic truncate max-w-[140px]">{{ fitting.notes }}</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Right: Daftar Penyewaan Terbaru (lg:col-span-7) -->
            <section class="lg:col-span-7 bg-[#FBF8F2] border border-[#E4D8C6] rounded-2xl p-6 shadow-xs">
                <div class="flex items-center justify-between pb-4 border-b border-[#E4D8C6]">
                    <div>
                        <span class="text-[10px] font-semibold tracking-[0.2em] uppercase text-[#8A7B6C]">
                            Sirkulasi Gaun
                        </span>
                        <h3 class="font-serif text-xl font-medium text-[#26221F] mt-0.5">
                            Penyewaan Terbaru
                        </h3>
                    </div>
                    <span class="text-xs text-[#8A7B6C]">
                        Menampilkan transaksi terkini
                    </span>
                </div>

                <!-- Table Container -->
                <div class="mt-4 overflow-x-auto">
                    <table class="w-full text-left text-xs text-[#26221F]">
                        <thead>
                            <tr class="border-b border-[#E4D8C6] text-[10px] uppercase tracking-[0.16em] text-[#8A7B6C]">
                                <th class="pb-3 font-semibold">Kode & Pelanggan</th>
                                <th class="pb-3 font-semibold">Gaun Sewa</th>
                                <th class="pb-3 font-semibold">Jadwal Sewa</th>
                                <th class="pb-3 font-semibold text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E4D8C6]/60">
                            <tr
                                v-for="rental in recentRentals"
                                :key="rental.id"
                                class="hover:bg-[#F4EFE6]/50 transition-colors"
                            >
                                <!-- Kode & Customer -->
                                <td class="py-3.5 pr-3">
                                    <span class="font-mono text-[11px] font-medium text-[#8A7B6C] block">
                                        {{ rental.code }}
                                    </span>
                                    <span class="font-medium text-[#26221F] block text-xs mt-0.5">
                                        {{ rental.customerName }}
                                    </span>
                                </td>

                                <!-- Gaun -->
                                <td class="py-3.5 pr-3">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-10 rounded overflow-hidden bg-[#D9CAB4] shrink-0 border border-[#E4D8C6]">
                                            <img
                                                :src="rental.dressImage"
                                                alt=""
                                                class="w-full h-full object-cover object-center"
                                            />
                                        </div>
                                        <div>
                                            <span class="font-medium text-[#26221F] block leading-tight">
                                                {{ rental.dressName }}
                                            </span>
                                            <span class="text-[10px] text-[#8A7B6C] block mt-0.5">
                                                Size: {{ rental.size }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Tanggal Sewa -->
                                <td class="py-3.5 pr-3">
                                    <span class="text-xs block text-[#26221F]">
                                        {{ rental.dateRange }}
                                    </span>
                                    <span class="text-[10px] text-[#8A7B6C] block mt-0.5">
                                        Durasi: {{ rental.duration }}
                                    </span>
                                </td>

                                <!-- Status Badge -->
                                <td class="py-3.5 text-right">
                                    <span
                                        :class="[
                                            'inline-block text-[10px] font-semibold tracking-wider uppercase px-2.5 py-1 rounded-full border',
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

        <!-- 4. Curated Dress Collection Spotlight -->
        <section class="bg-[#FBF8F2] border border-[#E4D8C6] rounded-2xl p-6 sm:p-8 shadow-xs">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-5 border-b border-[#E4D8C6] gap-3">
                <div>
                    <span class="text-[10px] font-semibold tracking-[0.2em] uppercase text-[#8A7B6C]">
                        Inventaris Studio
                    </span>
                    <h3 class="font-serif text-2xl font-medium text-[#26221F] mt-0.5">
                        Koleksi Gaun Pilihan
                    </h3>
                </div>
                <p class="text-xs text-[#8A7B6C] max-w-sm sm:text-right">
                    Koleksi gaun paling sering disewa dan dipersiapkan di studio fitting Dressell.
                </p>
            </div>

            <!-- Dress Cards Grid -->
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <article
                    v-for="dress in curatedDresses"
                    :key="dress.id"
                    class="group rounded-xl border border-[#E4D8C6] bg-[#F4EFE6]/40 overflow-hidden hover:shadow-md hover:border-[#D9CAB4] transition-all duration-200 flex flex-col"
                >
                    <!-- Photo Frame (Aspect Editorial 4:5) -->
                    <div class="relative aspect-[3/4] overflow-hidden bg-[#D9CAB4]">
                        <img
                            :src="dress.image"
                            :alt="dress.name"
                            class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105"
                        />
                        <!-- Availability Tag -->
                        <div class="absolute top-3 left-3">
                            <span
                                :class="[
                                    'text-[10px] font-semibold tracking-wider uppercase px-2.5 py-1 rounded-full border backdrop-blur-xs',
                                    getDressStatusClass(dress.status)
                                ]"
                            >
                                {{ dress.statusLabel }}
                            </span>
                        </div>
                    </div>

                    <!-- Dress Info -->
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#8A7B6C]">
                                {{ dress.category }}
                            </span>
                            <h4 class="font-serif text-lg font-medium text-[#26221F] mt-0.5 leading-snug group-hover:text-[#8A7B6C] transition-colors">
                                {{ dress.name }}
                            </h4>
                        </div>

                        <div class="mt-3 pt-3 border-t border-[#E4D8C6]/80 flex items-center justify-between text-xs">
                            <span class="text-[#8A7B6C]">Ukuran: <strong>{{ dress.availableSizes.join(', ') }}</strong></span>
                            <span class="font-serif font-medium text-[#26221F]">{{ dress.rentalRate }}</span>
                        </div>
                    </div>
                </article>
            </div>
        </section>
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

// 4. Data Koleksi Gaun Pilihan
const curatedDresses = reactive([
    {
        id: 1,
        name: 'The Evening Edit — No. 01',
        category: 'Evening Gown',
        image: '/assets/img/login-photo.jpg',
        availableSizes: ['XS', 'S', 'M'],
        rentalRate: 'Rp 850.000 / 3 hari',
        status: 'available',
        statusLabel: 'Tersedia di Studio',
    },
    {
        id: 2,
        name: 'Veloutine Noir Silhouette',
        category: 'Cocktail & Gala',
        image: '/assets/img/img-2.jpeg',
        availableSizes: ['S', 'M', 'L'],
        rentalRate: 'Rp 650.000 / 3 hari',
        status: 'rented',
        statusLabel: 'Sedang Disewa',
    },
    {
        id: 3,
        name: 'Rosette Ivory Bridal Plate',
        category: 'Bridal & Prewedding',
        image: '/assets/img/login-photo.jpg',
        availableSizes: ['S', 'M'],
        rentalRate: 'Rp 1.200.000 / 3 hari',
        status: 'reserved',
        statusLabel: 'Reserved Fitting',
    },
    {
        id: 4,
        name: 'Celeste Silk Atelier Gown',
        category: 'Minimalist Couture',
        image: '/assets/img/img-2.jpeg',
        availableSizes: ['XS', 'S'],
        rentalRate: 'Rp 950.000 / 3 hari',
        status: 'available',
        statusLabel: 'Tersedia di Studio',
    },
]);

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

// Helper Style Status Ketersediaan Dress
function getDressStatusClass(status) {
    switch (status) {
        case 'available':
            return 'bg-[#FBF8F2]/90 text-[#26221F] border-[#D9CAB4]';
        case 'rented':
            return 'bg-[#26221F]/90 text-[#FBF8F2] border-[#26221F]';
        case 'reserved':
            return 'bg-[#C2A878]/90 text-[#26221F] border-[#C2A878]';
        default:
            return 'bg-[#FBF8F2]/90 text-[#6B5F53] border-[#E4D8C6]';
    }
}
</script>
