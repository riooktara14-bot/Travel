<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['nama_peran' => 'Admin']);
        Role::firstOrCreate(['nama_peran' => 'Owner']);
        Role::firstOrCreate(['nama_peran' => 'Finance']);
        Role::firstOrCreate(['nama_peran' => 'Super Admin']);
    }
}
