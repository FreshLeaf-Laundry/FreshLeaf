<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemsStore;

class StoreTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'name' => 'ecoClean Detergent',
                'slug' => 'ecoClean-detergent',
                'description' => 'Detergent ramah lingkungan',
                'price' => 100000,
                'stock' => 10,
                'category' => 'Detergent',
                'image_path' => 'images/store/ecodetergent.jpg',
                'is_active' => true
            ],
            [
                'name' => 'ecoClean Softener',
                'slug' => 'ecoClean-softener',
                'description' => 'Softener ramah lingkungan',
                'price' => 200000,
                'stock' => 15,
                'category' => 'Softener',
                'image_path' => 'images/store/ecodetergent.jpg',
                'is_active' => true
            ],
            [
                'name' => 'ecoClean Bleach',
                'slug' => 'ecoClean-bleach',
                'description' => 'Pemutih ramah lingkungan',
                'price' => 150000,
                'stock' => 20,
                'category' => 'Pemutih',
                'image_path' => 'images/store/ecodetergent.jpg',
                'is_active' => true
            ],
        ];

        foreach ($items as $item) {
            ItemsStore::create($item);
        }
    }
}
