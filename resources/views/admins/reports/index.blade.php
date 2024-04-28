@extends('admins.layouts.index')

@section('content')
    <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
        <section class="container px-4 mx-auto">
            <h2 class="text-lg font-medium text-white">Laporan</h2>

            <p class="mt-1 text-sm text-white">Laporan Riwayat Peminjaman Buku
            </p>
            <div class="w-full flex mt-2 items-center gap-2">
                <div class="flex items-center justify-start">
                    @if ($reports->isEmpty())
                        <a
                            class="bg-slate-500 text-white px-3 py-1 flex items-center justify-center rounded-md transition duration-150 hover:bg-slate-500 cursor-default">Cetak
                            Menjadi PDF</a>
                    @else
                        <a href="/dashboard/reports/printtopdf"
                            class="bg-red-600 text-white px-3 py-1 flex items-center justify-center rounded-md transition duration-150 hover:bg-red-700">Cetak
                            Menjadi PDF</a>
                    @endif
                </div>
                {{-- <div class="flex items-center justify-start">
                    <a href="/dashboard/reports/printtocsv"
                        class="bg-green-600 text-white px-3 py-1 flex items-center justify-center rounded-md transition duration-150 hover:bg-green-700">Cetak
                        Menjadi Excel</a>
                </div> --}}
            </div>

            <div class="flex flex-col mt-3">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        @if ($reports->isEmpty())
                            <div class="text-white text-center font-bold text-lg">Belum Ada Laporan</div>
                        @else
                            <div class="border border-gray-700 md:rounded-lg">

                                <table class="min-w-full divide-y divide-gray-700">
                                    <thead class="bg-gray-800">
                                        <tr>
                                            <th scope="col"
                                                class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-400">
                                                No
                                            </th>

                                            <th scope="col"
                                                class="py-4 px-4 text-sm font-normal text-left rtl:text-right text-gray-400">
                                                Buku
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                                Peminjam
                                            </th>

                                            <th scope="col"
                                                class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-400">
                                                Admin
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                                Tanggal Pinjam
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                                Tanggal Kembali</th>

                                            <th scope="col" class="relative py-3.5 px-4">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-900 divide-y divide-gray-700">
                                        @foreach ($reports as $report)
                                            <tr>
                                                <td class="px-3.5 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-white">{{ $loop->iteration }}</h2>
                                                    </div>
                                                </td>
                                                <td class="px-3.5 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-white">
                                                            {{ $report->detailPeminjaman->detailBook->book->f_judul }}</h2>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-white truncate">
                                                            {{ $report->member->f_nama }}
                                                        </h2>
                                                    </div>
                                                </td>
                                                <td class="px-3.5 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-white">{{ $report->admin->f_nama }}</h2>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-white">
                                                            {{ $report->f_tanggalpeminjaman }}
                                                        </h2>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-white">
                                                            {{ $report->detailPeminjaman->f_tanggalkembali ?? 'Belum Dikembalikan' }}
                                                        </h2>
                                                    </div>
                                                </td>
                                                {{-- <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                            <div>
                                                <h2 class="font-medium text-white">{{ $book->detail->f_status }}
                                                </h2>
                                            </div>
                                        </td> --}}
                                                {{-- <td class="px-4 py-4 text-sm font-medium whitespace-nowrap text-white">
                                                    <form action="/dashboard/books/{{ $book->f_id }}" method="POST"
                                                        class="flex items-center justify-start gap-3">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="/dashboard/books/{{ $book->f_id }}/edit"
                                                            class="bg-blue-600 px-2 py-1 rounded-md flex items-center justify-center transition duration-150 hover:bg-blue-700">Edit</a>
                                                        <button type="submit" href=""
                                                            class="bg-red-600 px-2 py-1 rounded-md flex items-center justify-center transition duration-150 hover:bg-red-700"
                                                            onclick="return confirm('Yakin ingin menghapus buku {{ $book->f_judul }}')">Delete</button>
                                                    </form>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection

@section('script')
    @if (session()->has('notify'))
        <script>
            alert('{{ session('notify') }}');
        </script>
    @endif
@endsection
