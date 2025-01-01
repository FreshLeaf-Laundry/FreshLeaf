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
            // buat 2 order untuk setiap user
            for ($i = 1; $i <= 2; $i++) {
                Order::create([
                    'user_id' => $user->id,
                    'kg' => rand(1, 10),
                    'order_date' => now()->subDays(rand(1, 30)),
                    'pickup_date' => now()->addDays(rand(1, 7)),
                    'total_price' => rand(50000, 200000)
                ]);
            }
        }
    }
} 