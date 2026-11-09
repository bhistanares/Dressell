<template>
    <!-- Promo Banner Section -->
    <section class="promo-section" id="promo">
        <div class="promo-container">

            <div class="promo-banner">

                <!-- Background Subtle Glows -->
                <div class="promo-decoration" aria-hidden="true">
                    <div class="promo-circle promo-circle-top"></div>
                    <div class="promo-circle promo-circle-bottom"></div>
                    <div class="promo-circle promo-circle-middle"></div>
                </div>

                <div class="promo-content-grid">

                    <!-- Left: Editorial Promo Message -->
                    <div class="promo-text-content">

                        <div class="promo-label">
                            <span class="promo-label-dot"></span>
                            <span>Penawaran Spesial</span>
                        </div>

                        <h2 class="promo-title">
                            Diskon 30% untuk<br/>
                            <em class="promo-title-highlight">
                                Penyewaan Pertama
                            </em>
                        </h2>

                        <p class="promo-description">
                            Gunakan kode
                            <strong class="promo-code">DRESSFIRST</strong>
                            saat checkout. Berlaku untuk seluruh kategori dress pilihan.
                        </p>

                        <div class="promo-actions">
                            <a href="/katalog" class="promo-button">
                                <span>Gunakan Sekarang</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>

                            <div class="promo-countdown">
                                <svg class="promo-clock-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Berakhir dalam 3 hari</span>
                            </div>
                        </div>

                    </div>

                    <!-- Right: Visual Presentation -->
                    <div class="promo-image-area">

                        <img
                            :src="'/assets/img/dressell/hero-atelier.jpg'"
                            alt="Dressell Promo"
                            class="promo-image"
                            loading="lazy"
                        />

                        <!-- Floating Stats Card -->
                        <div class="promo-stats-card">
                            <p class="promo-stats-label">Sudah disewa oleh</p>
                            <p class="promo-stats-number">12,500+</p>
                            <p class="promo-stats-caption">pelanggan puas</p>
                        </div>

                        <!-- Floating Discount Badge -->
                        <div class="promo-discount-badge">
                            <span class="promo-discount-number">30%</span>
                            <span class="promo-discount-text">OFF</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
</script>
