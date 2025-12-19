<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image_id' => 'required|exists:images,id',
            'comment' => 'required|string|max:1000',
        ]);

        Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'image_id' => $request->image_id,
            ],
            [
                'comment' => $request->comment,
            ]
        );

        return redirect()->back()->with('success', 'Komentar berhasil dikirim');
    }
}
