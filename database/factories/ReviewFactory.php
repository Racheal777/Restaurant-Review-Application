<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'comment' => 'Food is nice',
            'ratings' => 5,
            'restaurant_id' => Restaurant::factory(), //pasing the restaurant id by creating it
            'user_id' => User::factory()

        ];
    }
}
