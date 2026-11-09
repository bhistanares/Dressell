<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CustomerDashboardTest extends TestCase
{
    public function test_guest_cannot_access_customer_dashboard_and_is_redirected_to_login(): void
    {
        $response = $this->get('/customer/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_customer_can_access_dashboard(): void
    {
        $customer = User::where('email', 'customer@dressell.test')->first();
        $this->actingAs($customer, 'web');

        $response = $this->get('/customer/dashboard');
        $response->assertStatus(200);
        $response->assertSee('customer-dashboard');
        $response->assertSee($customer->name);
        $response->assertSee('assets/css/style.css');
        $response->assertSee('assets/js/customer-dashboard.js');
    }

    public function test_customer_cannot_access_admin_dashboard(): void
    {
        $customer = User::where('email', 'customer@dressell.test')->first();
        $this->actingAs($customer, 'web');

        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_customer_cannot_access_cashier_dashboard(): void
    {
        $customer = User::where('email', 'customer@dressell.test')->first();
        $this->actingAs($customer, 'web');

        $response = $this->get('/cashier/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_admin_cannot_access_customer_dashboard(): void
    {
        $admin = Admin::where('email', 'admin@dressell.test')->first();
        $this->actingAs($admin, 'admin');

        $response = $this->get('/customer/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_customer_logout_with_redirect_to_returns_to_homepage(): void
    {
        $customer = User::where('email', 'customer@dressell.test')->first();
        $this->actingAs($customer, 'web');
        $this->assertTrue(Auth::guard('web')->check());

        $response = $this->post('/logout', [
            'redirect_to' => '/',
        ]);

        $response->assertRedirect('/');
        $this->assertFalse(Auth::guard('web')->check());
    }

    public function test_homepage_passes_user_payload_for_customer_and_null_for_guest(): void
    {
        // 1. Guest
        $resGuest = $this->get('/');
        $resGuest->assertStatus(200);
        $resGuest->assertSee('data-user="null"', false);

        // 2. Customer
        $customer = User::where('email', 'customer@dressell.test')->first();
        $this->actingAs($customer, 'web');

        $resCust = $this->get('/');
        $resCust->assertStatus(200);
        $resCust->assertSee($customer->name);
        $resCust->assertDontSee('data-user="null"');
    }

    public function test_homepage_and_dashboard_have_no_decorative_atelier_labels_and_no_hero_starting_price(): void
    {
        $customer = User::where('email', 'customer@dressell.test')->first();
        $this->actingAs($customer, 'web');

        $resCust = $this->get('/customer/dashboard');
        $resCust->assertStatus(200);
        $resCust->assertDontSee('hero-eyebrow');
        $resCust->assertDontSee('Atelier Collection');
        $resCust->assertDontSee('Sewa dress premium, mulai dari Rp 85.000/hari');
        $resCust->assertDontSee('navbar-profile-badge">Atelier');

        $resGuest = $this->get('/');
        $resGuest->assertStatus(200);
        $resGuest->assertDontSee('hero-eyebrow');
        $resGuest->assertDontSee('Atelier Collection');
        $resGuest->assertDontSee('Sewa dress premium, mulai dari Rp 85.000/hari');
    }
}
