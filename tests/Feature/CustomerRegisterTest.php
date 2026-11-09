<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CustomerRegisterTest extends TestCase
{
    public function test_register_page_renders_successfully(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('Daftar <em>Akun Baru</em>', false);
        $response->assertDontSee('Atelier Rental Studio');
        $response->assertSee('Nama Lengkap');
        $response->assertSee('Alamat Email');
        $response->assertSee('Konfirmasi Password');
        $response->assertSee('auth-logo-badge');
        $response->assertSee('auth-card--register');
        $response->assertSee('assets/css/auth.css');
        $response->assertSee('assets/js/auth.js');
    }

    public function test_customer_can_register_successfully_and_redirects_to_customer_dashboard(): void
    {
        $email = 'clarissa.test@dressell.id';

        // Pastikan tidak ada data sisa sebelum pengujian
        User::where('email', $email)->delete();

        $response = $this->post('/register', [
            'name' => 'Clarissa Anastasia',
            'email' => $email,
            'password' => 'Rahasia12345',
            'password_confirmation' => 'Rahasia12345',
        ]);

        $response->assertRedirect('/customer/dashboard');

        // Pastikan customer tersimpan di tabel users, bukan admins
        $this->assertDatabaseHas('users', [
            'email' => $email,
            'name' => 'Clarissa Anastasia',
        ]);
        $this->assertDatabaseMissing('admins', [
            'email' => $email,
        ]);

        $user = User::where('email', $email)->first();
        $this->assertNotNull($user);
        $this->assertTrue(Hash::check('Rahasia12345', $user->password));

        // Pastikan login otomatis menggunakan guard web
        $this->assertTrue(Auth::guard('web')->check());
        $this->assertEquals($user->id, Auth::guard('web')->id());
        $this->assertFalse(Auth::guard('admin')->check());

        // Cleanup
        $user->delete();
    }

    public function test_registration_fails_when_email_is_already_registered(): void
    {
        $existing = User::where('email', 'customer@dressell.test')->first();
        $this->assertNotNull($existing);

        $response = $this->from('/register')->post('/register', [
            'name' => 'Pengguna Lain',
            'email' => 'customer@dressell.test',
            'password' => 'Password12345',
            'password_confirmation' => 'Password12345',
        ]);

        $response->assertRedirect('/register');
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::guard('web')->check());
    }

    public function test_registration_fails_when_password_is_too_short(): void
    {
        $response = $this->from('/register')->post('/register', [
            'name' => 'Budi Santoso',
            'email' => 'budi.pendek@dressell.test',
            'password' => 'pendek',
            'password_confirmation' => 'pendek',
        ]);

        $response->assertRedirect('/register');
        $response->assertSessionHasErrors('password');
        $this->assertFalse(Auth::guard('web')->check());
    }

    public function test_registration_fails_when_password_confirmation_does_not_match(): void
    {
        $response = $this->from('/register')->post('/register', [
            'name' => 'Siti Rahma',
            'email' => 'siti.rahma@dressell.test',
            'password' => 'Password12345',
            'password_confirmation' => 'PasswordBeda999',
        ]);

        $response->assertRedirect('/register');
        $response->assertSessionHasErrors('password');
        $this->assertFalse(Auth::guard('web')->check());
    }

    public function test_authenticated_customer_visiting_register_is_redirected_to_dashboard(): void
    {
        $customer = User::where('email', 'customer@dressell.test')->first();
        $this->actingAs($customer, 'web');

        $response = $this->get('/register');
        $response->assertRedirect('/customer/dashboard');
    }

    public function test_authenticated_admin_visiting_register_is_redirected_to_admin_dashboard(): void
    {
        $admin = Admin::where('email', 'admin@dressell.test')->first();
        $this->actingAs($admin, 'admin');

        $response = $this->get('/register');
        $response->assertRedirect('/admin/dashboard');
    }
}
