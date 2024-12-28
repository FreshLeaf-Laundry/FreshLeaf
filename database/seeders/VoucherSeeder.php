<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    public function run()
    {
        $vouchers = [
            [
                'code' => 'WELCOME10',
                'discount' => 10,
                'expiry_date' => now()->addMonths(1),
            ],
            [
                'code' => 'SAVE20',
                'discount' => 20,
                'expiry_date' => now()->addMonths(2),
            ],
            [
                'code' => 'FRESH30',
                'discount' => 30,
                'expiry_date' => now()->addMonths(3),
            ],
        ];

        foreach ($vouchers as $voucher) {
            Voucher::create($voucher);
        }
    }
} 