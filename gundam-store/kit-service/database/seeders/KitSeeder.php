<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kit;

class KitSeeder extends Seeder
{
    public function run()
    {
        Kit::create([
            'name' => 'RX-78-2 Gundam',
            'grade' => 'Real Grade',
            'price' => 600000,
            'stock' => 10,
            'image_url' => './images/rgrx782.png'
        ]);

        Kit::create([
            'name' => 'Gundam Exia',
            'grade' => 'Master Grade',
            'price' => 800000,
            'stock' => 4,
            'image_url' => './images/mgexia.png'
        ]);

        Kit::create([
            'name' => 'Zeta Gundam',
            'grade' => 'Master Grade',
            'price' => 1200000,
            'stock' => 3,
            'image_url' => './images/mgzeta.png'
        ]);

        Kit::create([
            'name' => 'Gundam Barbatos',
            'grade' => 'Master Grade',
            'price' => 750000,
            'stock' => 3,
            'image_url' => './images/mgbarbatos.png'
        ]);

        Kit::create([
            'name' => 'Unicorn Gundam',
            'grade' => 'High Grade',
            'price' => 250000,
            'stock' => 8,
            'image_url' => './images/hgunicorn.png'
        ]);
    }
}