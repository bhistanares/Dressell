<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@dressell.test'],
            [
                'name' => 'Admin Dressell',
                'password' => 'Admin12345',
                'role' => 'admin',
                'phone' => '081775122133',
            ]
        );

        Admin::updateOrCreate(
            ['email' => 'kasir@dressell.test'],
            [
                'name' => 'Kasir Dressell',
                'password' => 'Kasir12345',
                'role' => 'cashier',
                'phone' => '081775122133',
            ]
        );
    }
}
