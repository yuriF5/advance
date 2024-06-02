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

        // 特定の条件を持つユーザーを作成
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => \Str::random(10),
            'role' => 0,
        ]);

        User::create([
            'name' => 'shop',
            'email' => 'shop@shop.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => \Str::random(10),
            'role' => 1,
        ]);

        User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => \Str::random(10),
            'role' => 2,
        ]);
        
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