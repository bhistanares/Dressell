import { createApp } from 'vue';
import App from './App.vue';
import TheNavbar from '../views/components/TheNavbar.vue';
import '../css/app.css';

const mountEl = document.getElementById('app');

if (mountEl) {
    const initialProps = {
        user: null,
        page: mountEl.dataset.page || 'home',
        logoutUrl: mountEl.dataset.logoutUrl || '/logout',
        csrfToken: mountEl.dataset.csrf || '',
    };

    if (mountEl.dataset.user) {
        try {
            initialProps.user = JSON.parse(mountEl.dataset.user);
        } catch (e) {
            initialProps.user = null;
        }
    }

    if (!initialProps.csrfToken) {
        const meta = document.querySelector('meta[name="csrf-token"]');
        if (meta) {
            initialProps.csrfToken = meta.getAttribute('content');
        }
    }

    createApp(App, initialProps).mount('#app');
}

const navbarEl = document.getElementById('navbar-app');

if (navbarEl) {
    let user = null;
    if (navbarEl.dataset.user) {
        try {
            user = JSON.parse(navbarEl.dataset.user);
        } catch (e) {
            user = null;
        }
    }

    const logoutUrl = navbarEl.dataset.logoutUrl || '/logout';
    let csrfToken = navbarEl.dataset.csrf || '';
    if (!csrfToken) {
        const meta = document.querySelector('meta[name="csrf-token"]');
        if (meta) {
            csrfToken = meta.getAttribute('content');
        }
    }

    createApp(TheNavbar, {
        user: user,
        logoutUrl: logoutUrl,
        csrfToken: csrfToken,
    }).mount('#navbar-app');
}
