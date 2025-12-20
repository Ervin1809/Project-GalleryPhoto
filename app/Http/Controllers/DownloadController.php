<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DownloadController extends Controller
{
    public function download(Image $image)
    {
        // Cek user sudah login
        if (!Auth:: check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Please login to download images.');
        }

        // Cek apakah user sudah review image ini
        $hasReviewed = $image->reviews()
            ->where('user_id', Auth::id())
            ->exists();

        if (!$hasReviewed) {
            return redirect()
                ->route('images.show', $image)
                ->with('error', 'Please leave a comment first to unlock HD version.');
        }

        // Path file (dari disk public)
        $filePath = $image->file_high_res;

        // Cek apakah file ada
        if (!Storage::disk('public')->exists($filePath)) {
            return redirect()
                ->back()
                ->with('error', 'File not found.');
        }

        // Get full path
        $fullPath = Storage::disk('public')->path($filePath);

        // Get original filename
        $filename = $image->title . '_HD.' . pathinfo($filePath, PATHINFO_EXTENSION);

        // Download file
        return response()->download($fullPath, $filename);
    }
}
