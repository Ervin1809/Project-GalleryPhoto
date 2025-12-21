@extends('layouts.admin')

@section('content')
<div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-bold text-warm-700">Manage Images</h1>
        <p class="text-warm-500 mt-1">Upload and manage your photo gallery</p>
    </div>

    <a href="{{ route('admin.images.create') }}"
       class="inline-flex items-center bg-warm-500 text-white px-6 py-3 rounded-xl hover:bg-warm-600 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all font-semibold">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Upload New Photo
    </a>
</div>

<div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-warm-100">
    {{-- Desktop Table View --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full">
            <thead class="bg-warm-50 border-b border-warm-200">
                <tr>
                    <th class="text-left px-6 py-4 text-xs font-bold text-warm-600 uppercase tracking-wider">
                        Title
                    </th>
                    <th class="px-6 py-4 text-xs font-bold text-warm-600 uppercase tracking-wider text-center">
                        Low Res
                    </th>
                    <th class="px-6 py-4 text-xs font-bold text-warm-600 uppercase tracking-wider text-center">
                        High Res
                    </th>
                    <th class="px-6 py-4 text-xs font-bold text-warm-600 uppercase tracking-wider text-center">
                        Comments
                    </th>
                    <th class="px-6 py-4 text-xs font-bold text-warm-600 uppercase tracking-wider text-center">
                        Uploaded
                    </th>
                    <th class="px-6 py-4 text-xs font-bold text-warm-600 uppercase tracking-wider text-center">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-warm-100">
                @forelse ($images as $image)
                    <tr class="hover:bg-warm-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-semibold text-warm-700">{{ $image->title }}</div>
                            @if($image->description)
                                <div class="text-xs text-warm-400 mt-1">{{ Str::limit($image->description, 50) }}</div>
                            @endif
                        </td>

                        {{-- Low Res Preview --}}
                        <td class="px-6 py-4 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <img src="{{ asset('storage/' . $image->file_low_res) }}"
                                     alt="{{ $image->title }}"
                                     class="h-16 w-16 object-cover rounded-lg shadow-md border-2 border-warm-200 cursor-pointer hover:scale-110 transition-transform"
                                     onclick="showImageModal('{{ asset('storage/' . $image->file_low_res) }}', 'Low Resolution')">
                                <span class="text-xs bg-warm-100 text-warm-600 px-2 py-1 rounded-full font-medium">
                                    LOW RES
                                </span>
                            </div>
                        </td>

                        {{-- High Res Preview --}}
                        <td class="px-6 py-4 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <img src="{{ asset('storage/' . $image->file_high_res) }}"
                                     alt="{{ $image->title }}"
                                     class="h-16 w-16 object-cover rounded-lg shadow-md border-2 border-sage-200 cursor-pointer hover:scale-110 transition-transform"
                                     onclick="showImageModal('{{ asset('storage/' . $image->file_high_res) }}', 'High Resolution')">
                                <span class="text-xs bg-sage-100 text-sage-600 px-2 py-1 rounded-full font-medium">
                                    HIGH RES
                                </span>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex items-center bg-sage-50 text-sage-600 px-3 py-1 rounded-full font-semibold">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                                </svg>
                                {{ $image->reviews->count() }}
                            </div>
                        </td>

                        <td class="px-6 py-4 text-center text-sm text-warm-500">
                            {{ $image->created_at->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-3">
                                <a href="{{ route('images.show', $image) }}"
                                   class="text-warm-500 hover:text-warm-700 text-sm font-medium flex items-center transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    View
                                </a>
                                <form action="{{ route('admin.images.destroy', $image) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this image? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-500 hover:text-red-700 text-sm font-medium flex items-center transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 bg-warm-100 rounded-2xl flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-warm-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-warm-600 mb-2">No images uploaded yet</h3>
                                <p class="text-sm text-warm-400 mb-4">Start by uploading your first photo!</p>
                                <a href="{{ route('admin.images.create') }}"
                                   class="bg-warm-500 text-white px-6 py-2.5 rounded-xl hover:bg-warm-600 transition-all font-medium">
                                    Upload Now
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Mobile Card View --}}
    <div class="md:hidden divide-y divide-warm-100">
        @forelse ($images as $image)
            <div class="p-4">
                <div class="flex gap-4">
                    <img src="{{ asset('storage/' . $image->file_low_res) }}"
                         alt="{{ $image->title }}"
                         class="w-20 h-20 object-cover rounded-xl shadow-md">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-warm-700 truncate">{{ $image->title }}</h3>
                        <p class="text-xs text-warm-400 mt-1">{{ $image->created_at->format('d M Y') }}</p>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-xs bg-sage-50 text-sage-600 px-2 py-1 rounded-full font-medium flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7z" clip-rule="evenodd"/>
                                </svg>
                                {{ $image->reviews->count() }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-3 mt-4 pt-4 border-t border-warm-100">
                    <a href="{{ route('images.show', $image) }}"
                       class="flex-1 text-center py-2 text-warm-600 font-medium rounded-lg border border-warm-200 hover:bg-warm-50 transition-colors text-sm">
                        View
                    </a>
                    <form action="{{ route('admin.images.destroy', $image) }}" method="POST" class="flex-1"
                          onsubmit="return confirm('Delete this image?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-2 text-red-600 font-medium rounded-lg border border-red-200 hover:bg-red-50 transition-colors text-sm">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-8 text-center">
                <div class="w-16 h-16 bg-warm-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-warm-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="text-warm-500 mb-4">No images yet</p>
                <a href="{{ route('admin.images.create') }}" class="bg-warm-500 text-white px-4 py-2 rounded-lg text-sm font-medium">
                    Upload Now
                </a>
            </div>
        @endforelse
    </div>
</div>

{{-- Pagination --}}
@if($images->hasPages())
    <div class="mt-6">
        {{ $images->links() }}
    </div>
@endif

{{-- Image Modal --}}
<div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-80 z-50 flex items-center justify-center p-4" onclick="closeImageModal()">
    <div class="relative max-w-4xl max-h-full">
        <button onclick="closeImageModal()" class="absolute -top-12 right-0 text-white hover:text-warm-300 transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <img id="modalImage" src="" alt="" class="max-w-full max-h-[80vh] rounded-2xl shadow-2xl">
        <p id="modalTitle" class="text-white text-center mt-4 text-lg font-semibold"></p>
    </div>
</div>

<script>
function showImageModal(imageSrc, title) {
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalTitle').textContent = title;
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>
@endsection
