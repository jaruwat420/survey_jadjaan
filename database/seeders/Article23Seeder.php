<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article23;

class Article23Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'name_eng' => 'Thailand',
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
            Article23::create($article);
        }
    }
}
