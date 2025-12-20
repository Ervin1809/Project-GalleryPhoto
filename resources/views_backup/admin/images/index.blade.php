@extends('layouts.admin')  {{-- Ganti dari layouts. app --}}

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Manage Images</h1>

    <a href="{{ route('admin.images.create') }}"
       class="bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700 shadow">
        ➕ Upload Foto
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Title
                </th>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Preview
                </th>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Reviews
                </th>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($images as $image)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $image->title }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <img src="{{ asset('storage/' . $image->file_low_res) }}"
                             alt="{{ $image->title }}"
                             class="h-16 w-16 object-cover rounded mx-auto shadow">
                    </td>
                    <td class="px-6 py-4 text-center text-gray-600">
                        {{ $image->reviews->count() ?? 0 }} comments
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-3">
                            <a href="{{ route('images.show', $image) }}"
                               class="text-blue-600 hover:text-blue-800 hover:underline text-sm">
                                View
                            </a>
                            <form action="{{ route('admin.images.destroy', $image) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this image?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-800 hover:underline text-sm">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                        No images uploaded yet.  Start by uploading your first photo!
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination jika ada --}}
@if($images->hasPages())
    <div class="mt-6">
        {{ $images->links() }}
    </div>
@endif
@endsection
