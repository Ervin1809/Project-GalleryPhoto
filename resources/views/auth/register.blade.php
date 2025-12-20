<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - GalleryPhoto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        {{-- Logo Section --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block group">
                <div class="text-6xl mb-3 transform group-hover:scale-110 transition duration-300">📸</div>
                <h1 class="text-4xl font-black text-white tracking-tight">
                    Gallery<span class="text-indigo-400">Photo</span>
                </h1>
                <p class="text-gray-400 mt-2 text-sm">Join our photography community</p>
            </a>
        </div>

        {{-- Register Card --}}
        <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 shadow-2xl border border-white/20">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-white mb-2">Create Account</h2>
                <p class="text-gray-300 text-sm">Sign up to get started</p>
            </div>

            {{-- Errors --}}
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-500/20 border border-red-500/50 text-red-200 rounded-xl text-sm backdrop-blur">
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

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-200 mb-2">
                        Full Name
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input id="name"
                               type="text"
                               name="name"
                               value="{{ old('name') }}"
                               class="w-full bg-white/10 border border-white/20 text-white rounded-xl pl-12 pr-4 py-3.5 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition placeholder-gray-400 backdrop-blur"
                               placeholder="John Doe"
                               required
                               autofocus>
                    </div>
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-200 mb-2">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="w-full bg-white/10 border border-white/20 text-white rounded-xl pl-12 pr-4 py-3.5 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition placeholder-gray-400 backdrop-blur"
                               placeholder="your@email.com"
                               required>
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-200 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input id="password"
                               type="password"
                               name="password"
                               class="w-full bg-white/10 border border-white/20 text-white rounded-xl pl-12 pr-4 py-3.5 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition placeholder-gray-400 backdrop-blur"
                               placeholder="••••••••"
                               required>
                    </div>
                    <p class="text-xs text-gray-400 mt-1. 5">At least 8 characters</p>
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-200 mb-2">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <input id="password_confirmation"
                               type="password"
                               name="password_confirmation"
                               class="w-full bg-white/10 border border-white/20 text-white rounded-xl pl-12 pr-4 py-3.5 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition placeholder-gray-400 backdrop-blur"
                               placeholder="••••••••"
                               required>
                    </div>
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold py-4 rounded-xl hover:from-indigo-700 hover: to-purple-700 transition transform hover:scale-[1.02] active:scale-[0.98] shadow-lg shadow-indigo-500/50 mt-6">
                    Create Account
                </button>
            </form>

            {{-- Login Link --}}
            <div class="mt-8 pt-6 border-t border-white/10 text-center">
                <p class="text-gray-300 text-sm">
                    Already have an account?
                    <a href="{{ route('login') }}"
                       class="text-indigo-400 hover:text-indigo-300 font-semibold hover: underline ml-1">
                        Sign in
                    </a>
                </p>
            </div>
        </div>

        {{-- Back to Home --}}
        <div class="text-center mt-6">
            <a href="{{ route('home') }}"
               class="inline-flex items-center text-sm text-gray-400 hover: text-white transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Gallery
            </a>
        </div>
    </div>

    <style>
        @keyframes blob {
            0%, 100% { transform:  translate(0, 0) scale(1); }
            25% { transform: translate(20px, -50px) scale(1.1); }
            50% { transform: translate(-20px, 20px) scale(0.9); }
            75% { transform: translate(50px, 50px) scale(1.05); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>

</body>
</html>
