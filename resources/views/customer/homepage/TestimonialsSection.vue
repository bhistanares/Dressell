<template>
    <!-- Testimonial Section (Pengalaman & Kesan Pelanggan) -->
    <section class="testimonials-section" id="testimoni">
        <div class="testimonials-container">

            <!-- Section Header -->
            <div class="testimonials-header">
                <div>
                    <span class="testimonials-eyebrow">Cerita &amp; Pengalaman</span>
                    <h2 class="testimonials-title">Kesan Mereka Bersama <em>Dressell</em></h2>
                </div>

                <!-- Navigation Controls for Horizontal Scroll -->
                <div class="testimonials-nav-buttons" aria-label="Navigasi Testimoni">
                    <button
                        type="button"
                        class="testimonials-nav-btn"
                        @click="scrollPrev"
                        aria-label="Geser ke testimoni sebelumnya"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button
                        type="button"
                        class="testimonials-nav-btn"
                        @click="scrollNext"
                        aria-label="Geser ke testimoni berikutnya"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Horizontal Carousel / Scrollable Track -->
            <div
                ref="scrollTrack"
                class="testimonials-track"
            >
                <div
                    v-for="item in testimonials"
                    :key="item.id"
                    class="testimonial-card"
                >
                    <!-- Top Info: Stars & Occasion -->
                    <div class="testimonial-card-top">
                        <div class="testimonial-stars" aria-label="5 dari 5 bintang">
                            <span v-for="s in 5" :key="s" class="testimonial-star">★</span>
                        </div>
                        <span class="testimonial-occasion-tag">{{ item.occasion }}</span>
                    </div>

                    <!-- Customer Experience Quote -->
                    <p class="testimonial-message">
                        &ldquo;{{ item.message }}&rdquo;
                    </p>

                    <!-- Divider -->
                    <div class="testimonial-divider"></div>

                    <!-- Customer & Dress Info -->
                    <div class="testimonial-footer">
                        <div class="testimonial-avatar">
                            <span>{{ item.initials }}</span>
                        </div>
                        <div class="testimonial-meta">
                            <h4 class="testimonial-author">{{ item.name }}</h4>
                            <p class="testimonial-dress-info">
                                <span class="testimonial-dress-prefix">Gaun:</span>
                                <span class="testimonial-dress-code">{{ item.dressCode }}</span>
                                <span class="testimonial-dress-sep">&bull;</span>
                                <span class="testimonial-dress-name">{{ item.dressName }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="testimonials-caption">
                * Ulasan kurasi pengalaman pelanggan studio busana Dressell.
            </p>

        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';

const scrollTrack = ref(null);

const scrollPrev = () => {
    if (scrollTrack.value) {
        scrollTrack.value.scrollBy({ left: -340, behavior: 'smooth' });
    }
};

const scrollNext = () => {
    if (scrollTrack.value) {
        scrollTrack.value.scrollBy({ left: 340, behavior: 'smooth' });
    }
};

// Data dummy ulasan wajar dan relevan dengan kategori busana Dressell
const testimonials = [
    {
        id: 1,
        name: 'Clara S. Adiwijaya',
        initials: 'CA',
        occasion: 'Annual Gala Dinner',
        dressCode: 'EAU-001',
        dressName: 'Gaun Aurora',
        message: 'Kualitas bahannya sangat jatuh dan mewah di bawah pencahayaan ballroom. Sangat menghemat waktu dan biaya dibanding harus jahit baru untuk acara formal kantor.',
    },
    {
        id: 2,
        name: 'Nadia Nurhaliza',
        initials: 'NN',
        occasion: 'Akad & Resepsi',
        dressCode: 'KSO-002',
        dressName: 'Kebaya Songket',
        message: 'Bordir songketnya sangat rapi dan pas di badan. Gaun sampai dalam keadaan harum, bersih tanpa cela, dan langsung siap dipakai hari H.',
    },
    {
        id: 3,
        name: 'Valerie Kusuma',
        initials: 'VK',
        occasion: 'Pre-Wedding Photoshoot',
        dressCode: 'WCE-003',
        dressName: 'Gaun Celeste',
        message: 'Potongan gaun pengantinnya benar-benar seperti rancangan desainer haute couture. Hasil foto studio kami terlihat sangat berkelas dan memukau.',
    },
    {
        id: 4,
        name: 'Rania Alatas',
        initials: 'RA',
        occasion: 'Wisuda & Syukuran',
        dressCode: 'HPA-010',
        dressName: 'Satin Pashmina',
        message: 'Sangat bersyukur ada kategori khusus hijab-friendly. Tidak perlu repot mencari manset atau dalaman tambahan karena potongannya sudah tertutup sempurna.',
    },
    {
        id: 5,
        name: 'dr. Melinda Pratiwi',
        initials: 'MP',
        occasion: 'Maternity Studio Session',
        dressCode: 'SFL-006',
        dressName: 'Flowy Garden',
        message: 'Koleksi gaun hamilnya luar biasa nyaman di perut, bahannya flowy dan membuat siluet tubuh terlihat anggun saat sesi foto kehamilan trimester ketiga.',
    },
    {
        id: 6,
        name: 'Jessica Tanuwidjaja',
        initials: 'JT',
        occasion: 'Birthday Party',
        dressCode: 'PSE-008',
        dressName: 'Ruby Sequin',
        message: 'Gaun pesta sequin ini sukses jadi pusat perhatian di pesta ulang tahunku. Pengembaliannya juga sangat mudah dan praktis.',
    },
];
</script>