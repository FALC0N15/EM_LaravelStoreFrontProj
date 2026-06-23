<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'product_name' => $this->faker->words(3, true),
            'product_description' => $this->faker->optional()->paragraph(),
            'product_price' => $this->faker->randomFloat(2, 5, 500),
            'stock_quantity' => $this->faker->numberBetween(0, 100),
            'category_id' => Category::factory(),
        ];
    }
}
