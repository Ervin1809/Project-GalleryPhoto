<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::latest()->get();
        return view('dashboard.main', compact('images'));
    }

    public function show(Image $image)
    {
        $hasReviewed = false;

        if (Auth::check()) {
            $hasReviewed = $image->reviews()
                ->where('user_id', Auth::id())
                ->exists();
        }

        return view('images.show', compact('image', 'hasReviewed'));
    }
}
