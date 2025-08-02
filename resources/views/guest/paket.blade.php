<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIOP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('dist/assets/img/logo-yana.png') }}">
</head>

<body>
    <div class="h-full bg-gradient-to-r from-violet-500 to-violet-300 shadow-xl">
        {{-- Navbar --}}
        @include('guest.Layouts.navbar')

        {{-- Home --}}
        @include('guest.layouts.banner')
    </div>

    <main class="container mx-auto mb-20">
        <!-- paket -->
        <section id="paket" class="my-20">

            <p class="text-center text-2xl font-bold text-slate-700 mb-5">DAFTAR PAKET TOUR WISATA</p>

            {{-- search --}}
            @include('guest.layouts.search',['urlSearch' => route('search-paket')])

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 mt-12 justify-items-center gap-5">
                @foreach ($paketTour as $tour)
                    <a href="{{ route('detail-paket', $tour->id) }}" class="w-full max-w-lg">
                        <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank"
                            data-aos="fade-up" data-aos-duration="1000">
                            <div class="p-5 overflow-hidden rounded-xl flex-grow">
                                <img src="{{ asset('dist/assets/img/paket-tour/' . $tour->image ?? '') }}"
                                    alt="" class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                                <p class="text-xl font-bold text-slate-700 my-2 text-center">
                                    {{ $tour->nama_paket ?? '' }}
                                </p>
                                <p class="text-orange-500 text-md my-2 text-center">
                                    Rp. {{ App\Helpers\GlobalFunction::formatMoney($tour->harga ?? 0) }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="text-center">
                {{ $paketTour->links() }}
            </div>
        </section>
    </main>

    @include('guest.layouts.footer')

    @include('guest.layouts.jsfoot')
</body>

</html>
