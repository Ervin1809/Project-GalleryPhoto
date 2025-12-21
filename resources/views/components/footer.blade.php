{{-- resources/views/components/footer.blade.php --}}
<footer class="bg-warm-700 text-warm-200 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-8 md:py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Brand --}}
                <div class="md:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-warm-300 to-warm-400 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">GalleryPhoto</span>
                    </a>
                    <p class="text-sm text-warm-300 leading-relaxed">
                        A premium photography portfolio showcasing exclusive works.
                        Leave a comment to unlock high-resolution downloads.
                    </p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h3 class="text-white font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('home') }}" class="text-sm text-warm-300 hover:text-white transition-colors">
                                Gallery
                            </a>
                        </li>
                        @guest
                            <li>
                                <a href="{{ route('login') }}" class="text-sm text-warm-300 hover:text-white transition-colors">
                                    Login
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}" class="text-sm text-warm-300 hover:text-white transition-colors">
                                    Register
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h3 class="text-white font-semibold mb-4">Get in Touch</h3>
                    <p class="text-sm text-warm-300 mb-2">
                        Interested in licensing photos or collaborations?
                    </p>
                    <a href="mailto:contact@galleryphoto.com" class="text-sm text-gold-300 hover:text-gold-200 transition-colors">
                        contact@galleryphoto.com
                    </a>
                </div>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="border-t border-warm-600 py-4">
            <p class="text-center text-sm text-warm-400">
                © {{ date('Y') }} GalleryPhoto. All rights reserved.
                <span class="hidden sm:inline">| Crafted with passion for photography</span>
            </p>
        </div>
    </div>
</footer>
