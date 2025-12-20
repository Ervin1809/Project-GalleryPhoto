{{-- resources/views/layouts/admin. blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - {{ config('app.name', 'GalleryPhoto') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app. js'])
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    {{-- Admin Navbar --}}
    <nav class="bg-gray-800 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-xl font-bold">
                        📸 Admin Panel
                    </a>
                    <a href="{{ route('admin.images.index') }}"
                       class="text-sm {{ request()->routeIs('admin.images.index') ? 'font-semibold' : 'hover:text-gray-300' }}">
                        Manage Images
                    </a>
                    <a href="{{ route('home') }}"
                       class="text-sm hover:text-gray-300">
                        View Gallery
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="bg-red-500 px-4 py-2 rounded text-sm hover:bg-red-600">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main class="flex-grow max-w-7xl mx-auto px-4 py-8 w-full">
        @include('components.message')
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-800 text-white py-4 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm">
            © {{ date('Y') }} GalleryPhoto Admin. All rights reserved.
        </div>
    </footer>

</body>
</html>
