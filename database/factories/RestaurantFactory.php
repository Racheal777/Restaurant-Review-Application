<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RestaurantFactory extends Factory
{

    protected $model = Restaurant::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
             'name' => fake()->name(),
            'contact' => fake()->phoneNumber(),
            'website_url' => fake()->url(),
            'about' => fake()->paragraph(),
            'location' => fake()->address(),
            'category' => fake()->randomElement(['All', 'Continental', 'Local']),
            'working_hours' => fake()->time(),
            'images' => fake()->image(),
            'profileimage' => fake()->imageUrl()
        ];
    }
}

// 'name',
//         'about',
//         'contact',
//         'website_url',
//         'location',
//         'category',
//         'working_hours',
//         'average_ratings',
//         'images',
//         'profileimage',
