<template>
    <!-- Why Choose Dressell Section -->
    <section class="py-10 bg-[#fdf6f0]" id="keunggulan">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-10">
                <p class="text-rose-500 text-sm font-semibold uppercase tracking-wider mb-2">Mengapa Dressell?</p>
                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-3">Keunggulan Layanan Kami</h2>
                <p class="text-gray-500 text-sm lg:text-base max-w-xl mx-auto leading-relaxed">
                    Dressell hadir untuk memudahkan kamu tampil terbaik di setiap momen tanpa harus merogoh kocek terlalu dalam.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-6">
                <div v-for="feature in features" :key="feature.id"
                     class="bg-white rounded-2xl p-5 lg:p-6 text-center shadow-sm hover:shadow-md transition-shadow group">
                    <div :class="['w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl transition-transform group-hover:scale-110 duration-200', feature.bgColor]">
                        {{ feature.icon }}
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2 text-sm lg:text-base">{{ feature.title }}</h3>
                    <p class="text-gray-500 text-xs lg:text-sm leading-relaxed">{{ feature.description }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const features = [
    {
        id: 1,
        icon: '👗',
        title: 'Koleksi Premium',
        description: 'Ribuan pilihan dress dari brand ternama dalam kondisi terjaga dan bersih.',
        bgColor: 'bg-rose-50',
    },
    {
        id: 2,
        icon: '💰',
        title: 'Harga Terjangkau',
        description: 'Hemat hingga 70% dibanding beli baru. Sewa mulai dari Rp 75.000/hari.',
        bgColor: 'bg-amber-50',
    },
    {
        id: 3,
        icon: '🧼',
        title: 'Bersih & Higienis',
        description: 'Setiap dress dicuci dan disetrika profesional sebelum dikirim ke pelanggan.',
        bgColor: 'bg-emerald-50',
    },
    {
        id: 4,
        icon: '🚚',
        title: 'Pengiriman Cepat',
        description: 'Dress dikirim tepat waktu sesuai jadwal pemesananmu, ke seluruh Indonesia.',
        bgColor: 'bg-blue-50',
    },
    {
        id: 5,
        icon: '📏',
        title: 'Berbagai Ukuran',
        description: 'Tersedia dari ukuran XS hingga XXL untuk semua bentuk tubuh.',
        bgColor: 'bg-purple-50',
    },
    {
        id: 6,
        icon: '🔄',
        title: 'Pengembalian Mudah',
        description: 'Proses pengembalian dress mudah dan tanpa kerumitan. Drop off di mana saja.',
        bgColor: 'bg-orange-50',
    },
    {
        id: 7,
        icon: '👩‍💼',
        title: 'Fitting Appointment',
        description: 'Jadwalkan sesi fitting gratis di showroom kami untuk memastikan kecocokan dress.',
        bgColor: 'bg-pink-50',
    },
    {
        id: 8,
        icon: '⭐',
        title: 'Rating Terpercaya',
        description: 'Lebih dari 15.000 ulasan positif dari pelanggan yang puas dan percaya.',
        bgColor: 'bg-yellow-50',
    },
];
</script>
