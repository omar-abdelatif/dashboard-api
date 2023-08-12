<?php

namespace Database\Seeders;

use App\Models\Tags;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tagTitles = [
            'Html',
            'Css',
            'Js',
            'React.js',
            'Next.js',
            'Laravel',
            'Nodejs',
            'Jquery',
            'Tailwind',
            'Express',
        ];
        foreach ($tagTitles as $tagTitle) {
            Tags::create([
                'title' => $tagTitle,
            ]);
        }
    }
}
