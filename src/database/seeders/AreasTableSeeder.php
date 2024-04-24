<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $param  = [
            ['name' => '東京'],
            ['name' => '大阪'],
            ['name' => '福岡'],
            // 他のエリアも追加する
        ];

        DB::table('areas')->insert($param);
    }
}
