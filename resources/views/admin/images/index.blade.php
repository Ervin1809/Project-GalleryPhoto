@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Manage Images</h1>

    <a href="{{ route('admin.images.create') }}"
       class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 shadow-lg transform hover:scale-105 transition">
        ➕ Upload New Photo
    </a>
</div>

<div class="bg-white shadow-xl rounded-xl overflow-hidden">
    <table class="w-full">
        <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
            <tr>
                <th class="text-left px-6 py-4 text-xs font-bold text-gray-600 uppercase tracking-wider">
                    Title
                </th>
                <th class="px-6 py-4 text-xs font-bold text-gray-600 uppercase tracking-wider">
                    Low Res Preview
                </th>
                <th class="px-6 py-4 text-xs font-bold text-gray-600 uppercase tracking-wider">
                    High Res Preview
                </th>
                <th class="px-6 py-4 text-xs font-bold text-gray-600 uppercase tracking-wider">
                    Comments
                </th>
                <th class="px-6 py-4 text-xs font-bold text-gray-600 uppercase tracking-wider">
                    Uploaded
                </th>
                <th class="px-6 py-4 text-xs font-bold text-gray-600 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($images as $image)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-900">{{ $image->title }}</div>
                        @if($image->description)
                            <div class="text-xs text-gray-500 mt-1">{{ Str::limit($image->description, 50) }}</div>
                        @endif
                    </td>

                    {{-- Low Res Preview --}}
                    <td class="px-6 py-4 text-center">
                        <div class="flex flex-col items-center gap-2">
                            <img src="{{ asset('storage/' . $image->file_low_res) }}"
                                 alt="{{ $image->title }}"
                                 class="h-20 w-20 object-cover rounded-lg shadow-md border-2 border-orange-200 cursor-pointer hover:scale-110 transition"
                                 onclick="showImageModal('{{ asset('storage/' . $image->file_low_res) }}', 'Low Resolution')">
                            <span class="text-xs bg-orange-100 text-orange-700 px-2 py-1 rounded font-semibold">
                                LOW RES
                            </span>
                        </div>
                    </td>

                    {{-- High Res Preview --}}
                    <td class="px-6 py-4 text-center">
                        <div class="flex flex-col items-center gap-2">
                            <img src="{{ asset('storage/' . $image->file_high_res) }}"
                                 alt="{{ $image->title }}"
                                 class="h-20 w-20 object-cover rounded-lg shadow-md border-2 border-green-200 cursor-pointer hover: scale-110 transition"
                                 onclick="showImageModal('{{ asset('storage/' . $image->file_high_res) }}', 'High Resolution')">
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded font-semibold">
                                HIGH RES
                            </span>
                        </div>
                    </td>

                    <td class="px-6 py-4 text-center">
                        <div class="inline-flex items-center bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full font-semibold">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                            </svg>
                            {{ $image->reviews->count() }}
                        </div>
                    </td>

                    <td class="px-6 py-4 text-center text-sm text-gray-600">
                        {{ $image->created_at->format('d M Y') }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-3">
                            <a href="{{ route('images.show', $image) }}"
                               class="text-blue-600 hover:text-blue-800 hover:underline text-sm font-semibold flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                View
                            </a>
                            <form action="{{ route('admin.images.destroy', $image) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this image?  This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-800 hover:underline text-sm font-semibold flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-. 867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-gray-400">
                            <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-lg font-semibold mb-2">No images uploaded yet</p>
                            <p class="text-sm mb-4">Start by uploading your first photo!</p>
                            <a href="{{ route('admin. images.create') }}"
                               class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                                Upload Now
                            </a>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
@if($images->hasPages())
    <div class="mt-6">
        {{ $images->links() }}
    </div>
@endif

{{-- Image Modal (untuk preview besar) --}}
<div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center p-4" onclick="closeImageModal()">
    <div class="relative max-w-4xl max-h-full">
        <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white bg-black bg-opacity-50 rounded-full p-2 hover:bg-opacity-75 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <img id="modalImage" src="" alt="" class="max-w-full max-h-screen rounded-lg shadow-2xl">
        <p id="modalTitle" class="text-white text-center mt-4 text-lg font-semibold"></p>
    </div>
</div>

<script>
function showImageModal(imageSrc, title) {
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('modalImage').src = imageSrc;
    document. getElementById('modalTitle').textContent = title;
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
}

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>

@endsection
