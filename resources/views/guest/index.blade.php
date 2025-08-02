<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('dist/assets/img/logo-yana.png') }}">
</head>

<body>
    <div class="h-full bg-gradient-to-r from-green-500 to-green-300 shadow-xl">
        {{-- Navbar --}}
        @include('guest.Layouts.navbar')

        {{-- Home --}}
        @include('guest.layouts.banner')
    </div>

    <main class="container mx-auto mb-20">
        <!-- pariwisata -->
        <section id="pariwisata" class="mt-20">

            <p class="text-center text-2xl font-bold text-slate-700 mb-5">DAFTAR OBJEK PARIWISATA</p>

            {{-- search --}}
            {{-- @include('guest.layouts.search',['urlSearch' => route('search-wisata')]) --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 mt-12 justify-items-center gap-5">
                {{-- @foreach ($objekWisata as $wisata)
                    <a href="{{ route('detail-wisata', $wisata->id) }}" class="w-full max-w-lg">
                        <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank"
                            data-aos="fade-up" data-aos-duration="1000">
                            <div class="p-5 overflow-hidden rounded-xl flex-grow">
                                <img src="{{ asset('dist/assets/img/objek-wisata/' . $wisata->image ?? '') }}"
                                    alt="" class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                                <div class="flex justify-between">
                                    <p class="text-xl font-bold text-slate-700 my-2">
                                        {{ $wisata->nama_wisata ?? '' }}
                                    </p>
                                    <p class="text-sm desc my-3 text-violet-800">
                                        {{ $wisata->rKategori?->kategori ?? '' }}
                                    </p>
                                </div>
                                <p class="text-default-500 text-small">
                                    {{ Str::limit($wisata->deskripsi ?? '', 50, '...') }}
                                </p>
                                <p class="text-end mt-3 text-orange-500 text-lg">Rp.
                                    {{ App\Helpers\GlobalFunction::formatMoney($wisata->harga ?? 0) }} / orang</p>
                            </div>
                        </div>
                    </a>
                @endforeach --}}
            </div>
            <div class="text-center">
                {{-- {{ $objekWisata->links() }} --}}
            </div>

        </section>
    </main>

    @include('guest.layouts.footer')

    @include('guest.layouts.jsfoot')
</body>

</html>
