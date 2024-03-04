<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Role::create(['name' => 'User']);
        Role::create(['name' => 'Moderator']);
        Role::create(['name' => 'Admin']);
    }
}
