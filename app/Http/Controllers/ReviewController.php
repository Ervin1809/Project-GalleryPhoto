<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'image_id' => 'required|exists:images,id',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        // Cek apakah user adalah admin
        if (Auth::user()->role === 'admin') {
            return redirect()
                ->back()
                ->with('error', 'Admin cannot leave comments.');
        }

        // Cek apakah user sudah pernah review image ini
        $existingReview = Review::where('user_id', Auth::id())
            ->where('image_id', $request->image_id)
            ->first();

        if ($existingReview) {
            return redirect()
                ->back()
                ->with('error', 'You have already commented on this image.');
        }

        // Create review
        Review::create([
            'user_id' => Auth::id(),
            'image_id' => $request->image_id,
            'comment' => $request->comment,
        ]);

        return redirect()
            ->route('images.show', $request->image_id)
            ->with('success', 'Comment submitted!  HD version unlocked.  You can now download the high-resolution image.');
    }
}
