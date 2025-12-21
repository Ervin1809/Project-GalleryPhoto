@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-warm-50">
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-warm-700 via-warm-600 to-warm-500">
        {{-- Decorative Elements --}}
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 w-72 h-72 bg-gold-300/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-sage-400/20 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                    Welcome, {{ Auth::user()->name }}
                </h1>
                <p class="text-xl md:text-2xl text-warm-100 max-w-2xl mx-auto">
                    Explore our stunning photography collection
                </p>

                <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#gallery"
                       class="inline-flex items-center px-8 py-4 bg-white text-warm-700 rounded-xl font-semibold hover:bg-warm-50 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Browse Gallery
                    </a>
                </div>
            </div>
        </div>

        {{-- Wave Decoration --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#FAF7F5"/>
            </svg>
        </div>
    </section>

    {{-- Gallery Section --}}
    <section id="gallery" class="py-16 md:py-24 bg-warm-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-warm-700 mb-4">Photo Gallery</h2>
                <p class="text-lg text-warm-500 max-w-2xl mx-auto">
                    Discover beautiful moments captured through our lens
                </p>
            </div>

            @if(isset($images) && $images->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @foreach($images as $image)
                        <a href="{{ route('images.show', $image) }}"
                           class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                            <div class="aspect-[4/3] overflow-hidden">
                                <img src="{{ asset('storage/' . $image->file_low_res) }}"
                                     alt="{{ $image->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="p-5">
                                <h3 class="font-bold text-warm-700 text-lg mb-2 group-hover:text-warm-500 transition-colors">
                                    {{ $image->title }}
                                </h3>
                                @if($image->description)
                                    <p class="text-warm-400 text-sm line-clamp-2">
                                        {{ Str::limit($image->description, 100) }}
                                    </p>
                                @endif
                                <div class="mt-4 flex items-center justify-between text-sm">
                                    <span class="text-warm-400">{{ $image->created_at->format('M d, Y') }}</span>
                                    <div class="flex items-center text-sage-600">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $image->reviews->count() }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($images->hasPages())
                    <div class="mt-12">
                        {{ $images->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-warm-100 rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-warm-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-warm-600 mb-3">No Photos Yet</h3>
                    <p class="text-warm-400 text-lg">Check back soon for new additions!</p>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
