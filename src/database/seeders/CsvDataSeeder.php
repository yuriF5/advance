<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CsvDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = Reader::createFromPath(database_path('path/to/csv_file.csv'), 'r');
        $csv->setHeaderOffset(0); // ヘッダー行をスキップする

        foreach ($csv as $record) {
            DB::table('shops')->insert([
                'name' => $record['name'],
                'area' => $record['area'],
                'genre' => $record['genre'],
                'image_url' => $record['image_url'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
