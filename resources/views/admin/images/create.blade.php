@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Upload Foto</h1>

<form method="POST" action="{{ route('admin.images.store') }}" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <div>
        <label class="block mb-1">Judul</label>
        <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block mb-1">Low Resolution (Preview)</label>
        <input type="file" name="file_low_res" class="w-full" required>
    </div>

    <div>
        <label class="block mb-1">High Resolution</label>
        <input type="file" name="file_high_res" class="w-full" required>
    </div>

    <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
        Upload
    </button>
</form>
@endsection
