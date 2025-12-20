<! DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app. name', 'GalleryPhoto') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md">
        {{-- Logo/Header --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="text-3xl font-bold text-indigo-600">
                📸 GalleryPhoto
            </a>
            <p class="text-gray-600 mt-2">Welcome to our photo gallery</p>
        </div>

        {{-- Card --}}
        <div class="bg-white shadow-lg rounded-lg p-8">
            {{ $slot }}
        </div>

        {{-- Back to Home --}}
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-indigo-600">
                ← Back to Gallery
            </a>
        </div>
    </div>

</body>
</html>
