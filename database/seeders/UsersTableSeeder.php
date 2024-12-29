<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Admin account
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'is_admin' => '1',
            'address' => 'Jl. Admin No. 1'
        ]);

        // Regular users
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => "User {$i}",
                'email' => "user{$i}@gmail.com",
                'password' => Hash::make('user123'),
                'is_admin' => '0',
                'address' => "Jl. User No. {$i}"
            ]);
        }
    }
}
