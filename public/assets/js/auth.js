/**
 * Dressell — Customer Authentication Script (Login & Register)
 * Menangani interaksi UI murni (toggle visibility password & submit button feedback)
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        // 1. Password Visibility Toggle Helper (Support minimal SVG eye icon)
        function setupPasswordToggle(inputId, toggleId) {
            var input = document.getElementById(inputId);
            var toggle = document.getElementById(toggleId);

            if (!input || !toggle) return;

            toggle.addEventListener('click', function () {
                var isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                toggle.setAttribute('aria-pressed', isPassword ? 'true' : 'false');
                toggle.setAttribute('title', isPassword ? 'Sembunyikan password' : 'Lihat password');

                if (isPassword) {
                    toggle.classList.add('is-visible');
                } else {
                    toggle.classList.remove('is-visible');
                }

                // Fallback jika ada label teks
                var labelSpan = toggle.querySelector('[data-toggle-label]');
                if (labelSpan) {
                    labelSpan.textContent = isPassword ? 'Sembunyikan' : 'Lihat';
                }

                input.focus();
            });
        }

        setupPasswordToggle('password', 'password-toggle');
        setupPasswordToggle('password_confirmation', 'password_confirmation-toggle');

        // 2. Form Submit State (Cegah double submission & validasi role di sisi client)
        var forms = ['register-form', 'login-form'];
        forms.forEach(function (formId) {
            var form = document.getElementById(formId);
            if (!form) return;

            var submitBtn = form.querySelector('button[type="submit"]');
            if (!submitBtn) return;

            form.addEventListener('submit', function (e) {
                // Untuk form login: periksa apakah role sudah dipilih
                if (formId === 'login-form') {
                    var roleInput = form.querySelector('input[name="role"]:checked');
                    if (!roleInput) {
                        e.preventDefault();
                        var roleSection = document.getElementById('auth-role-section');
                        if (roleSection) {
                            roleSection.classList.add('is-invalid');
                            var existingError = document.getElementById('role-client-error');
                            if (!existingError) {
                                var errP = document.createElement('p');
                                errP.id = 'role-client-error';
                                errP.className = 'auth-field-error';
                                errP.style.textAlign = 'center';
                                errP.textContent = 'Silakan pilih peran (Customer, Admin, atau Kasir) terlebih dahulu.';
                                roleSection.appendChild(errP);
                            }
                        }
                        return;
                    }
                }

                // Jangan blokir validasi HTML5 bawaan browser
                if (form.checkValidity && !form.checkValidity()) {
                    return;
                }

                submitBtn.disabled = true;
                var label = submitBtn.querySelector('[data-label]');
                if (label) {
                    label.textContent = formId === 'login-form' ? 'Memproses Masuk…' : 'Memproses Pendaftaran…';
                }
            });

            // Pulihkan tombol jika halaman dibuka kembali dari cache browser (tombol back)
            window.addEventListener('pageshow', function () {
                submitBtn.disabled = false;
                var label = submitBtn.querySelector('[data-label]');
                if (label) {
                    label.textContent = formId === 'login-form' ? 'Masuk' : 'Daftar Akun';
                }
            });
        });

        // 3. Hapus pesan error role saat user memilih role
        var roleInputs = document.querySelectorAll('input[name="role"]');
        roleInputs.forEach(function (r) {
            r.addEventListener('change', function () {
                var roleSection = document.getElementById('auth-role-section');
                if (roleSection) {
                    roleSection.classList.remove('is-invalid');
                    var clientError = document.getElementById('role-client-error');
                    if (clientError) clientError.remove();
                }
            });
        });
    });
})();
