<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        $comments = [
            'Absolutely stunning! The lighting in this photo is perfect.',
            'Wow, this is incredible work!  Love the composition.',
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
        ];

        return [
            'user_id' => User::where('role', 'user')->inRandomOrder()->first()->id,
            'image_id' => Image::inRandomOrder()->first()->id,
            'comment' => fake()->randomElement($comments),
            'created_at' => fake()->dateTimeBetween('-3 months', 'now'),
            'updated_at' => now(),
        ];
    }
}
