@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

    {{-- Preview Image --}}
    <div>
        <img
            src="{{ asset('storage/' . $image->file_low_res) }}"
            class="rounded shadow"
        >
    </div>

    {{-- Info & Action --}}
    <div>
        <h1 class="text-2xl font-bold mb-4">
            {{ $image->title }}
        </h1>

        @auth
            @if ($hasReviewed)
                <a href="{{ route('images.download', $image) }}"
                   class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Download HD
                </a>
            @else
                <form method="POST" action="{{ route('reviews.store') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="image_id" value="{{ $image->id }}">

                    <textarea
                        name="comment"
                        rows="4"
                        class="w-full border rounded px-3 py-2"
                        placeholder="Tulis komentar untuk membuka foto HD..."
                        required
                    ></textarea>

                    <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Kirim Komentar
                    </button>
                </form>
            @endif
        @else
            <p class="text-gray-600">
                Login untuk memberikan komentar dan mengunduh foto versi HD.
            </p>
        @endauth
    </div>

</div>
@endsection
