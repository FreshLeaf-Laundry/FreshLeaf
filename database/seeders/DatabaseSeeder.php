<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            // masukin seeder lain kesini
            UsersTableSeeder::class,
            FaqSeeder::class,
            VoucherSeeder::class
            ]);
    }
}
