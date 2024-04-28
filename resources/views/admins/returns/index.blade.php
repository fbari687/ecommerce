@extends('admins.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/selectize.default.min.css') }}">
@endsection

@section('content')
    <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
        <section class="container px-4 mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Form Pengembalian</h2>
            <form action="/dashboard/returns" method="POST" class="w-full flex flex-col mt-5 gap-4 max-w-6xl mx-auto">
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
                <div class="w-full flex flex-col gap-1 text-white" id="searchResult">
                </div>
                {{-- <div class="flex flex-col gap-2 text-white">
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
                </div> --}}

                <x-button text="Kembalikan" isDisabled="true" />
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

            $('#f_idanggota').change(async function(e) {
                e.preventDefault();
                console.log(e.target.value);
                let result = await fetch(`/dashboard/returns/search/${e.target.value}`, {
                    method: "GET"
                }).then(response => response.json());
                if (result.status == "error") {
                    let content = `<h4 class="text-xl font-bold">Tidak Sedang Meminjam Buku...</h4>`;
                    $("#searchResult").html(content)
                    $("#btn").attr('disabled', true);
                    $("#btn").removeClass("bg-teal-600 hover:bg-teal-700").addClass(
                        "bg-slate-500 hover:bg-slate-500");
                } else if (result.status = "success") {
                    let data = result.data;
                    let content = '';
                    data.forEach(borrow => {
                        content += `<div class="my-2"><h4 class="text-xl font-bold">Sedang Meminjam Buku ...</h4>
                        <table class="w-fit text-lg">
                <tr>
                    <td class="font-bold">
                        Buku
                    </td>
                    <td>
                        : ${borrow.f_buku}
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">
                        Admin
                    </td>
                    <td>
                        : ${borrow.f_admin}
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">
                        Tanggal Pinjam
                    </td>
                    <td>
                        : ${borrow.f_tanggalpeminjaman}
                    </td>
                </tr>
                <tr>
                        <td colspan="1">
                            <input type="hidden" name="f_id[]" value="${borrow.f_id}" class="hidden" disabled>
                            <input type="checkbox" name="" id="check${borrow.f_id}" class="checks">
                            <label for="check${borrow.f_id}">Ingin Dikembalikan</label>
                        </td>
                    </tr>
            </table></div>`;
                    });
                    $("#searchResult").html(content);
                    $("#btn").attr('disabled', false);
                    $("#btn").removeClass("bg-slate-500 hover:bg-slate-500").addClass(
                        "bg-teal-600 hover:bg-teal-700");
                    // const checks = document.querySelectorAll('.checks');
                }

                // checks.forEach(function(check) {
                //     check.addEventListener('change', function() {
                //         if (this.checked) {
                //             console.log(this.previousElementSibling);
                //         }
                //     });
                // });
                $(".checks").each(function(check) {
                    $(this).change(function() {
                        if (this.checked) {
                            let inputId = this.previousElementSibling;
                            inputId.disabled = false;
                            console.log(inputId);
                        } else {
                            let inputId = this.previousElementSibling;
                            inputId.disabled = true;
                            console.log(inputId);
                        }
                    })
                });
                //     type: "get",
                //     url: `/dashboard/returns/search/${e.target.value}`,
                //     dataType: "json",
                //     success: function(response) {
                //         if (response.status == "error") {
                //             let content =
                //                 `<h4 class="text-xl font-bold">Tidak Sedang Meminjam Buku...</h4>`;
                //             $("#searchResult").html(content)
                //             $("#btn").attr('disabled', true);
                //             $("#btn").removeClass("bg-teal-600 hover:bg-teal-700").addClass(
                //                 "bg-slate-500 hover:bg-slate-500");
                //         } else if (response.status == "success") {
                //             let data = response.data;
                //             let content = '';
                //             data.forEach(borrow => {
                //                     content += `<div class="my-2"><h4 class="text-xl font-bold">Sedang Meminjam Buku ...</h4>
            //             <table class="w-fit text-lg">
            //     <tr>
            //         <td class="font-bold">
            //             Buku
            //         </td>
            //         <td>
            //             : ${borrow.f_buku}
            //         </td>
            //     </tr>
            //     <tr>
            //         <td class="font-bold">
            //             Admin
            //         </td>
            //         <td>
            //             : ${borrow.f_admin}
            //         </td>
            //     </tr>
            //     <tr>
            //         <td class="font-bold">
            //             Tanggal Pinjam
            //         </td>
            //         <td>
            //             : ${borrow.f_tanggalpeminjaman}
            //         </td>
            //     </tr>
            //     <tr>
            //             <td colspan="1">
            //                 <input type="hidden" name="f_id[]" value="" class="hidden">
            //                 <input type="checkbox" name="" id="" class="checks">
            //                 <label for="f_check">Ingin Dikembalikan</label>
            //             </td>
            //         </tr>
            // </table></div>`;
                //             });

                //             $("#searchResult").html(content);
                //             $("#btn").attr('disabled', false);
                //             $("#btn").removeClass("bg-slate-500 hover:bg-slate-500").addClass(
                //                 "bg-teal-600 hover:bg-teal-700");
                //         }
                //     }
                // });
                // $(".checks").each(function(check) {
                //     check.change(function() {
                //         if (this.checked) {
                //             console.log(this.previousElementSibling)
                //         }
                //     })
                // });
            })
            // $('.checks').each(function(check) {
            //     console.log(this)
            // });
            // const selectAnggota = document.getElementById('f_idanggota');
            // selectAnggota.addEventListener('change', function() {
            //     console.log("tes");
            // });
        });
        // document.addEventListener("DOMContentLoaded", function() {

        // });
    </script>
    @if (session()->has('notify'))
        <script>
            alert('{{ session('notify') }}');
        </script>
    @endif
@endsection
