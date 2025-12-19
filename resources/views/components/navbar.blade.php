<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">
            GalleryPhoto
        </a>

        <div class="flex items-center gap-4">
            @auth
                <span class="text-sm text-gray-600">
                    Hi, {{ auth()->user()->name }}
                </span>

                <a href="{{ route('profile.edit') }}"
                   class="text-sm text-indigo-600 hover:underline">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-sm text-red-500 hover:underline">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">
                    Login
                </a>
                <a href="{{ route('register') }}" class="text-sm text-indigo-600 hover:underline">
                    Register
                </a>
            @endauth
        </div>
    </div>
</nav>
