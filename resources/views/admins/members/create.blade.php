@extends('admins.layouts.index')

@section('content')
    <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
        <section class="container px-4 mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Registrasi Member Baru</h2>
            <form action="/dashboard/members" method="POST" class="w-full flex flex-col mt-5 gap-4 max-w-6xl mx-auto">
                @csrf
                <div class="flex flex-col gap-2 text-white">
                    <label for="f_nama" class="font-medium text-lg">Nama</label>
                    <input type="text" name="f_nama" id="f_nama" class="bg-gray-950 py-2 px-3 rounded-md"
                        placeholder="Nama" value="{{ old('f_nama') }}">
                    @error('f_nama')
                        <p class="text-red-500 px-3 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 text-white">
                    <label for="f_username" class="font-medium text-lg">Username</label>
                    <input type="text" name="f_username" id="f_username" class="bg-gray-950 py-2 px-3 rounded-md"
                        placeholder="Username" value="{{ old('f_username') }}">
                    @error('f_username')
                        <p class="text-red-500 px-3 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 text-white">
                    <label for="f_password" class="font-medium text-lg">Password</label>
                    <div class="bg-gray-950 py-2 px-3 rounded-md flex items-center">
                        <input type="password" name="f_password" id="f_password" class="bg-transparent flex-1 outline-none"
                            placeholder="Password" value="{{ old('f_password') }}">
                        <button type="button" class="showhidden">show</button>
                    </div>
                    @error('f_password')
                        <p class="text-red-500 px-3 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 text-white">
                    <label for="f_confirmPassword" class="font-medium text-lg">Confirm Password</label>
                    <div class="bg-gray-950 py-2 px-3 rounded-md flex items-center">
                        <input type="password" name="f_confirmPassword" id="f_confirmPassword"
                            class="bg-transparent flex-1 outline-none" placeholder="Confirm Password"
                            value="{{ old('f_confirmPassword') }}">
                        <button type="button" class="showhidden">show</button>
                    </div>
                    @error('f_confirmPassword')
                        <p class="text-red-500 px-3 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 text-white">
                    <label for="f_tempatlahir" class="font-medium text-lg">Tempat Lahir</label>
                    <input type="text" name="f_tempatlahir" id="f_tempatlahir" class="bg-gray-950 py-2 px-3 rounded-md"
                        placeholder="Tempat Lahir" value="{{ old('f_tempatlahir') }}">
                    @error('f_tempatlahir')
                        <p class="text-red-500 px-3 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 text-white">
                    <label for="f_tanggallahir" class="font-medium text-lg">Tanggal Lahir</label>
                    <input type="date" name="f_tanggallahir" id="f_tanggallahir" class="bg-gray-950 py-2 px-3 rounded-md"
                        style="color-scheme: dark" value="{{ old('f_tanggallahir') }}">
                    @error('f_tanggallahir')
                        <p class="text-red-500 px-3 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <x-button text="Register" />
            </form>

        </section>
    </div>
@endsection

@section('script')
    <script>
        let showHiddenBtns = document.querySelectorAll('.showhidden');
        showHiddenBtns.forEach((showHiddenBtn) => {
            showHiddenBtn.addEventListener('click', function() {
                let input = this.previousElementSibling;
                if (input.type == "text") {
                    input.type = "password";
                    this.innerHTML = "show";
                } else {
                    input.type = "text";
                    this.innerHTML = "hide";
                }
            });
        });
    </script>
@endsection
