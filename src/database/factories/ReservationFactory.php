<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Support\Carbon;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomDate = Carbon::now()->subWeek(2)->addDays(rand(0, 16))->toDateString();

        $status = Carbon::parse($randomDate)->lte(Carbon::today()) ? '来店' : '予約';

        return [
            'user_id' => 2,
            'shop_id' => function () {
                return Shop::inRandomOrder()->first()->id;
            },
            'date' => $randomDate,
            'time' => $this->faker->randomElement(['20:00', '20:30', '21:00', '21:30', '22:00']),
            'number_of_people' => $this->faker->numberBetween(1, 6),
            'visit_status' => $this->faker->randomElement(['予約中', '来店済み', '強制キャンセル']),
            'payment_status' => $this->faker->randomElement(['支払い済み', '未払い']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
