@extends('layouts.app')

@section('content')
{{-- Hero Section --}}
<section class="relative overflow-hidden">
    <div class="gradient-hero py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-warm-700 mb-6 leading-tight">
                    Capture the <span class="text-warm-500">Moment</span>
                </h1>
                <p class="text-lg md:text-xl text-warm-600 mb-8 leading-relaxed">
                    Explore our curated collection of stunning photography. 
                    Leave a comment to unlock high-resolution downloads.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @guest
                        <a href="{{ route('register') }}" 
                           class="bg-warm-500 text-white px-8 py-3.5 rounded-xl font-semibold hover:bg-warm-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Get Started Free
                        </a>
                        <a href="#gallery" 
                           class="bg-white text-warm-700 border-2 border-warm-300 px-8 py-3.5 rounded-xl font-semibold hover:bg-warm-50 transition-all">
                            Browse Gallery
                        </a>
                    @else
                        <a href="#gallery" 
                           class="bg-warm-500 text-white px-8 py-3.5 rounded-xl font-semibold hover:bg-warm-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Explore Gallery
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
    
    {{-- Decorative Elements --}}
    <div class="absolute top-0 left-0 w-72 h-72 bg-warm-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-72 h-72 bg-sage-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 translate-x-1/2 translate-y-1/2"></div>
</section>

{{-- Gallery Section --}}
<section id="gallery" class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-10">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-warm-700 mb-2">
                    Photo Gallery
                </h2>
                <p class="text-warm-500">
                    Explore our collection of stunning photography
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="text-sm text-warm-400">{{ $images->count() }} photos available</span>
            </div>
        </div>

        {{-- Gallery Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @forelse ($images as $image)
                @php
                    $hasReviewed = auth()->check() &&
                                   auth()->user()->role !== 'admin' &&
                                   $image->reviews()->where('user_id', auth()->id())->exists();
                    $commentCount = $image->reviews->count();
                @endphp

                <article class="gallery-card group">
                    {{-- Image Container --}}
                    <div class="relative overflow-hidden aspect-[4/3]">
                        <a href="{{ route('images.show', $image) }}">
                            <img src="{{ asset('storage/' . $image->file_low_res) }}"
                                 alt="{{ $image->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                        </a>

                        {{-- Status Badge --}}
                        @auth
                            @if(auth()->user()->role !== 'admin')
                                <div class="absolute top-4 left-4">
                                    @if($hasReviewed)
                                        <span class="bg-sage-400 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg flex items-center">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Unlocked
                                        </span>
                                    @else
                                        <span class="bg-warm-300 text-warm-800 text-xs font-bold px-3 py-1.5 rounded-full shadow-lg flex items-center">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                            </svg>
                                            Preview
                                        </span>
                                    @endif
                                </div>
                            @endif
                        @endauth

                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4">
                                <a href="{{ route('images.show', $image) }}"
                                   class="inline-flex items-center text-white font-medium text-sm">
                                    View Details
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <h3 class="font-semibold text-lg text-warm-700 mb-3 hover:text-warm-500 transition-colors line-clamp-2">
                                {{ $image->title }}
                            </h3>
                        </a>

                        {{-- Stats Row --}}
                        <div class="flex items-center justify-between text-sm">
                            {{-- Comment Count --}}
                            <div class="flex items-center text-warm-500">
                                <svg class="w-4 h-4 mr-1.5 text-sage-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-medium text-warm-600">{{ $commentCount }}</span>
                                <span class="ml-1 text-warm-400">{{ Str::plural('comment', $commentCount) }}</span>
                            </div>

                            {{-- Action Button --}}
                            @auth
                                @if(auth()->user()->role !== 'admin')
                                    @if($hasReviewed)
                                        <a href="{{ route('images.show', $image) }}"
                                           class="inline-flex items-center text-sage-500 hover:text-sage-600 font-medium transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                            </svg>
                                            Download
                                        </a>
                                    @else
                                        <a href="{{ route('images.show', $image) }}"
                                           class="inline-flex items-center text-warm-500 hover:text-warm-600 font-medium transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                            </svg>
                                            Unlock
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('images.show', $image) }}"
                                       class="inline-flex items-center text-warm-500 hover:text-warm-600 font-medium transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        View
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                   class="inline-flex items-center text-warm-500 hover:text-warm-600 font-medium transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                    </svg>
                                    Login
                                </a>
                            @endauth
                        </div>

                        {{-- Upload Date --}}
                        <div class="mt-4 pt-4 border-t border-warm-100 flex items-center text-xs text-warm-400">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Uploaded {{ $image->created_at->diffForHumans() }}
                        </div>
                    </div>
                </article>
            @empty
                {{-- Empty State --}}
                <div class="col-span-full flex flex-col items-center justify-center py-20">
                    <div class="w-24 h-24 bg-warm-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-warm-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-warm-600 mb-2">No photos yet</h3>
                    <p class="text-warm-400 text-center max-w-md">Check back later for amazing photography!</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($images->hasPages())
            <div class="mt-12">
                {{ $images->links() }}
            </div>
        @endif
    </div>
</section>

{{-- CTA Section (for guests) --}}
@guest
<section class="py-16 bg-warm-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-warm-700 mb-4">
            Ready to unlock HD downloads?
        </h2>
        <p class="text-lg text-warm-500 mb-8 max-w-2xl mx-auto">
            Create a free account and leave a comment on any photo to unlock the high-resolution version.
        </p>
        <a href="{{ route('register') }}" 
           class="inline-flex items-center bg-warm-500 text-white px-8 py-4 rounded-xl font-semibold hover:bg-warm-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Create Free Account
        </a>
    </div>
</section>
@endguest
@endsection
