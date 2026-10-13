<template>
    <!-- How to Rent Section -->
    <section class="py-10 bg-white" id="cara-sewa">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-10">
                <p class="text-rose-500 text-sm font-semibold uppercase tracking-wider mb-2">Mudah & Cepat</p>
                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-3">Cara Menyewa di Dressell</h2>
                <p class="text-gray-500 text-sm lg:text-base max-w-lg mx-auto">
                    Proses sewa dress semudah 4 langkah. Tampil cantik tanpa ribet!
                </p>
            </div>

            <!-- Steps -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 relative">
                <!-- Connecting line (desktop only) -->
                <div class="hidden lg:block absolute top-10 left-[12.5%] right-[12.5%] h-0.5 bg-rose-100 z-0"></div>

                <div v-for="(step, index) in steps" :key="step.id"
                     class="relative flex flex-col items-center text-center">
                    <!-- Step number circle -->
                    <div class="relative z-10 w-20 h-20 rounded-full bg-white border-2 border-rose-100 flex flex-col items-center justify-center mb-5 shadow-sm">
                        <span class="text-3xl">{{ step.icon }}</span>
                        <span class="text-xs font-bold text-rose-400 -mt-1">{{ String(step.id).padStart(2, '0') }}</span>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">{{ step.title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ step.description }}</p>
                </div>
            </div>

            <!-- CTA -->
            <div class="text-center mt-10">
                <a href="#koleksi" class="inline-flex items-center gap-2 bg-rose-500 hover:bg-rose-600 text-white font-semibold px-8 py-3.5 rounded-full transition-colors shadow-md">
                    Mulai Sewa Sekarang
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
</template>

<script setup>
const steps = [
    {
        id: 1,
        icon: '🔍',
        title: 'Pilih Dress',
        description: 'Jelajahi ribuan koleksi dress dan pilih yang sesuai dengan selera dan acara.',
    },
    {
        id: 2,
        icon: '📅',
        title: 'Tentukan Tanggal',
        description: 'Pilih tanggal mulai dan akhir penyewaan. Minimal sewa 1 hari.',
    },
    {
        id: 3,
        icon: '💳',
        title: 'Bayar & Pesan',
        description: 'Lakukan pembayaran mudah via transfer bank, kartu kredit, atau e-wallet.',
    },
    {
        id: 4,
        icon: '📦',
        title: 'Terima & Kembalikan',
        description: 'Dress dikirim ke pintumu. Kembalikan setelah digunakan, semudah itu!',
    },
];
</script>
