@extends('admins.layouts.index')

@section('content')
    <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
        <section class="container px-4 mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Kategori</h2>
            <form action="/dashboard/categories/{{ $category->f_id }}" method="POST"
                class="w-full flex flex-col mt-5 gap-4 max-w-6xl mx-auto">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-2 text-white">
                    <label for="f_kategori" class="font-medium text-lg">Nama</label>
                    <input type="text" name="f_kategori" id="f_kategori" class="bg-gray-950 py-2 px-3 rounded-md"
                        placeholder="Kategori" value="{{ old('f_kategori', $category->f_kategori) }}">
                    @error('f_kategori')
                        <p class="text-red-500 px-3 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <x-button text="Edit" />
            </form>

        </section>
    </div>
@endsection
