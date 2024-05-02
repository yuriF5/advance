<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Shop;
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $stars = [1, 2, 3, 4, 5];
        return [
            'user_id' => 2,
            'shop_id' => function () {
                return Shop::inRandomOrder()->first()->id;
            },
            'star' => $this->faker->randomElement($stars),
            'comment' => $this->faker->sentence(), 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
