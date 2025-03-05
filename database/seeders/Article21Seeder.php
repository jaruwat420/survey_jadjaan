<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article21;

class Article21Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $articles = [
        [
            'name_eng' => 'Excessive cost',
            'name_japan' => '',
            'flag_status' => '',
        ],
        [
            'name_eng' => 'Concerns regarding quality',
            'name_japan' => '',
            'flag_status' => '',
        ],
        [
            'name_eng' => 'Concerns regarding taste',
            'name_japan' => '',
            'flag_status' => '',
        ],
        [
            'name_eng' => 'Concerns regarding unfamiliar ingredients',
            'name_japan' => '',
            'flag_status' => '',
        ],
        [
            'name_eng' => 'Limited availability in local stores',
            'name_japan' => '',
            'flag_status' => '',
        ],
        [
            'name_eng' => 'Other',
            'name_japan' => '',
            'flag_status' => '',
        ]
    ];

    foreach ($articles as $article) {
        Article21::create($article);
    }
}
}
