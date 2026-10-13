<template>
    <footer class="bg-gray-900 text-gray-300">
        <!-- Main Footer -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 lg:px-12 py-12 lg:py-16">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 lg:gap-12">
                <!-- Brand Column -->
                <div class="col-span-2 md:col-span-1">
                    <a href="/" class="flex items-center gap-2 mb-4">
                        <span class="text-2xl">🌸</span>
                        <span class="text-xl font-semibold text-white tracking-wide">Dressell</span>
                    </a>
                    <p class="text-gray-400 text-sm leading-relaxed mb-4">
                        Platform penyewaan dress premium terpercaya. Tampil memukau di setiap momen spesialmu bersama Dressell.
                    </p>
                    <!-- Social Media -->
                    <div class="flex items-center gap-3">
                        <a href="#" v-for="social in socials" :key="social.name"
                           class="w-9 h-9 rounded-full bg-gray-800 hover:bg-rose-600 flex items-center justify-center transition-colors"
                           :aria-label="social.name">
                            <span class="text-sm">{{ social.icon }}</span>
                        </a>
                    </div>
                </div>

                <!-- Company Links -->
                <div>
                    <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Perusahaan</h3>
                    <ul class="space-y-2.5">
                        <li v-for="link in companyLinks" :key="link">
                            <a href="#" class="text-gray-400 hover:text-rose-400 text-sm transition-colors">{{ link }}</a>
                        </li>
                    </ul>
                </div>

                <!-- Help Links -->
                <div>
                    <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Bantuan</h3>
                    <ul class="space-y-2.5">
                        <li v-for="link in helpLinks" :key="link">
                            <a href="#" class="text-gray-400 hover:text-rose-400 text-sm transition-colors">{{ link }}</a>
                        </li>
                    </ul>
                </div>

                <!-- FAQ Links -->
                <div>
                    <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Informasi</h3>
                    <ul class="space-y-2.5">
                        <li v-for="link in infoLinks" :key="link">
                            <a href="#" class="text-gray-400 hover:text-rose-400 text-sm transition-colors">{{ link }}</a>
                        </li>
                    </ul>

                    <!-- Contact Info -->
                    <div class="mt-6 space-y-2">
                        <div class="flex items-center gap-2 text-gray-400 text-sm">
                            <span>📧</span>
                            <span>hello@dressell.id</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-400 text-sm">
                            <span>📞</span>
                            <span>0800-1234-5678</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 lg:px-12 py-5">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-gray-500 text-xs">
                        © 2025 Dressell. Hak cipta dilindungi.
                    </p>
                    <!-- Payment methods -->
                    <div class="flex items-center gap-2">
                        <span class="text-gray-500 text-xs mr-2">Metode Pembayaran:</span>
                        <span v-for="method in paymentMethods" :key="method"
                              class="bg-gray-800 text-gray-300 text-xs px-2.5 py-1 rounded font-medium">
                            {{ method }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>
const socials = [
    { name: 'Instagram', icon: '📸' },
    { name: 'TikTok', icon: '🎵' },
    { name: 'WhatsApp', icon: '💬' },
    { name: 'YouTube', icon: '▶️' },
];

const companyLinks = [
    'Tentang Kami',
    'Karir',
    'Blog & Inspirasi',
    'Press Kit',
    'Partner & Afiliasi',
];

const helpLinks = [
    'Pusat Bantuan',
    'Cara Menyewa',
    'Kebijakan Pengembalian',
    'Syarat & Ketentuan',
    'Kebijakan Privasi',
];

const infoLinks = [
    'Akun Saya',
    'Status Pesanan',
    'Fitting Appointment',
    'Ulasan & Rating',
    'Program Loyalitas',
];

const paymentMethods = ['Visa', 'Mastercard', 'GoPay', 'OVO', 'Dana', 'BCA'];
</script>
