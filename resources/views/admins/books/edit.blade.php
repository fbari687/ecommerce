@extends('admins.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/selectize.default.min.css') }}">
@endsection

@section('content')
    <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
        <section class="container px-4 mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Tambah Buku</h2>
            <form action="/dashboard/books/{{ $book->f_id }}" method="POST"
                class="w-full flex flex-col mt-5 gap-4 max-w-6xl mx-auto">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-2 text-white">
                    <label for="f_judul" class="font-medium text-lg">Judul</label>
                    <input type="text" name="f_judul" id="f_judul" class="bg-gray-950 py-2 px-3 rounded-md"
                        placeholder="Judul" value="{{ old('f_judul', $book->f_judul) }}">
                    @error('f_judul')
                        <p class="text-red-500 px-3 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 text-white">
                    <label for="f_pengarang" class="font-medium text-lg">Pengarang</label>
                    <input type="text" name="f_pengarang" id="f_pengarang" class="bg-gray-950 py-2 px-3 rounded-md"
                        placeholder="Pengarang" value="{{ old('f_pengarang', $book->f_pengarang) }}">
                    @error('f_pengarang')
                        <p class="text-red-500 px-3 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 text-white">
                    <label for="f_penerbit" class="font-medium text-lg">Penerbit</label>
                    <input type="text" name="f_penerbit" id="f_penerbit" class="bg-gray-950 py-2 px-3 rounded-md"
                        placeholder="Penerbit" value="{{ old('f_penerbit', $book->f_penerbit) }}">
                    @error('f_penerbit')
                        <p class="text-red-500 px-3 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 text-white">
                    <label for="f_deskripsi" class="font-medium text-lg">Deskripsi</label>
                    <textarea name="f_deskripsi" id="f_deskripsi" class="h-60 px-3 py-2 bg-gray-950 rounded-md" placeholder="Deskripsi">{{ old('f_deskripsi', $book->f_deskripsi) }}</textarea>
                    @error('f_deskripsi')
                        <p class="text-red-500 px-3 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 text-white">
                    <label for="f_idkategori" class="font-medium text-lg">Kategori</label>
                    <select name="f_idkategori" id="f_idkategori" class="bg-gray-950 py-2 px-3 rounded-md">
                        <option value="0" selected disabled>-- Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->f_id }}"
                                {{ $category->f_id == old('f_idkategori', $book->f_idkategori) ? 'selected' : '' }}>
                                {{ $category->f_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('f_idkategori')
                        <p class="text-red-500 px-3 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 text-white">
                    <label for="f_status" class="font-medium text-lg">Status</label>
                    <select name="f_status" id="f_status" class="bg-gray-950 py-2 px-3 rounded-md">
                        <option value="0" selected disabled>-- Pilih Status Ketersediaan</option>
                        <option value="Tersedia"
                            {{ 'Tersedia' == old('f_status', $book->detail->f_status) ? 'selected' : '' }}>Tersedia
                        </option>
                        <option value="Tidak Tersedia"
                            {{ 'Tidak Tersedia' == old('f_status', $book->detail->f_status) ? 'selected' : '' }}>Tidak
                            Tersedia</option>
                    </select>
                    @error('f_status')
                        <p class="text-red-500 px-3 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <x-button text="Tambah" />
            </form>

        </section>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/selectize.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#f_idkategori').selectize({
                searchField: ['text']
            });
        });
    </script>
@endsection
