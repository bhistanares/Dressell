<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UnifiedAuthTest extends TestCase
{
    public function test_login_page_renders_successfully(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Masuk');
        $response->assertSee('Akun Dressell');
        $response->assertDontSee('Atelier Rental Studio');
        $response->assertSee('Customer');
        $response->assertSee('Admin');
        $response->assertSee('Kasir');
        $response->assertSee('auth-role-grid');
        $response->assertSee('auth-role-box');
        $response->assertSee('auth-role-btn');
        $response->assertSee('auth-logo-badge');
        $response->assertSee('assets/css/auth.css');
        $response->assertSee('assets/js/auth.js');
    }

    public function test_admin_login_redirects_to_login(): void
    {
        $response = $this->get('/admin/login');
        $response->assertRedirect('/login');
    }

    public function test_unauthenticated_user_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_login_fails_without_selecting_a_role(): void
    {
        $response = $this->from('/login')->post('/login', [
            'email' => 'admin@dressell.test',
            'password' => 'Admin12345',
            // 'role' sengaja dikosongkan
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('role');
        $this->assertFalse(Auth::guard('admin')->check());
        $this->assertFalse(Auth::guard('web')->check());
    }

    public function test_admin_can_login_and_redirects_to_admin_dashboard(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@dressell.test',
            'password' => 'Admin12345',
            'role' => 'admin',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertTrue(Auth::guard('admin')->check());
        $this->assertFalse(Auth::guard('web')->check());
        $this->assertEquals('admin', Auth::guard('admin')->user()->role);
    }

    public function test_cashier_can_login_and_redirects_to_cashier_dashboard(): void
    {
        $response = $this->post('/login', [
            'email' => 'kasir@dressell.test',
            'password' => 'Kasir12345',
            'role' => 'cashier',
        ]);

        $response->assertRedirect('/cashier/dashboard');
        $this->assertTrue(Auth::guard('admin')->check());
        $this->assertFalse(Auth::guard('web')->check());
        $this->assertEquals('cashier', Auth::guard('admin')->user()->role);
    }

    public function test_customer_can_login_and_redirects_to_customer_dashboard(): void
    {
        $response = $this->post('/login', [
            'email' => 'customer@dressell.test',
            'password' => 'Customer12345',
            'role' => 'customer',
        ]);

        $response->assertRedirect('/customer/dashboard');
        $this->assertTrue(Auth::guard('web')->check());
        $this->assertFalse(Auth::guard('admin')->check());
    }

    public function test_customer_cannot_login_as_admin(): void
    {
        $response = $this->from('/login')->post('/login', [
            'email' => 'customer@dressell.test',
            'password' => 'Customer12345',
            'role' => 'admin',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::guard('admin')->check());
        $this->assertFalse(Auth::guard('web')->check());
    }

    public function test_admin_cannot_login_as_customer(): void
    {
        $response = $this->from('/login')->post('/login', [
            'email' => 'admin@dressell.test',
            'password' => 'Admin12345',
            'role' => 'customer',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::guard('admin')->check());
        $this->assertFalse(Auth::guard('web')->check());
    }

    public function test_cashier_cannot_login_as_admin(): void
    {
        $response = $this->from('/login')->post('/login', [
            'email' => 'kasir@dressell.test',
            'password' => 'Kasir12345',
            'role' => 'admin',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::guard('admin')->check());
    }

    public function test_admin_cannot_login_as_cashier(): void
    {
        $response = $this->from('/login')->post('/login', [
            'email' => 'admin@dressell.test',
            'password' => 'Admin12345',
            'role' => 'cashier',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::guard('admin')->check());
    }

    public function test_login_fails_with_invalid_password(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@dressell.test',
            'password' => 'WrongPassword',
            'role' => 'admin',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::guard('admin')->check());
        $this->assertFalse(Auth::guard('web')->check());
    }

    public function test_login_fails_with_unregistered_email(): void
    {
        $response = $this->post('/login', [
            'email' => 'nonexistent@dressell.test',
            'password' => 'SomePassword',
            'role' => 'customer',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::guard('admin')->check());
        $this->assertFalse(Auth::guard('web')->check());
    }

    public function test_admin_can_logout(): void
    {
        $admin = Admin::where('email', 'admin@dressell.test')->first();
        $this->actingAs($admin, 'admin');

        $this->assertTrue(Auth::guard('admin')->check());

        $response = $this->post('/logout');
        $response->assertRedirect('/login');

        $this->assertFalse(Auth::guard('admin')->check());
    }

    public function test_customer_can_logout(): void
    {
        $customer = User::where('email', 'customer@dressell.test')->first();
        $this->actingAs($customer, 'web');

        $this->assertTrue(Auth::guard('web')->check());

        $response = $this->post('/logout');
        $response->assertRedirect('/login');

        $this->assertFalse(Auth::guard('web')->check());
    }

    public function test_session_conflict_prevention_when_email_exists_in_both_tables(): void
    {
        // Simulasi jika email customer sama dengan email admin di tabel berbeda
        $sharedEmail = 'dual@dressell.test';
        Admin::updateOrCreate(
            ['email' => $sharedEmail],
            [
                'name' => 'Dual Admin',
                'password' => 'AdminPass123',
                'role' => 'admin',
            ]
        );
        User::updateOrCreate(
            ['email' => $sharedEmail],
            [
                'name' => 'Dual Customer',
                'password' => 'CustomerPass123',
            ]
        );

        // Kasus 1: Menggunakan role Admin -> masuk sebagai admin ke /admin/dashboard
        $resAdmin = $this->post('/login', [
            'email' => $sharedEmail,
            'password' => 'AdminPass123',
            'role' => 'admin',
        ]);
        $resAdmin->assertRedirect('/admin/dashboard');
        $this->assertTrue(Auth::guard('admin')->check());
        $this->assertFalse(Auth::guard('web')->check());

        // Logout
        $this->post('/logout');

        // Kasus 2: Menggunakan role Customer -> masuk sebagai customer ke /customer/dashboard
        $resCust = $this->post('/login', [
            'email' => $sharedEmail,
            'password' => 'CustomerPass123',
            'role' => 'customer',
        ]);
        $resCust->assertRedirect('/customer/dashboard');
        $this->assertTrue(Auth::guard('web')->check());
        $this->assertFalse(Auth::guard('admin')->check());

        // Cleanup
        Admin::where('email', $sharedEmail)->delete();
        User::where('email', $sharedEmail)->delete();
    }
}
