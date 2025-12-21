@extends('layouts.admin')

@section('content')
{{-- Welcome Header --}}
<div class="mb-8">
    <h1 class="text-3xl font-bold text-warm-700">Welcome Back, {{ Auth::user()->name }}!</h1>
    <p class="text-warm-500 mt-1">Here's an overview of your gallery</p>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Total Photos --}}
    <div class="bg-white rounded-2xl shadow-lg border border-warm-100 p-6 hover:shadow-xl transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-warm-500">Total Photos</p>
                <p class="text-3xl font-bold text-warm-700 mt-1">{{ $totalImages ?? 0 }}</p>
            </div>
            <div class="w-14 h-14 bg-warm-100 rounded-xl flex items-center justify-center">
                <svg class="w-7 h-7 text-warm-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-sage-600 font-medium">View all</span>
            <svg class="w-4 h-4 ml-1 text-sage-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>
    </div>

    {{-- Total Users --}}
    <div class="bg-white rounded-2xl shadow-lg border border-warm-100 p-6 hover:shadow-xl transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-warm-500">Total Users</p>
                <p class="text-3xl font-bold text-warm-700 mt-1">{{ $totalUsers ?? 0 }}</p>
            </div>
            <div class="w-14 h-14 bg-sage-100 rounded-xl flex items-center justify-center">
                <svg class="w-7 h-7 text-sage-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-sage-600 font-medium">Registered members</span>
        </div>
    </div>

    {{-- Total Comments --}}
    <div class="bg-white rounded-2xl shadow-lg border border-warm-100 p-6 hover:shadow-xl transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-warm-500">Total Comments</p>
                <p class="text-3xl font-bold text-warm-700 mt-1">{{ $totalComments ?? 0 }}</p>
            </div>
            <div class="w-14 h-14 bg-gold-100 rounded-xl flex items-center justify-center">
                <svg class="w-7 h-7 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-gold-600 font-medium">User feedback</span>
        </div>
    </div>

    {{-- Unlocked Photos --}}
    <div class="bg-white rounded-2xl shadow-lg border border-warm-100 p-6 hover:shadow-xl transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-warm-500">Unlocked Photos</p>
                <p class="text-3xl font-bold text-warm-700 mt-1">{{ $unlockedPhotos ?? 0 }}</p>
            </div>
            <div class="w-14 h-14 bg-warm-100 rounded-xl flex items-center justify-center">
                <svg class="w-7 h-7 text-warm-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-warm-600 font-medium">High-res accessed</span>
        </div>
    </div>
</div>

{{-- Quick Actions --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <a href="{{ route('admin.images.create') }}"
       class="bg-gradient-to-br from-warm-500 to-warm-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all group">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-bold text-lg">Upload New Photo</h3>
                <p class="text-warm-100 text-sm mt-1">Add photos to your gallery</p>
            </div>
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:bg-white/30 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
        </div>
    </a>

    <a href="{{ route('admin.images.index') }}"
       class="bg-gradient-to-br from-sage-400 to-sage-500 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all group">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-bold text-lg">Manage Gallery</h3>
                <p class="text-sage-100 text-sm mt-1">Edit and organize photos</p>
            </div>
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:bg-white/30 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
        </div>
    </a>

    <a href="{{ route('dashboard') }}"
       class="bg-gradient-to-br from-gold-300 to-gold-400 rounded-2xl p-6 text-warm-700 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all group">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-bold text-lg">View Public Site</h3>
                <p class="text-warm-600 text-sm mt-1">See your gallery live</p>
            </div>
            <div class="w-12 h-12 bg-warm-700/20 rounded-xl flex items-center justify-center group-hover:bg-warm-700/30 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </div>
        </div>
    </a>
</div>

{{-- Recent Photos --}}
<div class="bg-white rounded-2xl shadow-lg border border-warm-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-warm-100 flex items-center justify-between">
        <h2 class="text-xl font-bold text-warm-700">Recent Photos</h2>
        <a href="{{ route('admin.images.index') }}" class="text-sm text-warm-500 hover:text-warm-700 font-medium transition-colors">
            View All →
        </a>
    </div>

    @if(isset($recentImages) && $recentImages->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 p-6">
            @foreach($recentImages as $image)
                <a href="{{ route('images.show', $image) }}" class="group">
                    <div class="aspect-square rounded-xl overflow-hidden shadow-md group-hover:shadow-lg transition-shadow">
                        <img src="{{ asset('storage/' . $image->file_low_res) }}"
                             alt="{{ $image->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <p class="text-sm font-medium text-warm-600 mt-2 truncate">{{ $image->title }}</p>
                    <p class="text-xs text-warm-400">{{ $image->created_at->diffForHumans() }}</p>
                </a>
            @endforeach
        </div>
    @else
        <div class="p-12 text-center">
            <div class="w-16 h-16 bg-warm-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-warm-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <h3 class="font-semibold text-warm-600 mb-2">No photos yet</h3>
            <p class="text-sm text-warm-400 mb-4">Start by uploading your first photo!</p>
            <a href="{{ route('admin.images.create') }}"
               class="inline-flex items-center bg-warm-500 text-white px-4 py-2 rounded-lg hover:bg-warm-600 transition-colors text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Upload Photo
            </a>
        </div>
    @endif
</div>
@endsection
