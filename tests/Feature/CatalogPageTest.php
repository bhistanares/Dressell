<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CatalogPageTest extends TestCase
{
    public function test_catalog_page_renders_successfully(): void
    {
        $response = $this->get('/katalog');
        $response->assertStatus(200);
        $response->assertSee('Katalog <em>Koleksi Dress</em>', false);
        $response->assertSee('navbar-app');
        $response->assertSee('catalog-sidebar');
        $response->assertSee('catalog-product-grid');
        $response->assertSee('assets/css/catalog.css');
        $response->assertSee('/assets/img/dressell/drs-001.jpg');
        $response->assertSee('/assets/img/dressell/kby-012.jpg');
    }

    public function test_catalog_page_shows_customer_in_navbar_when_logged_in(): void
    {
        $customer = User::where('email', 'customer@dressell.test')->first();
        $this->actingAs($customer, 'web');

        $response = $this->get('/katalog');
        $response->assertStatus(200);
        $response->assertSee($customer->name);
        $response->assertDontSee('data-user="null"');
    }

    public function test_catalog_has_no_decorative_atelier_label_and_features_drawer_and_duration(): void
    {
        $response = $this->get('/katalog');
        $response->assertStatus(200);

        // 1. Label dekoratif Atelier dihapus, namun brand Syaza Atelier tetap dipertahankan
        $response->assertDontSee('catalog-eyebrow');
        $response->assertDontSee('Atelier Collection');
        $response->assertSee('Syaza Atelier');

        // 2. Top Controls & Drawer dari kanan
        $response->assertSee('catalog-controls-bar');
        $response->assertSee('catalog-search-input');
        $response->assertSee('catalog-filter-btn');
        $response->assertSee('catalog-filter-drawer');
        $response->assertSee('catalog-drawer-backdrop');
        $response->assertSee('Terapkan Filter');

        // 3. Keterangan harga per 4 hari
        $response->assertSee('/ 4 hari');

        // 4. Tombol Sewa dan badge ketersediaan dihapus dari card
        $response->assertDontSee('collection-rent-button');
        $response->assertDontSee('collection-availability-wrapper');
    }

    public function test_guest_cannot_see_wishlist_data_on_catalog(): void
    {
        $response = $this->get('/katalog');
        $response->assertStatus(200);
        $response->assertSee('const currentCustomer = null;', false);
    }

    public function test_authenticated_customer_has_customer_data_on_catalog(): void
    {
        $customer = User::where('email', 'customer@dressell.test')->first();
        $this->actingAs($customer, 'web');

        $response = $this->get('/katalog');
        $response->assertStatus(200);
        $response->assertSee($customer->name);
        $response->assertDontSee('const currentCustomer = null;', false);
    }

    public function test_catalog_grid_css_has_four_columns_on_desktop_and_consistent_quickview_button(): void
    {
        $css = file_get_contents(public_path('assets/css/catalog.css'));
        
        // Pastikan desktop 4 kolom tersedia pada ukuran desktop 960px ke atas
        $this->assertStringContainsString('grid-template-columns: repeat(4, minmax(0, 1fr))', $css);
        
        // Pastikan tombol Lihat Detail hover memiliki kontras tinggi (charcoal background dengan white text)
        $this->assertStringContainsString('.catalog-quickview-btn:hover', $css);
        $this->assertStringContainsString('background-color: var(--charcoal)', $css);
        $this->assertStringContainsString('color: #FFFFFF', $css);
    }
}
