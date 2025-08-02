<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIOP-Pariwisata</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('dist/assets/img/logo-yana.png') }}">
</head>

<body>
    @include('guest.layouts.navbar')

    <main class="container mx-auto">
        <!-- detail pariwisata -->
        <section id="detail-pariwisata" class="mt-32">
            <p class="text-center text-2xl font-bold text-slate-700">DETAIL OBJEK PARIWISATA</p>

            <div class="grid grid-cols-1 mt-5 justify-items-center gap-5">
                <div class="w-full">
                    <div class="bg-white rounded-xl h-full flex flex-col" target="blank" data-aos="fade-up"
                        data-aos-duration="1000">
                        <div class="p-5 overflow-hidden rounded-xl flex-grow">
                            <img src="{{ asset('dist/assets/img/objek-wisata/' . $objekWisata->image) }}" alt=""
                                class="object-cover shadow-lg rounded-xl h-[400px] w-full" />
                            <div class="flex justify-between">
                                <p class="text-xl font-bold text-slate-700 my-2">
                                    {{ $objekWisata->nama_wisata ?? '' }}
                                </p>
                                <p class="text-end my-2 text-orange-500 text-lg">Rp.
                                    {{ \App\Helpers\GlobalFunction::formatMoney($objekWisata->harga) ?? '' }} / orang
                                </p>
                            </div>
                            <p class="text-sm desc my-2">
                                {{ $objekWisata->deskripsi }}
                            </p>
                            <p class="mt-2">
                            <table>
                                <tr class="text-sm desc">
                                    <td>Lokasi</td>
                                    <td class="px-3">:</td>
                                    <td>{{ $objekWisata->lokasi ?? '' }}</td>
                                </tr>
                                {{-- <tr class="text-sm desc text-violet-800">
                                    <td>Kontak</td>
                                    <td class="px-3">:</td>
                                    <td>{{ $objekWisata->no_hp ?? '' }}</td>
                                </tr> --}}
                                @if ($objekWisata->medsos)
                                    <tr class="text-sm desc">
                                        <td>Instagram</td>
                                        <td class="px-3">:</td>
                                        <td class="text-sky-500 hover:text-violet-500">@<a
                                                href="{{ $objekWisata->medsos ?? '#' }}">{{ explode('/', parse_url($objekWisata->medsos, PHP_URL_PATH))[1] ?? '' }}</a>
                                        </td>
                                    </tr>
                                @endif
                            </table>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- pariwisata -->
        <section id="pariwisata" class="my-20">
            <p class="text-center text-2xl font-bold text-slate-700">DAFTAR OBJEK PARIWISATA LAINNYA</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 mt-5 justify-items-center gap-5">
                @foreach ($objekWisataRandom as $wisataRandom)
                    <a href="{{ route('detail-wisata', $wisataRandom->id) }}" class="w-full max-w-lg">
                        <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank"
                            data-aos="fade-up" data-aos-duration="1000">
                            <div class="p-5 overflow-hidden rounded-xl flex-grow">
                                <img src="{{ asset('dist/assets/img/objek-wisata/' . $wisataRandom->image) }}"
                                    alt="" class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                                <div class="flex justify-between">
                                    <p class="text-xl font-bold text-slate-700 my-2">
                                        {{ $wisataRandom->nama_wisata ?? '' }}
                                    </p>
                                    <p class="text-sm desc my-3 text-violet-800">
                                        {{ $wisataRandom->rKategori?->kategori ?? '' }}
                                    </p>
                                </div>
                                <p class="text-sm desc my-2">
                                    {{ Str::limit($wisataRandom->deskripsi ?? '', 50, '...') }}
                                </p>
                                <p class="text-end mt-3 text-orange-500 text-lg">Rp.
                                    {{ \App\Helpers\GlobalFunction::formatMoney($wisataRandom->harga) ?? '' }} / orang
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </main>

    @include('guest.layouts.footer')

    @include('guest.layouts.jsfoot')
</body>

</html>
