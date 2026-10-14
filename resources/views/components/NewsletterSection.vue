<template>
    <!-- Newsletter / Updates Section -->
    <section class="py-10 bg-[#fdf6f0]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-rose-50 to-pink-100 rounded-3xl p-8 lg:p-12 text-center">
                <div class="max-w-xl mx-auto">
                    <p class="text-rose-500 text-sm font-semibold uppercase tracking-wider mb-2">Tetap Update</p>
                    <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-3">
                        Dapatkan Info Koleksi &<br/>Promo Terbaru!
                    </h2>
                    <p class="text-gray-500 text-sm lg:text-base mb-6 leading-relaxed">
                        Daftarkan email kamu dan jadilah yang pertama mengetahui koleksi baru, promo eksklusif, dan tips gaya berpakaian.
                    </p>

                    <form @submit.prevent="handleSubscribe" class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                        <input
                            v-model="email"
                            type="email"
                            placeholder="Masukkan email kamu"
                            class="flex-1 px-4 py-3 rounded-full border border-rose-200 text-sm focus:outline-none focus:border-rose-400 focus:ring-2 focus:ring-rose-100 bg-white"
                            required
                        />
                        <button
                            type="submit"
                            class="bg-rose-500 hover:bg-rose-600 text-white font-semibold text-sm px-6 py-3 rounded-full transition-colors whitespace-nowrap shadow-md"
                        >
                            Daftar Sekarang
                        </button>
                    </form>

                    <p v-if="subscribed" class="mt-4 text-green-600 text-sm font-medium">
                        ✓ Terima kasih! Kamu sudah terdaftar.
                    </p>
                    <p class="mt-4 text-gray-400 text-xs">
                        🔒 Kami tidak akan pernah mengirim spam. Berhenti berlangganan kapan saja.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';

const email = ref('');
const subscribed = ref(false);

const handleSubscribe = () => {
    if (email.value) {
        subscribed.value = true;
        email.value = '';
        setTimeout(() => { subscribed.value = false; }, 4000);
    }
};
</script>
