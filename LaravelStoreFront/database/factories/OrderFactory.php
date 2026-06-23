<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'total_amount' => $this->faker->randomFloat(2, 20, 2000),
            'order_notes' => $this->faker->optional()->sentence(10),
            'order_status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'shipping_address' => $this->faker->address(),
            'billing_address' => $this->faker->address(),
            'order_quantity' => $this->faker->numberBetween(1, 20),
        ];
    }
}
