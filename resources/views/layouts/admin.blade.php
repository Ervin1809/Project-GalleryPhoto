{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - {{ config('app.name', 'GalleryPhoto') }}</title>

    {{-- Google Fonts - Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-warm-50 text-warm-700 min-h-screen flex flex-col font-sans">

    {{-- Admin Navbar --}}
    <nav class="bg-warm-700 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Logo & Nav Links --}}
                <div class="flex items-center gap-8">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-bold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Admin Panel</span>
                    </a>

                    {{-- Desktop Nav Links --}}
                    <div class="hidden md:flex items-center gap-6">
                        <a href="{{ route('admin.images.index') }}"
                           class="text-sm font-medium {{ request()->routeIs('admin.images.index') ? 'text-gold-300' : 'text-warm-200 hover:text-white' }} transition-colors">
                            Manage Images
                        </a>
                        <a href="{{ route('home') }}"
                           class="text-sm font-medium text-warm-200 hover:text-white transition-colors">
                            View Gallery
                        </a>
                    </div>
                </div>

                {{-- User Info & Logout --}}
                <div class="flex items-center gap-4">
                    <span class="hidden sm:block text-sm text-warm-200">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="bg-warm-600 hover:bg-warm-800 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Mobile Nav Links --}}
        <div class="md:hidden border-t border-warm-600 px-4 py-3">
            <div class="flex gap-4">
                <a href="{{ route('admin.images.index') }}"
                   class="text-sm {{ request()->routeIs('admin.images.index') ? 'text-gold-300 font-semibold' : 'text-warm-200' }}">
                    Manage Images
                </a>
                <a href="{{ route('home') }}" class="text-sm text-warm-200">
                    View Gallery
                </a>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        @include('components.message')
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-warm-700 text-warm-200 py-4 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm">
            © {{ date('Y') }} GalleryPhoto Admin. All rights reserved.
        </div>
    </footer>

</body>
</html>
