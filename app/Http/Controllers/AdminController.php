<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $images = Image::latest()->get();
        return view('admin.images.index', compact('images'));
    }

    public function create()
    {
        return view('admin.images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file_low_res' => 'required|image',
            'file_high_res' => 'required|image',
        ]);

        $lowResPath = $request->file('file_low_res')
            ->store('images/low', 'public');

        $highResPath = $request->file('file_high_res')
            ->store('images/high', 'private');

        Image::create([
            'title' => $request->title,
            'file_low_res' => $lowResPath,
            'file_high_res' => $highResPath,
        ]);

        return redirect()->back()->with('success', 'Foto berhasil diupload');
    }
}
