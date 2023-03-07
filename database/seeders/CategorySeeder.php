<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objs = [
            [
                'Burgerler we Sandwiçler', 'Burgers and Sandwiches'
            ],
            [
                'Süýjilik', 'Desserts'
            ],
            [
                'Işdä Açarlar', 'Salads'
            ],
            [
                'Ertirlik', 'Breakfast'
            ],
            [
                'Cay we Kofe', 'Tea and Coffee'
            ]

        ];
        for ($i = 0; $i < count($objs); $i++) {
            $category = Category::create([
                'name_tm' => $objs[$i][0],
                'name_en' => $objs[$i][1],
                'sort_order' => $i + 1,
            ]);

        }
    }
}
