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
                'name' => 'Product 1',
                'slug' => 'product-1',
                'description' => 'Description for product 1',
                'price' => 100000,
                'stock' => 10,
                'category' => 'Category A',
                'image_path' => 'images/store/default.jpg',
                'is_active' => true
            ],
            [
                'name' => 'Product 2',
                'slug' => 'product-2',
                'description' => 'Description for product 2',
                'price' => 200000,
                'stock' => 15,
                'category' => 'Category B',
                'image_path' => 'images/store/default.jpg',
                'is_active' => true
            ],
            [
                'name' => 'Product 3',
                'slug' => 'product-3',
                'description' => 'Description for product 3',
                'price' => 150000,
                'stock' => 20,
                'category' => 'Category A',
                'image_path' => 'images/store/default.jpg',
                'is_active' => true
            ],
        ];

        foreach ($items as $item) {
            ItemsStore::create($item);
        }
    }
}
