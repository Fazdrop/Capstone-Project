<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Division;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminDivision = Division::where('name', 'Admin')->first();
        $financeDivision = Division::where('name', 'Finance')->first();

        // User admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'division_id' => $adminDivision ? $adminDivision->id : null,
            'role' => 'admin',
        ]);

        // User fairuz
        User::create([
            'name' => 'Fairuz',
            'email' => 'fairuz@example.com',
            'password' => Hash::make('fairuz123'),
            'division_id' => $financeDivision ? $financeDivision->id : null,
            'role' => 'hod',
        ]);
    }
}
