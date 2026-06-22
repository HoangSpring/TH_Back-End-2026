<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Laravel',
            'PHP',
            'Python',
            'VueJS',
            'ReactJS',
            'TailwindCSS',
            'Bootstrap',
            'MySQL',
            'Docker',
            'Git',
            'AI',
            'Machine Learning',
            'DevOps',
            'Security',
            'Web Design'
        ];

        foreach ($tags as $tagName) {
            Tag::create([
                'name' => $tagName,
                'slug' => Str::slug($tagName),
            ]);
        }
    }
}