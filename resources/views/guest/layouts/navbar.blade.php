{{-- Navbar --}}
<nav class="bg-gradient-to-r from-green-500 to-green-300 fixed w-full z-20 top-0 start-0">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('dist/assets/img/logo-yana.png') }}" class="h-8" alt="logo">
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">SIOP</span>
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <a href="{{ route('login') }}" type="button"
                class="focus:outline-none text-white bg-[#fa9f59] hover:bg-orange-600 focus:ring-4 focus:ring-orange-500 font-medium rounded-xl text-sm px-5 py-2.5">
                Login
            </a>
            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul
                class="flex flex-col p-4 md:p-0 mt-4 font-medium  md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                {{-- <li>
                    <a href="{{ route('index') }}"
                        class="block py-2 px-3 text-slate-900 rounded md:bg-transparent hover:text-white md:p-0 {{ Route::currentRouteName() == 'index' ? 'text-white' : '' }}"
                        aria-current="page">Home</a>
                </li> --}}
                {{-- <li>
                    <a href="{{ route('index') }}"
                        class="block py-2 px-3 text-slate-900 rounded md:hover:text-white md:p-0 {{ $page == 'Home' ? 'text-white' : '' }}">Daftar
                        Objek Pariwisata</a>
                </li>
                <li>
                    <a href="{{ route('penginapan') }}"
                        class="block py-2 px-3 text-slate-900 rounded md:hover:text-white md:p-0 {{ $page == 'Penginapan' ? 'text-white' : '' }}">Daftar
                        Penginapan</a>
                </li>
                <li>
                    <a href="{{ route('paket') }}"
                        class="block py-2 px-3 text-slate-900 rounded md:hover:text-white md:p-0 {{ $page == 'Paket Tour' ? 'text-white' : '' }}">Daftar
                        Paket Tour</a>
                </li>
                <li>
                    <a href="{{ route('rekomendasi') }}"
                        class="block py-2 px-3 text-slate-900 rounded md:hover:text-white md:p-0 {{ $page == 'Rekomendasi' ? 'text-white' : '' }}">Rekomendasi
                        Penginapan</a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
