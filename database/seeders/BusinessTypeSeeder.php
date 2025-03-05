<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BusinessType;

class BusinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            $articles = [
                [
                    'name_eng' => 'Retailer',
                    'name_japan' => '',
                    'flag_status' => '',
                ],
                [
                    'name_eng' => 'Wholesaler',
                    'name_japan' => '',
                    'flag_status' => '',
                ],
                [
                    'name_eng' => 'Food Service',
                    'name_japan' => '',
                    'flag_status' => '',
                ],
                [
                    'name_eng' => 'E-Commerce',
                    'name_japan' => '',
                    'flag_status' => '',
                ],
                [
                    'name_eng' => 'Hotel',
                    'name_japan' => '',
                    'flag_status' => '',
                ],
                [
                    'name_eng' => 'Other ',
                    'name_japan' => '',
                    'flag_status' => '',
                ]
            ];

            foreach ($articles as $article) {
                BusinessType::create($article);
            }
        }
    }
}
