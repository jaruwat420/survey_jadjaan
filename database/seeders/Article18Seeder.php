<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article18;

class Article18Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $articles = [
        [
            'name_eng' => 'For personal consumption',
            'name_japan' => '',
            'flag_status' => '',
        ],
        [
            'name_eng' => 'To try new and authentic flavors',
            'name_japan' => '',
            'flag_status' => '',
        ],
        [
            'name_eng' => 'For souvenirs, gifts, or special events',
            'name_japan' => '',
            'flag_status' => '',
        ],
        [
            'name_eng' => 'Others',
            'name_japan' => '',
            'flag_status' => '',
        ]
    ];

    foreach ($articles as $article) {
        Article18::create($article);
    }
    }
}
