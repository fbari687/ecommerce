<nav class="bg-semi-transparent lg:fixed z-[99] w-full px-8 md:px-auto">
    <div class="md:h-16 h-28 mx-auto md:px-4 container flex items-center justify-between flex-wrap md:flex-nowrap">
        <a href="/" class="flex items-center md:order-1">
            <img src="{{ asset('img/logo65.png') }}" alt="" class="h-14">
            <span class="text-white font-bold">Perpus 65</span>
        </a>
        <div class="text-gray-500 order-3 w-full md:w-auto md:order-2">
            <ul class="flex font-semibold justify-between">
                <li class="md:px-4 md:py-2 text-white transition duration-150 hover:text-teal-500"><a
                        href="/">Beranda</a></li>
                @if (Auth::guard('member')->check())
                    <li class="md:px-4 md:py-2 text-white transition duration-150 hover:text-teal-500"><a
                            href="/book">Buku</a></li>
                    <li class="md:px-4 md:py-2 text-white transition duration-150 hover:text-teal-500"><a
                            href="/history">Riwayat</a></li>
                @endif
            </ul>
        </div>
        <div class="order-2 md:order-3">
            @if (Auth::guard('member')->check())
                <div class="relative text-sm text-gray-100">
                    <button id="userButton" class="flex items-center focus:outline-none mr-3">
                        <img class="w-8 h-8 rounded-full mr-4" src="{{ asset('img/pp blank.webp') }}"
                            alt="Avatar of User">
                        <span class="hidden md:inline-block text-gray-100">{{ auth()->user()->f_nama }}</span>
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
            @else
                <a href="/login"
                    class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-gray-50 rounded-xl flex items-center gap-2">
                    <span>Login</span>
                </a>
            @endif
        </div>
    </div>
</nav>
