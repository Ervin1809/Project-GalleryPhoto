<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;
use App\Models\User;
use App\UserRole;
use Illuminate\Support\Facades\Storage;

class ImageSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🔄 Creating images...');

        // Get admin user
        $admin = User:: where('role', UserRole::ADMIN)->first();

        if (!$admin) {
            $this->command->error('❌ Admin user not found!  Run UserSeeder first.');
            return;
        }

        // Ensure storage directories exist
        Storage::disk('public')->makeDirectory('images/low_res');
        Storage::disk('public')->makeDirectory('images/high_res');

        // Create dummy image files
        $this->createDummyImage('images/low_res/dummy.jpg', 'LOW RES');
        $this->createDummyImage('images/high_res/dummy.jpg', 'HIGH RES');

        // Image data
        $images = [
            [
                'title' => 'Sunset Over Mountain Peak',
                'description' => 'A breathtaking view of the sun setting behind majestic mountain peaks, painting the sky in vibrant shades of orange and purple.',
            ],
            [
                'title' => 'Urban Street Photography',
                'description' => 'Capturing the essence of city life with this dynamic street scene featuring bustling crowds and architectural marvels.',
            ],
            [
                'title' => 'Wildlife in Natural Habitat',
                'description' => 'An intimate portrait of wildlife thriving in their natural environment, showcasing the raw beauty of nature.',
            ],
            [
                'title' => 'Architectural Marvel',
                'description' => 'Modern architecture meets artistic vision in this stunning capture of contemporary building design.',
            ],
            [
                'title' => 'Portrait in Golden Hour',
                'description' => 'The magical golden hour light creates a warm, ethereal atmosphere in this captivating portrait.',
            ],
            [
                'title' => 'Abstract Light Patterns',
                'description' => 'An exploration of light and shadow creating mesmerizing abstract patterns and compositions.',
            ],
            [
                'title' => 'Seascape at Dawn',
                'description' => 'The tranquil beauty of the ocean at dawn, with gentle waves and soft morning light.',
            ],
            [
                'title' => 'Macro Flower Details',
                'description' => 'An incredibly detailed macro shot revealing the intricate beauty of flower petals and textures.',
            ],
            [
                'title' => 'City Skyline at Night',
                'description' => 'The city comes alive at night with thousands of lights creating a stunning urban landscape.',
            ],
            [
                'title' => 'Forest Path in Autumn',
                'description' => 'A serene forest path covered in autumn leaves, inviting viewers into a peaceful woodland scene.',
            ],
            [
                'title' => 'Minimalist Composition',
                'description' => 'Less is more in this striking minimalist photograph that focuses on form, space, and simplicity.',
            ],
            [
                'title' => 'Action Sports Photography',
                'description' => 'Frozen in time - an adrenaline-pumping moment captured with perfect timing and technique.',
            ],
            [
                'title' => 'Food Styling Masterpiece',
                'description' => 'A beautifully styled culinary creation that is as visually appealing as it is appetizing.',
            ],
            [
                'title' => 'Vintage Car Collection',
                'description' => 'Classic automobiles showcasing the timeless elegance and craftsmanship of vintage car design.',
            ],
            [
                'title' => 'Landscape with Dramatic Clouds',
                'description' => 'Nature puts on a show with dramatic cloud formations over a sweeping landscape vista.',
            ],
        ];

        foreach ($images as $index => $imageData) {
            Image::create([
                'title' => $imageData['title'],
                'description' => $imageData['description'],
                'file_low_res' => 'images/low_res/dummy.jpg',
                'file_high_res' => 'images/high_res/dummy. jpg',
                'uploaded_by' => $admin->id,
                'created_at' => now()->subDays(rand(1, 180)),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ Created ' . count($images) . ' images');
    }

    /**
     * Create dummy image file
     */
    private function createDummyImage(string $path, string $label): void
    {
        $width = 1200;
        $height = 800;

        // Create image
        $image = imagecreatetruecolor($width, $height);

        // Random gradient background
        $color1 = imagecolorallocate($image, rand(100, 200), rand(100, 200), rand(150, 255));
        $color2 = imagecolorallocate($image, rand(150, 255), rand(100, 200), rand(100, 200));

        // Create gradient
        for ($i = 0; $i < $height; $i++) {
            $ratio = $i / $height;
            $r = (1 - $ratio) * (($color1 >> 16) & 0xFF) + $ratio * (($color2 >> 16) & 0xFF);
            $g = (1 - $ratio) * (($color1 >> 8) & 0xFF) + $ratio * (($color2 >> 8) & 0xFF);
            $b = (1 - $ratio) * ($color1 & 0xFF) + $ratio * ($color2 & 0xFF);
            $color = imagecolorallocate($image, $r, $g, $b);
            imageline($image, 0, $i, $width, $i, $color);
        }

        // Add text
        $textColor = imagecolorallocate($image, 255, 255, 255);
        $text1 = "Gallery Photo";
        $text2 = $label;

        imagestring($image, 5, ($width / 2) - 60, ($height / 2) - 20, $text1, $textColor);
        imagestring($image, 4, ($width / 2) - 40, ($height / 2) + 5, $text2, $textColor);

        // Save to storage
        $fullPath = storage_path('app/public/' . $path);
        imagejpeg($image, $fullPath, 90);
        imagedestroy($image);
    }
}
