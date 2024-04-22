<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '寿司',
        ];
        DB::genre('name')->insert($param);

        $param = [
            'name' => '焼肉',
        ];
        DB::genre('name')->insert($param);

        $param = [
            'name' => '居酒屋',
        ];
        DB::genre('name')->insert($param);

        $param = [
            'name' => 'イタリアン',
        ];
        DB::genre('name')->insert($param);

        $param = [
            'name' => 'ラーメン',
        ];
        DB::genre('name')->insert($param);
    }
}
