<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article22;

class Article22Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'name_eng' => 'Convenience',
                'name_japan' => '',
                'flag_status' => '',
            ],
            [
                'name_eng' => 'Authentic taste',
                'name_japan' => '',
                'flag_status' => '',
            ],
            [
                'name_eng' => 'Healthy ingredients',
                'name_japan' => '',
                'flag_status' => '',
            ],
            [
                'name_eng' => 'Affordability',
                'name_japan' => '',
                'flag_status' => '',
            ],
            [
                'name_eng' => 'Easy instructions',
                'name_japan' => '',
                'flag_status' => '',
            ],
            [
                'name_eng' => 'Brand reputation',
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
            Article22::create($article);
        }
    }
}
