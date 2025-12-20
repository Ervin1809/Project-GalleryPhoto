{{-- resources/views/components/navbar.blade.php --}}
<nav class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">
                📸 GalleryPhoto
            </a>

            {{-- Navigation Links --}}
            <div class="flex items-center gap-6">
                {{-- Gallery Link --}}
                <a href="{{ route('home') }}"
                   class="text-sm {{ request()->routeIs('home') ? 'font-semibold text-indigo-600' : 'text-gray-700 hover:text-indigo-600' }}">
                    Gallery
                </a>

                @auth
                    {{-- Admin Link (jika user adalah admin) --}}
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.images.index') }}"
                           class="text-sm {{ request()->routeIs('admin.*') ? 'font-semibold text-indigo-600' : 'text-gray-700 hover:text-indigo-600' }}">
                            Admin Panel
                        </a>
                    @endif

                    {{-- User Info --}}
                    <span class="text-sm text-gray-600 border-l pl-6">
                        Hi, {{ auth()->user()->name }}
                    </span>

                    {{-- Logout --}}
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="text-sm text-red-500 hover:text-red-700 hover:underline">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="text-sm text-gray-700 hover:text-indigo-600">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
