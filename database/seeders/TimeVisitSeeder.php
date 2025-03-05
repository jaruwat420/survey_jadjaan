<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TimeVisit;

class TimeVisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'time' => '11 March 2025 : 12 p.m. – 3 p.m.',
                'flag_status' => '',
            ],
            [
                'time' => '11 March 2025 : 3 p.m. – 5 p.m.',
                'flag_status' => '',
            ],
            [
                'time' => '12  March 2025 : 9 a.m. – 12 p.m.',
                'flag_status' => '',
            ],
            [
                'time' => '12  March 2025 : 12 p.m. – 3 p.m.',
                'flag_status' => '',
            ],
            [
                'time' => '13  March 2025 : 9 a.m. – 12 p.m.',
                'flag_status' => '',
            ],
            [
                'time' => '13  March 2025 : 12 p.m. – 3 p.m.',
                'flag_status' => '',
            ],
            [
                'time' => '13  March 2025 : 3 p.m. – 5 p.m.',
                'flag_status' => '',
            ],
            [
                'time' => '14  March 2025 : 9 a.m. – 12 p.m.',
                'flag_status' => '',
            ],
            [
                'time' => '14  March 2025 : 12 p.m. – 3 p.m.',
                'flag_status' => '',
            ],
            [
                'time' => '14  March 2025 : 3 p.m. – 5 p.m.',
                'flag_status' => '',
            ]
        ];

        foreach ($articles as $article) {
            TimeVisit::create($article);
        }
    }
}
