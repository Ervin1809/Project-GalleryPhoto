<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'GalleryPhoto') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

    @include('components.navbar')

    <main class="max-w-7xl mx-auto px-4 py-6">
        @include('components.message')
        @yield('content')
    </main>

    @include('components.footer')

</body>
</html>
