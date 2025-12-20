@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- Back Button --}}
    <a href="{{ route('home') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-6 transition group">
        <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Back to Gallery
    </a>

    <div class="grid grid-cols-1 lg: grid-cols-5 gap-8">
        {{-- Left Column:  Image (Sticky) --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden lg:sticky lg:top-8">
                @php
                    $hasReviewed = auth()->check() &&
                                   auth()->user()->role !== 'admin' &&
                                   $image->reviews()->where('user_id', auth()->id())->exists();
                    $imagePath = $hasReviewed ? $image->file_high_res :  $image->file_low_res;
                @endphp

                {{-- Image Display --}}
                <div class="relative group">
                    <img src="{{ asset('storage/' . $imagePath) }}"
                         alt="{{ $image->title }}"
                         class="w-full">

                    {{-- Badge Indicator --}}
                    <div class="absolute top-4 right-4">
                        @if($hasReviewed)
                            <span class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg font-semibold flex items-center backdrop-blur-sm">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                HD Unlocked
                            </span>
                        @elseif(auth()->check() && auth()->user()->role !== 'admin')
                            <span class="bg-orange-500 text-white px-4 py-2 rounded-lg shadow-lg font-semibold flex items-center backdrop-blur-sm">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M. 458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                Preview Version
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Image Info --}}
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-3">{{ $image->title }}</h1>

                    {{-- Description --}}
                    @if($image->description)
                        <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <h3 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Description
                            </h3>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $image->description }}</p>
                        </div>
                    @endif

                    {{-- Stats --}}
                    <div class="flex items-center justify-between mb-4 pb-4 border-b">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-5 h-5 mr-2 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-semibold">{{ $image->reviews->count() }}</span>
                            <span class="ml-1">{{ Str::plural('comment', $image->reviews->count()) }}</span>
                        </div>

                        @if($image->created_at)
                            <div class="flex items-center text-xs text-gray-400">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $image->created_at->format('M d, Y') }}
                            </div>
                        @endif
                    </div>

                    {{-- Download Button (Jika sudah review) --}}
                    @if($hasReviewed)
                        <a href="{{ route('images.download', $image) }}"
                           class="w-full inline-flex items-center justify-center bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-3 rounded-lg hover:from-green-700 hover:to-green-800 shadow-lg transform hover:scale-105 transition font-semibold">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Download HD Version
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Right Column: Comments (Scrollable) --}}
        <div class="lg:col-span-3">
            <div class="space-y-6">
                @auth
                    @if(auth()->user()->role === 'admin')
                        {{-- Admin View - Tidak bisa komen --}}
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 border border-indigo-200 rounded-xl p-6">
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0 mr-3">
                                    <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-indigo-900 mb-1">Admin View</h3>
                                    <p class="text-sm text-indigo-700">You're viewing this as an administrator.  Admin accounts cannot leave comments.</p>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- User Comment Form --}}
                        @if(! $hasReviewed)
                            <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-indigo-100 sticky top-8 z-10">
                                <div class="flex items-start mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0 mr-4">
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-bold text-gray-800 mb-1">
                                            Unlock HD Version
                                        </h2>
                                        <p class="text-gray-600 text-sm">Leave a comment to access the high-resolution download. </p>
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('reviews.store') }}" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="image_id" value="{{ $image->id }}">

                                    <div>
                                        <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
                                            Your Comment
                                        </label>
                                        <textarea
                                            id="comment"
                                            name="comment"
                                            rows="3"
                                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none"
                                            placeholder="Share your thoughts about this photo..."
                                            required
                                        ></textarea>
                                        <p class="text-xs text-gray-500 mt-1">Minimum 10 characters</p>
                                    </div>

                                    <button type="submit"
                                            class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold py-3 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition shadow-lg hover:shadow-xl transform hover:scale-[1.02] flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h. 01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-4l-5 5v-5z"/>
                                        </svg>
                                        Submit Comment & Unlock
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 rounded-xl p-6 sticky top-8 z-10">
                                <div class="flex items-start">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mr-4">
                                        <svg class="w-7 h-7 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-green-900 mb-1">HD Version Unlocked!  🎉</h3>
                                        <p class="text-sm text-green-700">You can now view and download the high-resolution version of this photo.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @else
                    {{-- Guest View - Must Login --}}
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl shadow-lg p-8 text-center border-2 border-gray-200 sticky top-8 z-10">
                        <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Want the HD version? </h3>
                        <p class="text-gray-600 mb-6">Login to leave a comment and unlock the high-resolution download.</p>
                        <div class="flex gap-3 justify-center">
                            <a href="{{ route('login') }}"
                               class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold shadow">
                                Login
                            </a>
                            <a href="{{ route('register') }}"
                               class="bg-white text-indigo-600 border-2 border-indigo-600 px-6 py-3 rounded-lg hover:bg-indigo-50 transition font-semibold">
                                Register
                            </a>
                        </div>
                    </div>
                @endauth

                {{-- Comments List (With Scroll) --}}
                @if($image->reviews->count() > 0)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="p-6 border-b bg-gray-50">
                            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-. 98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                                </svg>
                                Comments ({{ $image->reviews->count() }})
                            </h2>
                        </div>

                        {{-- Scrollable Comment Container --}}
                        <div class="overflow-y-auto max-h-[600px] custom-scrollbar">
                            <div class="p-6 space-y-4">
                                @foreach($image->reviews as $review)
                                    <div class="border-b border-gray-100 pb-4 last:border-b-0 last:pb-0 hover:bg-gray-50 p-3 rounded-lg transition">
                                        <div class="flex items-start">
                                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold mr-3 flex-shrink-0">
                                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between mb-1">
                                                    <h4 class="font-semibold text-gray-800 truncate">{{ $review->user->name }}</h4>
                                                    <span class="text-xs text-gray-500 flex-shrink-0 ml-2">{{ $review->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="text-gray-700 leading-relaxed text-sm">{{ $review->comment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Custom Scrollbar Styling --}}
<style>
. custom-scrollbar::-webkit-scrollbar {
    width: 8px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background:  #f1f1f1;
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #6366f1, #8b5cf6);
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background:  linear-gradient(180deg, #4f46e5, #7c3aed);
}

/* Firefox */
.custom-scrollbar {
    scrollbar-width: thin;
    scrollbar-color:  #6366f1 #f1f1f1;
}
</style>
@endsection
