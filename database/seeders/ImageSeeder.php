<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    public function run(): void
    {
        Image::create([
            'title' => 'Sample Photo 1',
            'file_low_res' => 'images/low/sample1.jpg',
            'file_high_res' => 'images/high/sample1.jpg',
        ]);

        Image::create([
            'title' => 'Sample Photo 2',
            'file_low_res' => 'images/low/sample2.jpg',
            'file_high_res' => 'images/high/sample2.jpg',
        ]);
    }
}
