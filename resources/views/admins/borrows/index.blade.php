@extends('admins.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/selectize.default.min.css') }}">
@endsection

@section('content')
    <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
        <section class="container px-4 mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Form Peminjaman</h2>
            <form action="/dashboard/borrows" method="POST" class="w-full flex flex-col mt-5 gap-4 max-w-6xl mx-auto">
                @csrf
                <div class="flex flex-col gap-2 text-white">
                    <label for="f_idanggota" class="font-medium text-lg">Anggota</label>
                    <select name="f_idanggota" id="f_idanggota" class="bg-gray-950 py-2 px-3 rounded-md">
                        <option value="0" selected disabled>Ketik Nama/Username Anggota...</option>
                        @foreach ($members as $member)
                            <option value="{{ $member->f_id }}" {{ $member->f_id == old('f_idanggota') ? 'selected' : '' }}>
                                {{ $member->f_nama }} ({{ $member->f_username }})
                            </option>
                        @endforeach
                    </select>
                    @error('f_idanggota')
                        <p class="text-red-500 px-3 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 text-white">
                    <label for="f_idbuku" class="font-medium text-lg">Buku</label>
                    <select name="f_idbuku" id="f_idbuku" class="bg-gray-950 py-2 px-3 rounded-md">
                        <option value="0" selected disabled>Ketik Judul Buku...</option>
                        @foreach ($books as $book)
                            <option value="{{ $book->f_id }}"
                                {{ $book->detail->f_status == 'Tidak Tersedia' ? 'disabled' : '' }}
                                {{ $book->f_id == old('f_idbuku') ? 'selected' : '' }}>
                                {{ $book->f_judul }}
                                {{ $book->detail->f_status == 'Tidak Tersedia' ? '(Tidak Tersedia)' : '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('f_idbuku')
                        <p class="text-red-500 px-3 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <x-button text="Pinjam" />
            </form>

        </section>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/selectize.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#f_idanggota').selectize({
                searchField: ['text']
            });
            $('#f_idbuku').selectize({
                searchField: ['text']
            });
        });
    </script>
    @if (session()->has('notify'))
        <script>
            alert('{{ session('notify') }}');
        </script>
    @endif
    @if (session()->has('again'))
        <script>
            let again = confirm('{{ session('again') }}');
            let idmember = {{ session('idmember') }};
            console.log(again);
            console.log(idmember);
            if (again) {
                document.querySelector("#f_idanggota").value = `${idmember}`;
            }
        </script>
    @endif
@endsection
