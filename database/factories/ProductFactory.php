<?php

namespace Database\Factories;

use App\Models\Actor;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {

        return [
            'title' => $this->faker->name,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomDigit,
            'availability' => $this->faker->numberBetween(0,100),
            'enable' => $this->faker->boolean,
            'created_by' => Actor::factory()->create()->id,
        ];
    }
}
