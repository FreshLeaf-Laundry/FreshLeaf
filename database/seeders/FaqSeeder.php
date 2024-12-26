<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FAQ;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apa maksudnya laundry ramah lingkungan?',
                'answer' => 'FreshLeaf sebagai layanan laundry ramah lingkungan, kami menggunakan bahan pencucian ramah lingkungan dan bahan pencucian ramah lingkungan demi memastikan keberlanjutan kehidupan muka bumi.',
            ],
            [
                'question' => 'Kenapa harus memilih FreshLeaf?',
                'answer' => 'FreshLeaf sebagai layanan laundry ramah lingkungan, kami menggunakan detergen ramah lingkungan dan sumber energi terbarukan demi menjaga kelangsungan ekosistem yang baik.',
            ],
            [
                'question' => 'Apakah saya bisa membeli detergen yang digunakan FreshLeaf?',
                'answer' => 'FreshLeaf mendukung setiap aksi penyelamatan lingkungan, oleh karena itu kami juga menyediakan detergen ramah lingkungan yang bisa Anda beli di toko kami.',
            ],
            [
                'question' => 'Lorem ipsum dolor sit amet?',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            ],
            [
                'question' => 'Apakah tersedia membership?',
                'answer' => 'Kami menyediakan membership untuk memberikan layanan yang lebih terjangkau dan lebih fleksibel terutama bagi teman-teman pecinta lingkungan.',
            ],
        ];

        foreach ($faqs as $faq) {
            FAQ::create($faq);
        }
    }
}
