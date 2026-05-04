<?php

namespace Database\Factories;

use App\Models\Bid;
use App\Models\User;
use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'advertisement_id' => Advertisement::inRandomOrder()->first()->id,
            'height' => rand(0, 100),
            'status' => $this->faker->randomElement(['accepted','rejected','in review']),
        ];
    }
}
