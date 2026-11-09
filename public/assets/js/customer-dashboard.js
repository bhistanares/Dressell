/**
 * Dressell — Customer Dashboard Client Script
 * Menangani interaksi UI interaktif khusus Dashboard Customer (notifikasi toast, keyboard listener, & navigasi)
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        // 1. Toast Notification Helper untuk Navigasi Fitur yang Sedang Disiapkan
        var activeToast = null;

        function showToast(message) {
            if (activeToast) {
                activeToast.remove();
                activeToast = null;
            }

            var toast = document.createElement('div');
            toast.className = 'dressell-toast';
            toast.setAttribute('role', 'status');
            toast.innerHTML = `
                <div class="dressell-toast-content">
                    <span class="dressell-toast-icon">✨</span>
                    <span class="dressell-toast-text">${message}</span>
                </div>
            `;

            // Inline styling fallback untuk menjamin tampilan konsisten tanpa bentrok CSS
            Object.assign(toast.style, {
                position: 'fixed',
                bottom: '24px',
                right: '24px',
                backgroundColor: '#26221F',
                color: '#FBF8F2',
                padding: '12px 20px',
                borderRadius: '8px',
                boxShadow: '0 10px 25px rgba(38, 34, 31, 0.2)',
                fontSize: '0.875rem',
                fontFamily: "'Instrument Sans', sans-serif",
                zIndex: '9999',
                display: 'flex',
                alignItems: 'center',
                gap: '8px',
                opacity: '0',
                transform: 'translateY(10px)',
                transition: 'opacity 0.25s ease, transform 0.25s ease',
            });

            document.body.appendChild(toast);

            // Animate In
            requestAnimationFrame(function () {
                toast.style.opacity = '1';
                toast.style.transform = 'translateY(0)';
            });

            activeToast = toast;

            // Auto Dismiss setelah 3.5 detik
            setTimeout(function () {
                if (activeToast === toast) {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateY(10px)';
                    setTimeout(function () {
                        if (toast.parentNode) {
                            toast.parentNode.removeChild(toast);
                        }
                        if (activeToast === toast) activeToast = null;
                    }, 250);
                }
            }, 3500);
        }

        // Listener event kustom dari navbar
        window.addEventListener('dressell:feature-notice', function (e) {
            var feature = (e.detail && e.detail.feature) ? e.detail.feature : 'Fitur';
            showToast(feature + ' sedang disiapkan untuk tahap selanjutnya.');
        });

        // 2. Keyboard shortcut Esc untuk menutup modal/menu apapun
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && activeToast) {
                activeToast.remove();
                activeToast = null;
            }
        });
    });
})();
