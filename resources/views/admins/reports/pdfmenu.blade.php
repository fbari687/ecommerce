@extends('admins.layouts.index')

@section('content')
    <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
        <section class="container px-4 mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Cetak Laporan Ke PDF</h2>
            <form action="/dashboard/reports/printtopdf" method="POST"
                class="w-full flex flex-col mt-5 gap-4 max-w-6xl mx-auto">
                @csrf
                <div class="flex flex-col gap-2 text-white" id="printModeContainer">
                    <label for="printMode" class="font-medium text-lg">Jumlah Yang Ingin Di Cetak</label>
                    <select name="printMode" id="printMode" class="bg-gray-950 py-2 px-3 rounded-md">
                        <option value="seluruhnya" {{ 'seluruhnya' == old('printMode') ? 'selected' : '' }}>Seluruhnya
                        </option>
                        <option value="sebagian" {{ 'sebagian' == old('printMode') ? 'selected' : '' }}>
                            Sebagian</option>
                    </select>
                    @error('printMode')
                        <p class="text-red-500 px-3 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 text-white items-start justify-start w-full" id="dateContainer">
                    {{-- <h4 class="font-medium text-lg">Cetak Sesuai Tanggal</h4>
                    <div class="flex gap-4 items-center">
                        <div class="flex gap-1 items-center">
                            <span>Dari</span>
                            <input type="date" class="bg-gray-950 py-2 px-3 rounded-md" style="color-scheme: dark"
                                name="fromDate">
                        </div>
                        <div class="flex gap-1 items-center">
                            <span>Hingga</span>
                            <input type="date" class="bg-gray-950 py-2 px-3 rounded-md" style="color-scheme: dark"
                                name="endDate">
                        </div>
                    </div> --}}
                </div>
                <div class="flex flex-col gap-2 text-white" id="">
                    <label for="notReturn" class="font-medium text-lg">Cetak yang belum dikembalikan juga?</label>
                    <select name="notReturn" id="notReturn" class="bg-gray-950 py-2 px-3 rounded-md">
                        <option value="1" {{ '1' == old('notReturn') ? 'selected' : '' }}>Iya
                        </option>
                        <option value="0" {{ '0' == old('notReturn') ? 'selected' : '' }}>
                            Tidak</option>
                        <option value="2" {{ '2' == old('notReturn') ? 'selected' : '' }}>
                            Hanya Cetak Yang Belum Dikembalikan</option>
                    </select>
                    @error('notReturn')
                        <p class="text-red-500 px-3 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <x-button text="Cetak" />
            </form>

        </section>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#printMode").change(function(e) {
                e.preventDefault();
                let content;
                if (e.target.value == "sebagian") {
                    content = `<h4 class="font-medium text-lg">Cetak Sesuai Tanggal</h4>
                    <div class="flex gap-4 items-center">
                        <div class="flex gap-1 items-center">
                            <span>Dari</span>
                            <input type="date" class="bg-gray-950 py-2 px-3 rounded-md" style="color-scheme: dark"
                                name="fromDate">
                        </div>
                        <div class="flex gap-1 items-center">
                            <span>Hingga</span>
                            <input type="date" class="bg-gray-950 py-2 px-3 rounded-md" style="color-scheme: dark"
                                name="endDate">
                        </div>
                    </div>`;
                } else {
                    content = "";
                }
                $("#dateContainer").html(content);
            });
        });
    </script>
@endsection
