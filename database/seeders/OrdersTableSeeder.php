<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::where('is_admin', 0)->get();

        foreach ($users as $user) {
            // Create 2 orders for each user
            for ($i = 1; $i <= 2; $i++) {
                Order::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'phone' => '08' . rand(1000000000, 9999999999),
                    'address' => $user->address,
                    'product' => 'Product ' . $i,
                    'quantity' => rand(1, 5),
                    'status' => rand(0, 1) ? 'pending' : 'completed',
                    'created_at' => now()->subDays(rand(1, 30))
                ]);
            }
        }
    }
} 