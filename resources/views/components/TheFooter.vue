<template>
    <footer class="footer">
        <!-- Main Footer -->
        <div class="footer-main">
            <div class="footer-grid">

                <!-- Brand Column -->
                <div class="footer-brand">
                    <a href="/" class="footer-logo">
                        <span class="footer-logo-icon">🌸</span>
                        <span class="footer-logo-text">Dressell</span>
                    </a>

                    <p class="footer-description">
                        Platform penyewaan dress premium terpercaya. Tampil memukau di setiap momen spesialmu bersama Dressell.
                    </p>

                    <!-- Social Media -->
                    <div class="footer-socials">
                        <a
                            href="#"
                            v-for="social in socials"
                            :key="social.name"
                            class="footer-social-link"
                            :aria-label="social.name"
                        >
                            <span class="footer-social-icon">{{ social.icon }}</span>
                        </a>
                    </div>
                </div>

                <!-- Company Links -->
                <div class="footer-column">
                    <h3 class="footer-heading">Perusahaan</h3>
                    <ul class="footer-link-list">
                        <li v-for="link in companyLinks" :key="link">
                            <a href="#" class="footer-link">{{ link }}</a>
                        </li>
                    </ul>
                </div>

                <!-- Help Links -->
                <div class="footer-column">
                    <h3 class="footer-heading">Bantuan</h3>
                    <ul class="footer-link-list">
                        <li v-for="link in helpLinks" :key="link">
                            <a href="#" class="footer-link">{{ link }}</a>
                        </li>
                    </ul>
                </div>

                <!-- Information Links -->
                <div class="footer-column">
                    <h3 class="footer-heading">Informasi</h3>
                    <ul class="footer-link-list">
                        <li v-for="link in infoLinks" :key="link">
                            <a href="#" class="footer-link">{{ link }}</a>
                        </li>
                    </ul>

                    <!-- Contact Info -->
                    <div class="footer-contact">
                        <div class="footer-contact-item">
                            <span>📧</span>
                            <span>hello@dressell.id</span>
                        </div>

                        <div class="footer-contact-item">
                            <span>📞</span>
                            <span>0800-1234-5678</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="footer-bottom">
            <div class="footer-bottom-container">
                <div class="footer-bottom-content">
                    <p class="footer-copyright">
                        © 2025 Dressell. Hak cipta dilindungi.
                    </p>

                    <!-- Payment Methods -->
                    <div class="footer-payments">
                        <span class="footer-payment-label">Metode Pembayaran:</span>

                        <span
                            v-for="method in paymentMethods"
                            :key="method"
                            class="footer-payment-method"
                        >
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
