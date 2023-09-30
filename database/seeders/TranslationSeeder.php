<?php

namespace Database\Seeders;

use App\Models\Translation;
use Illuminate\Database\Seeder;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            [
                'name' => 'Indonesia-English',
                'description' => 'sworn',
                'price' => 1000000,
                'type' => 'express',
                'process' => 1,
            ],
            [
                'name' => 'Indonesia-English',
                'description' => 'non-sworn',
                'price' => 950000,
                'type' => 'express',
                'process' => 1,
            ],
            [
                'name' => 'Indonesia-English',
                'description' => 'sworn',
                'price' => 900000,
                'type' => 'regular',
                'process' => 2,
            ],
            [
                'name' => 'Indonesia-English',
                'description' => 'non-sworn',
                'price' => 850000,
                'type' => 'regular',
                'process' => 2,
            ],
        ];

        foreach ($arr as $k => $v) {
            Translation::create($v);
        }
    }
}
