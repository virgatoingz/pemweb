<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (User::count() == 0) {
            // Ensure roles exist
            Role::firstOrCreate(['name' => 'super_admin']);
            Role::firstOrCreate(['name' => 'manager']);
            Role::firstOrCreate(['name' => 'petugas']);
            Role::firstOrCreate(['name' => 'user']);

            $superAdmin = User::factory()->create([
                'name' => 'Super Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
            ]);
            $superAdmin->assignRole('super_admin');

            $manager = \App\Models\User::factory()->create([
                'name' => 'Manager',
                'email' => 'manager@gudang.com',
                'password' => bcrypt('password'),
            ]);
            $manager->assignRole('manager');

            $petugas = \App\Models\User::factory()->create([
                'name' => 'Petugas',
                'email' => 'petugas@gudang.com',
                'password' => bcrypt('password'),
            ]);
            $petugas->assignRole('petugas');
            $user = \App\Models\User::factory()->create([
                'name' => 'User',
                'email' => 'user@gudang.com',
                'password' => bcrypt('password'),
            ]);
            $user->assignRole('user');
        }

        $this->call([
            RolePermissionSeeder::class,
            BarangSeeder::class
        ]);
    }

}