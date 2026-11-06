import { createApp } from 'vue';
import Dashboard from '../views/admin/Dashboard.vue';
import '../css/app.css';

const mountEl = document.getElementById('admin-app');

if (mountEl) {
    const adminData = mountEl.dataset.admin ? JSON.parse(mountEl.dataset.admin) : null;
    const logoutUrl = mountEl.dataset.logoutUrl || '/admin/logout';
    const csrfToken = mountEl.dataset.csrf || '';

    const app = createApp(Dashboard, {
        initialAdmin: adminData,
        logoutUrl: logoutUrl,
        csrfToken: csrfToken,
    });

    app.mount('#admin-app');
}
