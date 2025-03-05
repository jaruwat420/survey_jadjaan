<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Article13;

class Article13Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'name_eng' => 'Unfamiliarity with Thai cuisine',
                'name_japan' => '',
                'flag_status' => '',
            ],
            [
                'name_eng' => 'Dislike of spicy food',
                'name_japan' => '',
                'flag_status' => '',
            ],
            [
                'name_eng' => 'Lack of access to Thai restaurants or products',
                'name_japan' => '',
                'flag_status' => '',
            ],
            [
                'name_eng' => 'Excessive price',
                'name_japan' => '',
                'flag_status' => '',
            ],
            [
                'name_eng' => 'Allergy to some Thai/local ingredients',
                'name_japan' => '',
                'flag_status' => '',
            ],
            [
                'name_eng' => 'Other',
                'name_japan' => '',
                'flag_status' => '',
            ],
        ];

        foreach ($articles as $article) {
            Article13::create($article);
        }
    }
}
