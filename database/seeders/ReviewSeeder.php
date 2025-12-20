<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Image;
use App\UserRole;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🔄 Creating reviews...');

        // Get all users (exclude admin)
        $users = User::where('role', UserRole:: USER)->get();

        if ($users->isEmpty()) {
            $this->command->error('❌ No users found!  Run UserSeeder first.');
            return;
        }

        // Get all images
        $images = Image:: all();

        if ($images->isEmpty()) {
            $this->command->error('❌ No images found! Run ImageSeeder first.');
            return;
        }

        $totalReviews = 0;

        foreach ($images as $image) {
            // Setiap image dapat 7-15 review
            $reviewCount = rand(7, 15);

            // Ambil random users
            $reviewers = $users->random(min($reviewCount, $users->count()));

            foreach ($reviewers as $reviewer) {
                // Cek apakah user ini sudah review image ini
                $existingReview = Review::where('user_id', $reviewer->id)
                    ->where('image_id', $image->id)
                    ->exists();

                if (!$existingReview) {
                    Review::create([
                        'user_id' => $reviewer->id,
                        'image_id' => $image->id,
                        'comment' => $this->generateComment(),
                        'created_at' => fake()->dateTimeBetween($image->created_at, 'now'),
                        'updated_at' => now(),
                    ]);
                    $totalReviews++;
                }
            }
        }

        $this->command->info("✅ Created {$totalReviews} reviews");
        $this->command->info('');
        $this->command->info('========================================');
        $this->command->info('🎉 DATABASE SEEDING COMPLETED!');
        $this->command->info('========================================');
        $this->command->info('');
        $this->command->info('📊 Summary:');
        $this->command->info('   • Users:  ' . User::count());
        $this->command->info('   • Images:  ' . Image::count());
        $this->command->info('   • Reviews: ' . Review::count());
        $this->command->info('');
        $this->command->info('🔑 Test Accounts:');
        $this->command->info('   Admin: admin@gmail.com / password');
        $this->command->info('   User:   user@gmail.com / password');
        $this->command->info('');
        $this->command->info('🌐 Access:  http://localhost:8000');
        $this->command->info('========================================');
    }

    /**
     * Generate realistic comment
     */
    private function generateComment(): string
    {
        $comments = [
            'Absolutely stunning!  The lighting in this photo is perfect.',
            'Wow, this is incredible work! Love the composition.',
            'Beautiful capture!  The colors are so vibrant.',
            'Amazing shot! This belongs in a gallery.',
            'Breathtaking! The detail is incredible.',
            'This is fantastic! Great use of depth of field.',
            'Love everything about this photo!  Well done.',
            'The perspective here is really unique and interesting.',
            'Gorgeous! The mood you captured is perfect.',
            'Outstanding work! Professional quality.',
            'This photo tells such a beautiful story.',
            'The textures and details are amazing! ',
            'Perfect timing on this shot!',
            'Love the creativity here!',
            'This is magazine-worthy photography.',
            'Incredible composition and framing!',
            'The way you captured the light is phenomenal.',
            'This evokes such strong emotions.  Beautiful.',
            'Technical excellence combined with artistic vision! ',
            'One of the best photos I\'ve seen in a while.',
            'The clarity and sharpness are impressive! ',
            'Love how you framed this subject.',
            'The bokeh effect here is stunning! ',
            'Great eye for detail! ',
            'This deserves to be printed and framed.',
            'Phenomenal work! Keep it up.',
            'The atmosphere in this photo is perfect.',
            'Love the contrast and tones!',
            'This is wallpaper-worthy! ',
            'Spectacular shot! Thanks for sharing.',
            'The composition draws the eye perfectly.',
            'Such a powerful image!',
            'This captures the essence beautifully.',
            'Masterful use of shadows and highlights.',
            'The emotion in this photo is palpable.',
            'Incredible moment captured perfectly! ',
            'This has such a professional feel to it.',
            'Love the storytelling in this image.',
            'The technical quality is outstanding! ',
            'This photo has so much depth and character.',
            'Mesmerizing! I can\'t stop looking at this.',
            'The colors pop beautifully!',
            'What a fantastic perspective!',
            'This is pure artistry.',
            'Love the mood and atmosphere.',
            'Exceptional work! Keep creating.',
            'The details are so crisp and clear.',
            'This deserves an award! ',
            'Brilliantly executed! ',
            'This speaks to my soul.',
        ];

        return fake()->randomElement($comments);
    }
}
