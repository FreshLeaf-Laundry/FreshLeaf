<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // buat akun dengan role admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), 
            'is_admin' => '1',
        ]);

        // buat 10 akun user
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => "User {$i}",
                'email' => "user{$i}@gmail.com",
                'password' => Hash::make('user123'),
                'is_admin' => '0',
            ]);
        }
    }
}
