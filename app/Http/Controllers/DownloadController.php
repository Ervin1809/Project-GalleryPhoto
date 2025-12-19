<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function download(Image $image)
    {
        $hasReviewed = $image->reviews()
            ->where('user_id', Auth::id())
            ->exists();

        if (!$hasReviewed && Auth::user()->role !== UserRole::ADMIN) {
            abort(403, 'Silakan beri review terlebih dahulu');
        }

        return response()->download(
            Storage::disk('private')->path($image->file_high_res)
        );
    }
}
