@extends('layouts.index')

@section('content')
    <div class="w-full relative h-screen text-white overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('img/background home.jpg') }}" alt="Background Image"
                class="object-cover object-center w-full h-full" />
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>

        <div class="relative z-10 flex flex-col justify-center items-center h-full text-center">
            <h1 class="text-3xl lg:text-5xl font-bold leading-tight mb-4">Selamat Datang Di Perpustakaan 65</h1>
            <p class="text-base lg:text-lg text-gray-300 mb-8">Temukan Buku-Buku yang Menarik Disini!</p>
            @if (Auth::guard('member')->check())
                <p class="text-base font-bold lg:text-lg text-gray-300 mb-8">Selamat Membaca Buku</p>
            @else
                {{-- <a href="/login"
                    class="bg-teal-600 text-white hover:bg-teal-700 py-2 px-6 rounded-full text-lg font-semibold transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">Login</a> --}}
            @endif
        </div>
    </div>
@endsection
