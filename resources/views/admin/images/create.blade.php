@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-2">Upload New Photo</h1>
    <p class="text-gray-600 mb-6">Add a new photo to your gallery</p>

    {{-- Error Alert (Jika ada error umum) --}}
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <h3 class="font-semibold text-red-800 mb-1">Upload Failed</h3>
                    <p class="text-red-700 text-sm">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div class="flex-1">
                    <h3 class="font-semibold text-red-800 mb-2">Please fix the following errors:</h3>
                    <ul class="list-disc list-inside space-y-1 text-red-700 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- Upload Requirements Info --}}
    <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
        <div class="flex items-start">
            <svg class="w-6 h-6 text-blue-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <div>
                <h3 class="font-semibold text-blue-800 mb-2">Upload Requirements: </h3>
                <ul class="text-blue-700 text-sm space-y-1">
                    <li>✅ Supported formats: JPEG, PNG, JPG, WebP, GIF</li>
                    <li>✅ Low resolution max size: 5MB</li>
                    <li>✅ High resolution max size: 10MB</li>
                    <li>✅ Both images are required</li>
                </ul>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.images.store') }}"
          method="POST"
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
                   class="w-full border @error('title') border-red-500 @else border-gray-300 @enderror rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                   placeholder="Enter photo title..."
                   required>
            @error('title')
                <p class="text-red-500 text-sm mt-1 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Low Resolution Image --}}
        <div>
            <label for="file_low_res" class="block text-sm font-medium text-gray-700 mb-2">
                Low Resolution / Watermark <span class="text-red-500">*</span>
            </label>
            <input type="file"
                   id="file_low_res"
                   name="file_low_res"
                   accept="image/jpeg,image/png,image/jpg,image/webp,image/gif"
                   class="w-full border @error('file_low_res') border-red-500 @else border-gray-300 @enderror rounded-lg px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100"
                   onchange="previewImage(this, 'preview_low_res')"
                   required>
            <p class="text-xs text-gray-500 mt-1">
                📸 JPEG, PNG, JPG, WebP, GIF | Max 5MB
            </p>
            @error('file_low_res')
                <p class="text-red-500 text-sm mt-1 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
            <div id="preview_low_res" class="mt-3 hidden">
                <img src="" alt="Preview" class="max-w-xs rounded-lg shadow border-2 border-orange-200">
            </div>
        </div>

        {{-- High Resolution Image --}}
        <div>
            <label for="file_high_res" class="block text-sm font-medium text-gray-700 mb-2">
                High Resolution <span class="text-red-500">*</span>
            </label>
            <input type="file"
                   id="file_high_res"
                   name="file_high_res"
                   accept="image/jpeg,image/png,image/jpg,image/webp,image/gif"
                   class="w-full border @error('file_high_res') border-red-500 @else border-gray-300 @enderror rounded-lg px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                   onchange="previewImage(this, 'preview_high_res')"
                   required>
            <p class="text-xs text-gray-500 mt-1">
                🖼️ JPEG, PNG, JPG, WebP, GIF | Max 10MB
            </p>
            @error('file_high_res')
                <p class="text-red-500 text-sm mt-1 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
            <div id="preview_high_res" class="mt-3 hidden">
                <img src="" alt="Preview" class="max-w-xs rounded-lg shadow border-2 border-green-200">
            </div>
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                Photo Description <span class="text-red-500">*</span>
            </label>
            <input type="text"
                   id="description"
                   name="description"
                   value="{{ old('description') }}"
                   class="w-full border @error('description') border-red-500 @else border-gray-300 @enderror rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                   placeholder="Enter photo description..."
                   required>
            @error('description')
                <p class="text-red-500 text-sm mt-1 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Buttons --}}
        <div class="flex items-center justify-between pt-4 border-t">
            <a href="{{ route('admin.images.index') }}"
               class="text-gray-600 hover:text-gray-800 hover:underline flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Cancel
            </a>
            <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 shadow flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                Upload Photo
            </button>
        </div>
    </form>
</div>

<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const previewImg = preview.querySelector('img');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        };

        reader.readAsDataURL(input. files[0]);
    } else {
        preview.classList.add('hidden');
    }
}
</script>
@endsection
