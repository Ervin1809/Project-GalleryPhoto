{{-- resources/views/components/navbar.blade.php --}}
<nav class="bg-white shadow-sm border-b border-warm-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-gradient-to-br from-warm-300 to-warm-500 rounded-lg flex items-center justify-center shadow-md group-hover:shadow-lg transition-shadow">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="text-xl font-bold text-warm-700">Gallery<span class="text-warm-500">Photo</span></span>
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden md:flex items-center gap-6">
                {{-- Gallery Link --}}
                <a href="{{ route('home') }}"
                   class="text-sm font-medium {{ request()->routeIs('home') ? 'text-warm-500' : 'text-warm-600 hover:text-warm-500' }} transition-colors">
                    Gallery
                </a>

                @auth
                    {{-- Admin Link --}}
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.images.index') }}"
                           class="text-sm font-medium {{ request()->routeIs('admin.*') ? 'text-warm-500' : 'text-warm-600 hover:text-warm-500' }} transition-colors">
                            Admin Panel
                        </a>
                    @endif

                    {{-- User Info --}}
                    <div class="flex items-center gap-4 pl-4 border-l border-warm-200">
                        <span class="text-sm text-warm-500">
                            Hi, <span class="font-medium text-warm-700">{{ auth()->user()->name }}</span>
                        </span>

                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button class="text-sm font-medium text-warm-600 hover:text-warm-800 transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center gap-3 pl-4 border-l border-warm-200">
                        <a href="{{ route('login') }}"
                           class="text-sm font-medium text-warm-600 hover:text-warm-700 transition-colors">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                           class="bg-warm-500 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-warm-600 transition-all shadow-md hover:shadow-lg">
                            Register
                        </a>
                    </div>
                @endauth
            </div>

            {{-- Mobile Menu Button --}}
            <button type="button" class="md:hidden p-2 rounded-lg text-warm-600 hover:bg-warm-50 transition-colors" onclick="toggleMobileMenu()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        {{-- Mobile Navigation --}}
        <div id="mobileMenu" class="md:hidden hidden border-t border-warm-100 py-4 space-y-3">
            <a href="{{ route('home') }}"
               class="block py-2 text-sm font-medium {{ request()->routeIs('home') ? 'text-warm-500' : 'text-warm-600' }}">
                Gallery
            </a>

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.images.index') }}"
                       class="block py-2 text-sm font-medium {{ request()->routeIs('admin.*') ? 'text-warm-500' : 'text-warm-600' }}">
                        Admin Panel
                    </a>
                @endif

                <div class="pt-3 border-t border-warm-100">
                    <p class="text-sm text-warm-500 mb-2">Signed in as <span class="font-medium">{{ auth()->user()->name }}</span></p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full text-left py-2 text-sm font-medium text-warm-600 hover:text-warm-800">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <div class="pt-3 border-t border-warm-100 space-y-2">
                    <a href="{{ route('login') }}"
                       class="block py-2 text-sm font-medium text-warm-600">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="block bg-warm-500 text-white text-center px-4 py-2.5 rounded-lg text-sm font-medium">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
}
</script>
