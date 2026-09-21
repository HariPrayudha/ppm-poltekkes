<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superadmin@ppm.ac.id'],
            [
                'name' => 'Super Admin PPM',
                'password' => Hash::make('password'),
                'role' => UserRole::SuperAdmin,
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'operator@ppm.ac.id'],
            [
                'name' => 'Operator Mutu',
                'password' => Hash::make('password'),
                'role' => UserRole::OperatorMutu,
                'is_active' => true,
            ]
        );
    }
}
