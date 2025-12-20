@extends('layouts.admin')  {{-- Ganti dari layouts. app --}}

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-2">Upload New Photo</h1>
    <p class="text-gray-600 mb-6">Add a new photo to your gallery</p>

    <form method="POST"
          action="{{ route('admin. images.store') }}"
          enctype="multipart/form-data"
          class="bg-white shadow-md rounded-lg p-6 space-y-6">
        @csrf

        {{-- Title --}}
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                Photo Title <span class="text-red-500">*</span>
            </label>
            <input type="text"
                   id="title"
                   name="title"
                   value="{{ old('title') }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                   placeholder="Enter photo title..."
                   required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Low Resolution --}}
        <div>
            <label for="file_low_res" class="block text-sm font-medium text-gray-700 mb-2">
                Low Resolution / Watermark <span class="text-red-500">*</span>
            </label>
            <input type="file"
                   id="file_low_res"
                   name="file_low_res"
                   accept="image/*"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                   required>
            <p class="text-xs text-gray-500 mt-1">
                This version will be shown as preview (with watermark or lower quality)
            </p>
            @error('file_low_res')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- High Resolution --}}
        <div>
            <label for="file_high_res" class="block text-sm font-medium text-gray-700 mb-2">
                High Resolution <span class="text-red-500">*</span>
            </label>
            <input type="file"
                   id="file_high_res"
                   name="file_high_res"
                   accept="image/*"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-indigo-50 file:text-indigo-700 hover: file:bg-indigo-100"
                   required>
            <p class="text-xs text-gray-500 mt-1">
                Original high-quality version (unlocked after user comments)
            </p>
            @error('file_high_res')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Buttons --}}
        <div class="flex items-center justify-between pt-4 border-t">
            <a href="{{ route('admin.images.index') }}"
               class="text-gray-600 hover:text-gray-800 hover:underline">
                ← Back to Images
            </a>
            <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 shadow">
                📤 Upload Photo
            </button>
        </div>
    </form>
</div>
@endsection
