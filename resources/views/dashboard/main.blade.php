@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">
        Galeri Foto
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($images as $image)
            <div class="bg-white rounded shadow overflow-hidden">
                <img
                    src="{{ asset('storage/' . $image->file_low_res) }}"
                    alt="{{ $image->title }}"
                    class="w-full h-48 object-cover"
                >

                <div class="p-4">
                    <h2 class="font-semibold text-lg">
                        {{ $image->title }}
                    </h2>

                    <a href="{{ route('images.show', $image) }}"
                       class="inline-block mt-3 text-sm text-indigo-600 hover:underline">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
