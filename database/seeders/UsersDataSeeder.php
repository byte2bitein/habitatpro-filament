<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Tenant::all() as $tenant) {
            for ($i = 1; $i <= 1000; $i++) {
                User::create([
                    'email' => 'user-'.$i.'@admin.com',
                    'password' => 'User@12345',
                    'name' => 'user-'.$i,
                    'tenant_id' => $tenant->id,
                ]);
            }
        }
    }
}
