<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app. name', 'GalleryPhoto') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    @include('components.navbar')

    <main class="flex-grow max-w-7xl mx-auto px-4 py-6 w-full">
        @include('components.message')
        @yield('content')
    </main>

    @include('components.footer')

</body>
</html>
