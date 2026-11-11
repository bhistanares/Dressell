<template>
    <!-- Section Pencarian & Penentuan Tanggal Acara (Khusus Dashboard Customer) -->
    <section class="customer-search-section" id="cari-tanggal-acara">
        <div class="customer-search-container">

            <!-- Editorial Header & Sapaan Customer -->
            <div class="customer-search-header">
                <span class="customer-search-eyebrow">Studio Pribadi Pelanggan</span>
                <h1 class="customer-search-title">
                    Selamat datang kembali, <span class="customer-name-highlight">{{ displayName }}</span>.<br/>
                    Rencanakan Tampilan untuk <em>Momen Istimewa</em>
                </h1>
                <p class="customer-search-subtitle">
                    Tentukan tanggal acara dan temukan pilihan busana terbaik yang siap menyempurnakan hari bahagia Anda.
                </p>
            </div>

            <!-- Kartu Pencarian dan Penentuan Tanggal Acara -->
            <div class="customer-search-card">
                <form @submit.prevent="handleSearchSubmit" class="customer-search-form">

                    <!-- 1. Kolom Pencarian Dress -->
                    <div class="customer-field-wrapper customer-field-search">
                        <label for="customer-dress-search" class="customer-field-label">
                            <svg class="customer-field-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span>Pencarian Gaun</span>
                        </label>
                        <div class="customer-input-with-clear">
                            <input
                                id="customer-dress-search"
                                v-model="searchQuery"
                                type="text"
                                placeholder="Cari gaun, gaya, warna, atau kode dress..."
                                class="customer-text-input"
                            />
                            <button
                                v-if="searchQuery"
                                type="button"
                                class="customer-input-clear-btn"
                                @click="searchQuery = ''"
                                aria-label="Hapus kata kunci pencarian"
                            >
                                &times;
                            </button>
                        </div>
                    </div>

                    <div class="customer-search-sep" aria-hidden="true"></div>

                    <!-- 2. Input Tanggal Acara -->
                    <div class="customer-field-wrapper customer-field-date">
                        <label for="customer-event-date" class="customer-field-label">
                            <svg class="customer-field-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Tanggal Acara</span>
                            <span class="customer-date-badge" v-if="eventDate">Tersimpan</span>
                        </label>
                        <div class="customer-input-with-clear">
                            <input
                                id="customer-event-date"
                                v-model="eventDate"
                                type="date"
                                :min="todayDateString"
                                class="customer-date-input"
                            />
                            <button
                                v-if="eventDate"
                                type="button"
                                class="customer-input-clear-btn"
                                @click="clearEventDate"
                                aria-label="Hapus tanggal acara"
                                title="Hapus tanggal acara"
                            >
                                &times;
                            </button>
                        </div>
                    </div>

                    <!-- 3. Tombol Aksi Menjelajahi Koleksi -->
                    <div class="customer-action-wrapper">
                        <button
                            type="submit"
                            class="customer-explore-submit-btn"
                        >
                            <span>Jelajahi Koleksi</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </div>

                </form>

                <!-- Informasi Bantuan Terkait Tanggal Acara -->
                <div class="customer-search-footer-note">
                    <div class="customer-note-item">
                        <span class="customer-note-dot"></span>
                        <span>
                            Tanggal yang dipilih merupakan <strong>tanggal acara / pemakaian gaun</strong> (bukan jadwal fitting). Pilihan tanggal otomatis tersimpan saat membuka katalog.
                        </span>
                    </div>
                </div>

            </div>

        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

const props = defineProps({
    user: {
        type: Object,
        default: null,
    },
});

const searchQuery = ref('');
const eventDate = ref('');

const displayName = computed(() => {
    return props.user?.name || 'Pelanggan Dressell';
});

// Format hari ini (YYYY-MM-DD) sebagai batas minimum pemilihan tanggal
const todayDateString = computed(() => {
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    return `${yyyy}-${mm}-${dd}`;
});

const clearEventDate = () => {
    eventDate.value = '';
    if (typeof window !== 'undefined') {
        try {
            sessionStorage.removeItem('dressell_event_date');
            localStorage.removeItem('dressell_event_date');
        } catch (e) {}
    }
};

const handleSearchSubmit = () => {
    if (typeof window !== 'undefined') {
        const params = new URLSearchParams();

        if (searchQuery.value && searchQuery.value.trim()) {
            params.set('search', searchQuery.value.trim());
        }

        if (eventDate.value) {
            params.set('tanggal', eventDate.value);
            try {
                sessionStorage.setItem('dressell_event_date', eventDate.value);
                localStorage.setItem('dressell_event_date', eventDate.value);
            } catch (e) {}
        }

        const qs = params.toString();
        window.location.href = '/katalog' + (qs ? '?' + qs : '');
    }
};

onMounted(() => {
    if (typeof window !== 'undefined') {
        try {
            const savedDate = sessionStorage.getItem('dressell_event_date') || localStorage.getItem('dressell_event_date');
            if (savedDate) {
                eventDate.value = savedDate;
            }
        } catch (e) {}
    }
});
</script>