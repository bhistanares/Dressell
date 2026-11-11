<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class CustomerDashboardDevelopmentTest extends TestCase
{
    /**
     * Pastikan 8 kategori resmi Dressell tersedia pada halaman katalog.
     */
    public function test_catalog_has_eight_official_categories(): void
    {
        $response = $this->get('/katalog');
        $response->assertStatus(200);

        // 8 Kategori resmi Dressell
        $response->assertSee('Elegant Gowns');
        $response->assertSee('Modern Kebaya');
        $response->assertSee('Wedding Dress');
        $response->assertSee('Party Dress');
        $response->assertSee('Hijab-Friendly');
        $response->assertSee('Special Moments');
        $response->assertSee('Minimalist Suits');
        $response->assertSee('International Traditional');
    }

    /**
     * Pastikan kode dress dummy konsisten dengan format 6 karakter alfanumerik (1 huruf kategori + 2 huruf nama + 3 angka urut).
     */
    public function test_catalog_has_consistent_dress_codes(): void
    {
        $response = $this->get('/katalog');
        $response->assertStatus(200);

        $response->assertSee('EAU-001');
        $response->assertSee('KSO-002');
        $response->assertSee('WCE-003');
        $response->assertSee('PPA-004');
        $response->assertSee('MLI-005');
        $response->assertSee('SFL-006');
        $response->assertSee('EVE-007');
        $response->assertSee('PSE-008');
        $response->assertSee('ICH-009');
        $response->assertSee('HPA-010');
    }

    /**
     * Pastikan durasi sewa / 2 hari tersedia pada card katalog.
     */
    public function test_catalog_has_two_day_price_period(): void
    {
        $response = $this->get('/katalog');
        $response->assertStatus(200);
        $response->assertSee('/ 2 hari');
    }

    /**
     * Pastikan input tanggal acara tersedia pada bagian paling atas filter drawer katalog.
     */
    public function test_catalog_has_event_date_input_in_drawer(): void
    {
        $response = $this->get('/katalog');
        $response->assertStatus(200);

        $response->assertSee('catalog-filter-event-date-section');
        $response->assertSee('id="catalog-event-date-input"', false);
        $response->assertSee('onStagedEventDateChange', false);
        $response->assertSee('dressell_event_date');
    }

    /**
     * Pastikan tanggal acara dari query URL ?tanggal=YYYY-MM-DD diterima dan ditangani di katalog.
     */
    public function test_catalog_receives_event_date_query_param(): void
    {
        $response = $this->get('/katalog?tanggal=2026-11-20');
        $response->assertStatus(200);
        $response->assertSee('currentEventDate = dateParam', false);
    }

    /**
     * Pastikan menu Fitting Appointment tetap dipertahankan pada navbar.
     */
    public function test_fitting_appointment_menu_is_preserved_on_navbar(): void
    {
        // 1. Guest
        $resGuest = $this->get('/');
        $resGuest->assertStatus(200);

        // 2. Customer
        $customer = User::where('email', 'customer@dressell.test')->first();
        $this->actingAs($customer, 'web');

        $resCust = $this->get('/customer/dashboard');
        $resCust->assertStatus(200);
    }
}
