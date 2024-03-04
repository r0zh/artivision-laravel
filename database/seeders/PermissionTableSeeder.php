<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Permission::create(['name' => 'upload images']);
        Permission::create(['name' => 'delete own images']);
        Permission::create(['name' => 'view others private images']);
        Permission::create(['name' => 'delete others images']);
        Permission::create(['name' => 'delete users']);
    }
}
