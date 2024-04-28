<nav id="header" class="bg-gray-900 fixed w-full z-10 top-0 shadow">

    <div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-0">

        <div class="w-1/2 pl-2 md:pl-0">
            <a class="text-gray-100 text-base xl:text-xl no-underline hover:no-underline font-bold flex gap-1 items-center"
                href="#">
                <img src="{{ asset('img/logo65.png') }}" alt="" class="w-[32px] h-[32px]">
                <span class="uppercase">Dashboard Perpus</span>
            </a>
        </div>
        <div class="w-1/2 pr-0">
            <div class="flex relative inline-block float-right">

                <div class="relative text-sm text-gray-100">
                    <button id="userButton" class="flex items-center focus:outline-none mr-3">
                        <img class="w-8 h-8 rounded-full mr-4" src="{{ asset('img/pp blank.webp') }}"
                            alt="Avatar of User">
                        <span
                            class="hidden md:inline-block text-gray-100">{{ auth()->guard('admin')->user()->f_nama }}</span>
                        <svg class="pl-2 h-2 fill-current text-gray-100" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129"
                            xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                            <g>
                                <path
                                    d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z" />
                            </g>
                        </svg>
                    </button>
                    <div id="userMenu"
                        class="bg-gray-900 rounded shadow-md mt-2 absolute mt-12 top-8 right-0 min-w-full overflow-auto z-30 invisible">
                        <ul class="list-reset">
                            <li><a href="/logout"
                                    class="px-4 py-2 block text-gray-100 hover:bg-gray-800 no-underline hover:no-underline">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="block lg:hidden pr-4">
                    <button id="nav-toggle"
                        class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-100 hover:border-teal-500 appearance-none focus:outline-none">
                        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>Menu</title>
                            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>

        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-gray-900 z-20"
            id="nav-content">
            <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
                <x-navbar-dashboard-item href="/dashboard" label="Dashboard" color="blue-400" active="dashboard"
                    icon="fa-solid fa-house" />
                <x-navbar-dashboard-item href="/dashboard/borrows" label="Peminjaman" color="red-400"
                    active="dashboard/borrows*" icon="fa-solid fa-right-from-bracket" />
                <x-navbar-dashboard-item href="/dashboard/returns" label="Pengembalian" color="teal-400"
                    active="dashboard/returns*" icon="fa-solid fa-right-to-bracket" />
                @can('isAdmin')
                    <x-navbar-dashboard-item href="/dashboard/categories" label="Kategori" color="amber-500"
                        active="dashboard/categories*" icon="fa-solid fa-list" />
                    <x-navbar-dashboard-item href="/dashboard/books" label="Buku" color="pink-400"
                        active="dashboard/books*" icon="fa-solid fa-book" />
                    <x-navbar-dashboard-item href="/dashboard/members" label="Anggota" color="purple-400"
                        active="dashboard/members*" icon="fa-solid fa-users" />
                    <x-navbar-dashboard-item href="/dashboard/librarians" label="Admin & Pustakawan" color="green-400"
                        active="dashboard/librarians*" icon="fa-solid fa-user" />
                @endcan
                <x-navbar-dashboard-item href="/dashboard/reports" label="Laporan" color="yellow-500"
                    active="dashboard/reports*" icon="fa-solid fa-scroll" />
            </ul>

            {{-- <div
                class="hidden text-blue-400 border-blue-400 text-amber-500 border-amber-500 text-pink-400 border-pink-400 text-purple-400 border-purple-400 text-green-400 border-green-400 border-yellow-500 text-yellow-500 border-red-400 text-red-400 text-teal-400 border-teal-400">
            </div> --}}
        </div>

    </div>
</nav>
