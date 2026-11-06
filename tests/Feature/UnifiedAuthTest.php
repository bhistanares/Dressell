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
        $response->assertSee('Selamat datang');
        $response->assertSee('Akun Dressell');
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

    public function test_admin_can_login_and_redirects_to_admin_dashboard(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@dressell.test',
            'password' => 'Admin12345',
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
        ]);

        $response->assertRedirect('/cashier/dashboard');
        $this->assertTrue(Auth::guard('admin')->check());
        $this->assertFalse(Auth::guard('web')->check());
        $this->assertEquals('cashier', Auth::guard('admin')->user()->role);
    }

    public function test_customer_can_login_and_redirects_to_homepage(): void
    {
        $response = $this->post('/login', [
            'email' => 'customer@dressell.test',
            'password' => 'Customer12345',
        ]);

        $response->assertRedirect('/');
        $this->assertTrue(Auth::guard('web')->check());
        $this->assertFalse(Auth::guard('admin')->check());
    }

    public function test_login_fails_with_invalid_password(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@dressell.test',
            'password' => 'WrongPassword',
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

        // Kasus 1: Menggunakan kredensial Admin -> masuk sebagai admin
        $resAdmin = $this->post('/login', [
            'email' => $sharedEmail,
            'password' => 'AdminPass123',
        ]);
        $resAdmin->assertRedirect('/admin/dashboard');
        $this->assertTrue(Auth::guard('admin')->check());
        $this->assertFalse(Auth::guard('web')->check());

        // Logout
        $this->post('/logout');

        // Kasus 2: Menggunakan kredensial Customer -> masuk sebagai customer
        $resCust = $this->post('/login', [
            'email' => $sharedEmail,
            'password' => 'CustomerPass123',
        ]);
        $resCust->assertRedirect('/');
        $this->assertTrue(Auth::guard('web')->check());
        $this->assertFalse(Auth::guard('admin')->check());

        // Cleanup
        Admin::where('email', $sharedEmail)->delete();
        User::where('email', $sharedEmail)->delete();
    }
}
