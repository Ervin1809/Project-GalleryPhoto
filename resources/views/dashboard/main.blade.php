@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-2">
        Photo Gallery
    </h1>
    <p class="text-gray-600">
        Explore our collection of stunning photography.  Leave a comment to unlock HD downloads!
    </p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($images as $image)
        @php
            $hasReviewed = auth()->check() &&
                           auth()->user()->role !== 'admin' &&
                           $image->reviews()->where('user_id', auth()->id())->exists();
            $commentCount = $image->reviews->count();
        @endphp

        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 group">
            {{-- Image Container --}}
            <div class="relative overflow-hidden">
                <a href="{{ route('images.show', $image) }}">
                    <img src="{{ asset('storage/' . $image->file_low_res) }}"
                         alt="{{ $image->title }}"
                         class="w-full h-56 object-cover group-hover: scale-110 transition-transform duration-300">
                </a>

                {{-- Status Badge (Pojok Kiri Atas) --}}
                @auth
                    @if(auth()->user()->role !== 'admin')
                        <div class="absolute top-3 left-3">
                            @if($hasReviewed)
                                <span class="bg-green-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg flex items-center backdrop-blur-sm">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Unlocked
                                </span>
                            @else
                                <span class="bg-orange-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg flex items-center backdrop-blur-sm">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Locked
                                </span>
                            @endif
                        </div>
                    @endif
                @endauth

                {{-- Hover Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="absolute bottom-4 left-4 right-4">
                        <a href="{{ route('images.show', $image) }}"
                           class="inline-flex items-center text-white font-semibold">
                            View Details
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Card Content --}}
            <div class="p-5">
                {{-- Title --}}
                <a href="{{ route('images.show', $image) }}">
                    <h2 class="font-bold text-lg text-gray-800 mb-3 hover:text-indigo-600 transition line-clamp-2">
                        {{ $image->title }}
                    </h2>
                </a>

                {{-- Stats Row --}}
                <div class="flex items-center justify-between text-sm">
                    {{-- Comment Count --}}
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-1. 5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold">
                            {{ $commentCount }}
                        </span>
                        <span class="ml-1 text-gray-500">
                            {{ Str::plural('comment', $commentCount) }}
                        </span>
                    </div>

                    {{-- Action Button --}}
                    @auth
                        @if(auth()->user()->role !== 'admin')
                            @if($hasReviewed)
                                <a href="{{ route('images.show', $image) }}"
                                   class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold transition">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    Download
                                </a>
                            @else
                                <a href="{{ route('images.show', $image) }}"
                                   class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-semibold transition">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                    </svg>
                                    Unlock
                                </a>
                            @endif
                        @else
                            <a href="{{ route('images.show', $image) }}"
                               class="inline-flex items-center text-gray-600 hover:text-gray-700 font-semibold transition">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                View
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-semibold transition">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Login
                        </a>
                    @endauth
                </div>

                {{-- Additional Info (Upload Date) --}}
                <div class="mt-3 pt-3 border-t border-gray-100 flex items-center text-xs text-gray-500">
                    <svg class="w-4 h-4 mr-1. 5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Uploaded {{ $image->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
    @empty
        {{-- Empty State --}}
        <div class="col-span-full flex flex-col items-center justify-center py-20 text-gray-400">
            <svg class="w-24 h-24 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-xl font-semibold mb-2">No photos yet</p>
            <p class="text-sm">Check back later for amazing photography!</p>
        </div>
    @endforelse
</div>

{{-- Pagination (jika ada) --}}
@if(method_exists($images, 'hasPages') && $images->hasPages())
    <div class="mt-10">
        {{ $images->links() }}
    </div>
@endif
@endsection
