<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Callendrier de l\'avent Redbull',
            'description' => 'Calendrier de l\'avent RedBull avec une surprise chaque jour.',
            'price' => 69.99,
            'stock' => 80,
            'image' => 'default.webp', // Assurez-vous d'avoir une image par défaut dans 'public/storage/images/default.jpg'
        ]);
    }
}
