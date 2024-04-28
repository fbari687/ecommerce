@extends('admins.layouts.index')

@section('content')
    <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
        <section class="container px-4 mx-auto">
            <h2 class="text-lg font-medium text-white">Admin & Pustakawan</h2>

            <p class="mt-1 text-sm text-gray-300">Kumpulan Admin & Pustakawan yang terdaftar di
                Perpustakaan ini
            </p>

            <div class="w-full mt-1 flex items-center justify-end">
                <a href="/dashboard/librarians/create"
                    class="bg-green-600 text-white px-3 py-1 flex items-center justify-center rounded-md transition duration-150 hover:bg-green-700">Tambah
                    Admin/Pustakawan</a>
            </div>

            <div class="flex flex-col mt-3">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="border border-gray-700 md:rounded-lg">

                            <table class="min-w-full divide-y divide-gray-700">
                                <thead class="bg-gray-800">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-400">
                                            No
                                        </th>

                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-400">
                                            Nama
                                        </th>

                                        <th scope="col"
                                            class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                            Username
                                        </th>

                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                            Level
                                        </th>

                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                            Status</th>

                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                            Action</th>

                                        <th scope="col" class="relative py-3.5 px-4">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-900 divide-y divide-gray-700">
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td class="px-3.5 py-4 text-sm font-medium whitespace-nowrap">
                                                <div>
                                                    <h2 class="font-medium text-white">{{ $loop->iteration }}</h2>
                                                </div>
                                            </td>
                                            <td class="px-3.5 py-4 text-sm font-medium whitespace-nowrap">
                                                <div>
                                                    <h2 class="font-medium text-white">{{ $admin->f_nama }}</h2>
                                                </div>
                                            </td>
                                            <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                                <div>
                                                    <h2 class="font-medium text-white">{{ $admin->f_username }}</h2>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                                <div>
                                                    <h2 class="font-medium text-white">{{ $admin->f_level }}
                                                    </h2>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                                <div>
                                                    <h2 class="font-medium text-white">{{ $admin->f_status }}
                                                    </h2>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 text-sm font-medium whitespace-nowrap text-white">
                                                <form action="/dashboard/librarians/{{ $admin->f_id }}" method="POST"
                                                    class="flex items-center justify-start gap-3">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="/dashboard/librarians/{{ $admin->f_id }}/edit"
                                                        class="bg-blue-600 px-2 py-1 rounded-md flex items-center justify-center transition duration-150 hover:bg-blue-700">Edit</a>
                                                    <a href="/dashboard/librarians/editpw/{{ $admin->f_id }}"
                                                        class="bg-amber-600 px-2 py-1 rounded-md flex items-center justify-center transition duration-150 hover:bg-amber-700">Edit
                                                        Password</a>
                                                    <button type="submit"
                                                        class="bg-red-600 px-2 py-1 rounded-md flex items-center justify-center transition duration-150 hover:bg-red-700"
                                                        onclick="return confirm('Yakin ingin Menghapus Admin/Pustakawan {{ $admin->f_nama }}?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
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
