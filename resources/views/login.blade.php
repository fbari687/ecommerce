@extends('layouts.index')

@section('content')
    <div
        class="container max-w-md mx-auto xl:max-w-3xl lg:max-h-[450px] h-full flex bg-[#111827] rounded-lg shadow overflow-hidden">
        <div class="relative hidden xl:block xl:w-1/2 h-full">
            <img class="absolute h-auto w-full object-cover" src="{{ asset('img/perpus.jpg') }}" alt="my zomato" />
        </div>
        <div class="w-full xl:w-1/2 p-8 text-white">
            <form method="post" action="/login">
                @csrf
                <h1 class="text-2xl font-bold">Login Ke Akun Anda</h1>

                <div class="w-full">
                    <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Anda ingin login sebagai?</h3>
                    <ul class="grid w-full gap-3 md:grid-cols-3">
                        <x-radio-role title="Anggota" value="member" />
                        <x-radio-role title="Pustakawan" value="pustakawan" />
                        <x-radio-role title="Admin" value="admin" />
                    </ul>
                </div>
                <x-input type="text" id="username" name="username" placeholder="Username" label="Username" />
                <x-input type="password" id="password" name="password" placeholder="Password" label="Password" />
                @error('invalid')
                    <p class="mt-2 text-red-600 font-bold text-sm">{{ $message }}</p>
                @enderror
                <x-button text="Login" />
            </form>
        </div>
    </div>
    <script>
        const radioButtons = document.getElementsByName('role');
        for (const radioButton of radioButtons) {
            radioButton.addEventListener('change', (event) => {
                console.log(event.target.value);
            });
        }
    </script>
@endsection
