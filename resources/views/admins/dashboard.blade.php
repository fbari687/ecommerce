@extends('admins.layouts.index')

@section('content')
    <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">

        <!--Console Content-->

        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                <!--Metric Card-->
                <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded p-3 bg-green-600"><i class="fa-solid fa-book text-white fa-xl"></i>
                            </div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h5 class="font-bold uppercase text-gray-400">Total Buku</h5>
                            <h3 class="font-bold text-3xl text-gray-600">{{ $bookCount }}</h3>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                <!--Metric Card-->
                <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded p-3 bg-pink-600"><i class="fa-solid fa-users text-white fa-xl"></i>
                            </div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h5 class="font-bold uppercase text-gray-400">Total Anggota</h5>
                            <h3 class="font-bold text-3xl text-gray-600">{{ $memberCount }}</h3>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                <!--Metric Card-->
                <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded p-3 bg-yellow-600"><i class="fa-solid fa-user-plus text-white fa-xl"></i>
                            </div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h5 class="font-bold uppercase text-gray-400">Total Admin & Pustakawan</h5>
                            <h3 class="font-bold text-3xl text-gray-600">{{ $librarianCount }}</h3>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>
        </div>

        <!--Divider-->
        {{-- <hr class="border-b-2 border-gray-600 my-8 mx-4"> --}}


        <!--/ Console Content-->

    </div>
@endsection
