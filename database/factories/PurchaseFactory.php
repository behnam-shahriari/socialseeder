<?php

namespace Database\Factories;

use App\Models\Actor;
use App\Models\Product;
use App\Models\Purchase;
use App\Services\Core\EnumHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition()
    {
        return [
            'actor_id' => Actor::factory()->create()->id,
            'product_id' => Product::factory()->create()->id,
            'price' => $this->faker->randomDigit,
            'quantity' => $this->faker->randomDigit,
            'status' => $this->faker->randomElement(EnumHelper::purchaseStatuses()),
        ];
    }
}
