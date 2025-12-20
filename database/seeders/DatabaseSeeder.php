<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call seeders
        $this->call([
            UserSeeder::class,
            ImageSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
