<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - GalleryPhoto</title>
    
    {{-- Google Fonts - Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-warm-50 min-h-screen flex items-center justify-center p-4 font-sans">

    <div class="w-full max-w-md">
        {{-- Logo Section --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex flex-col items-center group">
                <div class="w-16 h-16 bg-gradient-to-br from-warm-300 to-warm-500 rounded-2xl flex items-center justify-center shadow-xl group-hover:shadow-2xl transition-all mb-4">
                    <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-warm-700">
                    Gallery<span class="text-warm-500">Photo</span>
                </h1>
                <p class="text-warm-500 mt-2 text-sm">Join our photography community</p>
            </a>
        </div>

        {{-- Register Card --}}
        <div class="bg-white rounded-2xl p-8 shadow-xl border border-warm-100">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-warm-700 mb-1">Create Account</h2>
                <p class="text-warm-500 text-sm">Sign up to get started</p>
            </div>

            {{-- Errors --}}
            @if($errors->any())
                <div class="mb-6 p-4 bg-warm-50 border border-warm-200 text-warm-700 rounded-xl text-sm">
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="flex items-start">
                                <span class="mr-2">•</span>
                                <span>{{ $error }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-warm-700 mb-2">
                        Full Name
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-warm-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input id="name"
                               type="text"
                               name="name"
                               value="{{ old('name') }}"
                               class="w-full border border-warm-200 rounded-xl pl-12 pr-4 py-3 focus:ring-2 focus:ring-warm-300 focus:border-warm-400 transition bg-white text-warm-700 placeholder-warm-400"
                               placeholder="John Doe"
                               required
                               autofocus>
                    </div>
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-warm-700 mb-2">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-warm-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="w-full border border-warm-200 rounded-xl pl-12 pr-4 py-3 focus:ring-2 focus:ring-warm-300 focus:border-warm-400 transition bg-white text-warm-700 placeholder-warm-400"
                               placeholder="your@email.com"
                               required>
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-warm-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-warm-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input id="password"
                               type="password"
                               name="password"
                               class="w-full border border-warm-200 rounded-xl pl-12 pr-4 py-3 focus:ring-2 focus:ring-warm-300 focus:border-warm-400 transition bg-white text-warm-700 placeholder-warm-400"
                               placeholder="••••••••"
                               required>
                    </div>
                    <p class="text-xs text-warm-400 mt-1.5">At least 8 characters</p>
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-warm-700 mb-2">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-warm-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <input id="password_confirmation"
                               type="password"
                               name="password_confirmation"
                               class="w-full border border-warm-200 rounded-xl pl-12 pr-4 py-3 focus:ring-2 focus:ring-warm-300 focus:border-warm-400 transition bg-white text-warm-700 placeholder-warm-400"
                               placeholder="••••••••"
                               required>
                    </div>
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                        class="w-full bg-warm-500 text-white font-semibold py-3.5 rounded-xl hover:bg-warm-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 mt-2">
                    Create Account
                </button>
            </form>

            {{-- Login Link --}}
            <div class="mt-6 pt-6 border-t border-warm-100 text-center">
                <p class="text-warm-500 text-sm">
                    Already have an account?
                    <a href="{{ route('login') }}"
                       class="text-warm-600 hover:text-warm-700 font-semibold hover:underline ml-1">
                        Sign in
                    </a>
                </p>
            </div>
        </div>

        {{-- Back to Home --}}
        <div class="text-center mt-6">
            <a href="{{ route('home') }}"
               class="inline-flex items-center text-sm text-warm-500 hover:text-warm-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Gallery
            </a>
        </div>
    </div>

</body>
</html>
