<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('nama_peran', 'Admin')->firstOrFail();

        User::firstOrCreate(
            ['email' => 'admin@travelgo.test'],
            [
                'name' => 'Admin Travel GO',
                'password' => 'admin123',
                'role_id' => $adminRole->id,
                'role' => 'admin',
                'status' => 'aktif',
            ],
        );
    }
}
