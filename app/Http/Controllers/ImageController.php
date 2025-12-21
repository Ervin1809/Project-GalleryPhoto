<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\UserRole;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::with('reviews.user')
            ->latest()
            ->paginate(25);
        if (!Auth::check()){
            return view('dashboard.main', compact('images'));
        }

        if (Auth::user()->role == UserRole::ADMIN) {
            return view('dashboard.admin', compact('images'));
        }
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
