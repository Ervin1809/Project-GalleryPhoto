@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Admin - Images</h1>

    <a href="{{ route('admin.images.create') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
        Upload Foto
    </a>
</div>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-100">
        <tr>
            <th class="text-left px-4 py-2">Title</th>
            <th class="px-4 py-2">Preview</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($images as $image)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $image->title }}</td>
                <td class="px-4 py-2">
                    <img src="{{ asset('storage/' . $image->file_low_res) }}" class="h-16">
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
