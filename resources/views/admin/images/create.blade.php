@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.images.index') }}"
           class="inline-flex items-center text-warm-500 hover:text-warm-700 transition-colors mb-4 group">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Gallery
        </a>
        <h1 class="text-3xl font-bold text-warm-700">Upload New Photo</h1>
        <p class="text-warm-500 mt-1">Add a new photo to your gallery collection</p>
    </div>

    {{-- Upload Form --}}
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-warm-100">
        <div class="p-8">
            <form action="{{ route('admin.images.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Title Field --}}
                <div>
                    <label for="title" class="block text-sm font-semibold text-warm-700 mb-2">
                        Photo Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="title"
                           id="title"
                           value="{{ old('title') }}"
                           required
                           placeholder="Enter a descriptive title..."
                           class="w-full px-4 py-3 rounded-xl border border-warm-200 focus:border-warm-500 focus:ring-2 focus:ring-warm-200 transition-all text-warm-700 placeholder:text-warm-300">
                    @error('title')
                        <p class="mt-2 text-sm text-red-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Description Field --}}
                <div>
                    <label for="description" class="block text-sm font-semibold text-warm-700 mb-2">
                        Description
                    </label>
                    <textarea name="description"
                              id="description"
                              rows="4"
                              placeholder="Tell the story behind this photo..."
                              class="w-full px-4 py-3 rounded-xl border border-warm-200 focus:border-warm-500 focus:ring-2 focus:ring-warm-200 transition-all text-warm-700 placeholder:text-warm-300 resize-none">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Low Res Image Upload --}}
                <div>
                    <label class="block text-sm font-semibold text-warm-700 mb-2">
                        Low Resolution Image <span class="text-red-500">*</span>
                    </label>
                    <p class="text-xs text-warm-400 mb-3">This will be shown as preview. Recommended: 800x600px</p>

                    <div class="relative">
                        <input type="file"
                               name="file_low_res"
                               id="file_low_res"
                               required
                               accept="image/*"
                               class="hidden"
                               onchange="previewImage(this, 'lowResPreview')">

                        <label for="file_low_res"
                               class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-warm-300 rounded-xl cursor-pointer bg-warm-50 hover:bg-warm-100 transition-colors group">

                            <div id="lowResPreview" class="hidden w-full h-full p-2">
                                <img src="" alt="Preview" class="w-full h-full object-contain rounded-lg">
                            </div>

                            <div id="lowResPlaceholder" class="flex flex-col items-center">
                                <div class="w-14 h-14 bg-warm-200 rounded-xl flex items-center justify-center mb-3 group-hover:bg-warm-300 transition-colors">
                                    <svg class="w-7 h-7 text-warm-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-warm-600">Click to upload low-res image</span>
                                <span class="text-xs text-warm-400 mt-1">PNG, JPG, WebP up to 5MB</span>
                            </div>
                        </label>
                    </div>

                    @error('file_low_res')
                        <p class="mt-2 text-sm text-red-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- High Res Image Upload --}}
                <div>
                    <label class="block text-sm font-semibold text-warm-700 mb-2">
                        High Resolution Image <span class="text-red-500">*</span>
                    </label>
                    <p class="text-xs text-warm-400 mb-3">Full quality image for unlocked users. Recommended: 3000x2000px or higher</p>

                    <div class="relative">
                        <input type="file"
                               name="file_high_res"
                               id="file_high_res"
                               required
                               accept="image/*"
                               class="hidden"
                               onchange="previewImage(this, 'highResPreview')">

                        <label for="file_high_res"
                               class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-sage-300 rounded-xl cursor-pointer bg-sage-50 hover:bg-sage-100 transition-colors group">

                            <div id="highResPreview" class="hidden w-full h-full p-2">
                                <img src="" alt="Preview" class="w-full h-full object-contain rounded-lg">
                            </div>

                            <div id="highResPlaceholder" class="flex flex-col items-center">
                                <div class="w-14 h-14 bg-sage-200 rounded-xl flex items-center justify-center mb-3 group-hover:bg-sage-300 transition-colors">
                                    <svg class="w-7 h-7 text-sage-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-sage-600">Click to upload high-res image</span>
                                <span class="text-xs text-sage-400 mt-1">PNG, JPG, WebP up to 20MB</span>
                            </div>
                        </label>
                    </div>

                    @error('file_high_res')
                        <p class="mt-2 text-sm text-red-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- Submit Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <button type="submit"
                            class="flex-1 bg-warm-500 text-white py-3.5 px-6 rounded-xl hover:bg-warm-600 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all font-semibold flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Upload Photo
                    </button>

                    <a href="{{ route('admin.images.index') }}"
                       class="flex-1 text-center py-3.5 px-6 rounded-xl border-2 border-warm-300 text-warm-600 hover:bg-warm-50 transition-all font-semibold">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Tips Card --}}
    <div class="mt-6 bg-gold-50 border border-gold-200 rounded-2xl p-6">
        <div class="flex items-start">
            <div class="w-10 h-10 bg-gold-300 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-warm-700" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-semibold text-warm-700">Pro Tips</h3>
                <ul class="mt-2 text-sm text-warm-600 space-y-1">
                    <li>• Use descriptive titles for better searchability</li>
                    <li>• Keep unlock codes simple but unique for each photo</li>
                    <li>• High-res images should be at least 3000px wide for best quality</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const placeholder = document.getElementById(previewId.replace('Preview', 'Placeholder'));

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.querySelector('img').src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function generateCode() {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let code = '';
    for (let i = 0; i < 8; i++) {
        code += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    document.getElementById('unlock_code').value = code;
}
</script>
@endsection
