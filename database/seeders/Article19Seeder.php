<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article19;

class Article19Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $articles = [
        [
            'name_eng' => 'Coconut Soup with Galangal (Tom Kha)',
            'name_japan' => '',
            'flag_status' => '',
        ],
        [
            'name_eng' => 'Spicy/Hot & Sour Soup (Tom Yam)',
            'name_japan' => '',
            'flag_status' => '',
        ],
        [
            'name_eng' => 'Panaeng Curry (Panaeng Curry)',
            'name_japan' => '',
            'flag_status' => '',
        ],
        [
            'name_eng' => 'Massaman Curry (Massaman Curry)',
            'name_japan' => '',
            'flag_status' => '',
        ],
        [
            'name_eng' => 'Green Curry (Green Curry)',
            'name_japan' => '',
            'flag_status' => '',
        ],
        [
            'name_eng' => 'Red Curry (Red Curry)',
            'name_japan' => '',
            'flag_status' => '',
        ],
        [
            'name_eng' => 'Northern Thai Curry Noodle Soup (Khao Soi)',
            'name_japan' => '',
            'flag_status' => '',
        ],
        [
            'name_eng' => 'Stir-fried Rice Noodles (Pad Thai)',
            'name_japan' => '',
            'flag_status' => '',
        ],
        [
            'name_eng' => 'Shrimp Paste (Nam Prik Ka Pi)',
            'name_japan' => '',
            'flag_status' => '',
        ],
        [
            'name_eng' => 'Stir-fry with Holy Basil (Ka Phrao)',
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
        Article19::create($article);
    }
}
}
