<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'hod'],
            ['name' => 'manager'],
            ['name' => 'bod']
            // Tambah role lain jika perlu
         ]);
    }
}
