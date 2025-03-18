@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded shadow-md">
    <h2 class="text-xl font-bold mb-4">Import Data Pengguna</h2>

    @if (session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.import.process') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required class="border p-2 rounded w-full">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded mt-2">Upload</button>
    </form>
</div>
@endsection
