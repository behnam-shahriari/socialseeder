<?php

namespace Database\Factories;

use App\Models\Actor;
use App\Services\Core\EnumHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActorFactory extends Factory
{
    protected $model = Actor::class;

    public function definition()
    {
        return [
            'email' => $this->faker->email,
            'firstName' => $this->faker->name,
            'lastName' => $this->faker->lastName,
            'password' => $this->faker->password,
            'phone' => $this->faker->phoneNumber,
            'permission' => $this->faker->randomElement(EnumHelper::actorPermissions())
        ];
    }
}
