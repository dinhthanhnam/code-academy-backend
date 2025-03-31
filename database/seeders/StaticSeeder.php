<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default_languages = [
            [
                "name" => "c_cpp"
            ],
            [
                "name" => "javascript"
            ],
            [
                "name" => "java"
            ],
            [
                "name" => "python"
            ]
        ];

        $default_topics = [
            [
                "name" => "oop"
            ],
            [
                "name" => "strings"
            ],
            [
                "name" => "arrays"
            ],
            [
                "name" => "recursion"
            ],
            [
                "name" => "sorting"
            ],
            [
                "name" => "searching"
            ],
            [
                "name" => "dp"
            ],
            [
                "name" => "graphs"
            ],
            [
                "name" => "tree"
            ],
        ];

        foreach ($default_languages as $language) {
        Language::create([
            'name' => $language['name']
        ]);
        }

        foreach ($default_topics as $topic) {
            Topic::create([
                'name' => $topic['name']
            ]);
        }
    }
}
