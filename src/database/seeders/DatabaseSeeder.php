<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Review;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Shop;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::factory(10)->create();
        
    $this->call([
            AreasTableSeeder::class,
            GenresTableSeeder::class,
            ShopsTableSeeder::class, 
        ]);

        Favorite::factory(10)->create();
        Reservation::factory(10)->create();
        Review::factory(10)->create();

}
}