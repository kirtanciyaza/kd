<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'desc' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(10, 1000),
            'status' => $this->faker->randomElement(['Yes', 'No']),
        ];
    }
}
