<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'category_name'        => 'Technology',
                'category_description' => 'Electronics, gadgets, and circuit boards of all kinds.',
            ],
            [
                'category_name'        => 'Toys',
                'category_description' => 'Action figures, collectibles, and anything fun to play with.',
            ],
            [
                'category_name'        => 'Food',
                'category_description' => 'Snacks, pantry staples, and ready to eat meals.',
            ],
            [
                'category_name'        => 'Trading Cards',
                'category_description' => 'TCG booster boxes, singles, and accessories.',
            ],
            [
                'category_name'        => 'Home & Garden',
                'category_description' => 'Everything you need to upgrade your living space.',
            ],
        ];

        foreach ($categories as $category) {
           Category::create($category);
        }
    }
}
