<?php

namespace Database\Factories;

use App\Models\Actor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Actor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->userName,
            'firstName' => $this->faker->name,
            'lastName' => $this->faker->lastName,
            'password' => $this->faker->password,
            'phone' => $this->faker->phoneNumber,
            'type' => $this->faker->boolean
        ];
    }
}
