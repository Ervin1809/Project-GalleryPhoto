{{-- resources/views/components/message.blade.php --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @if (session('success'))
        <div class="my-4 rounded-lg bg-sage-50 border border-sage-200 text-sage-700 px-4 py-3 flex items-start gap-3">
            <svg class="w-5 h-5 text-sage-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="text-sm">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="my-4 rounded-lg bg-warm-50 border border-warm-200 text-warm-700 px-4 py-3 flex items-start gap-3">
            <svg class="w-5 h-5 text-warm-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <span class="text-sm">{{ session('error') }}</span>
        </div>
    @endif

    @if ($errors->any() && !request()->routeIs('login', 'register', 'admin.images.create'))
        <div class="my-4 rounded-lg bg-warm-50 border border-warm-200 text-warm-700 px-4 py-3">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-warm-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <ul class="text-sm list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
