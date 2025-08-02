<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIOP-Paket Tour</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('dist/assets/img/logo-yana.png') }}">
</head>

<body>
    @include('guest.layouts.navbar')

    <main class="container mx-auto">
        <!-- detail paket -->
        <section id="detail-paket" class="mt-32">
            <p class="text-center text-2xl font-bold text-slate-700">DETAIL PAKET TOUR</p>

            <div class="grid grid-cols-1 mt-10 justify-items-center gap-5">
                <div class="w-full">
                    <div class="bg-white rounded-xl h-full flex flex-col" target="blank" data-aos="fade-up"
                        data-aos-duration="1000">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <a href="{{ asset('dist/assets/img/paket-tour/' . $paketTour->image ?? '') }}"
                                target="blank">
                                <img src="{{ asset('dist/assets/img/paket-tour/' . $paketTour->image ?? '') }}"
                                    alt="" class="object-cover shadow-lg rounded-xl h-[400px] w-full" />
                            </a>
                            <div class="place-self-center">
                                <p class="text-2xl font-bold text-slate-700 my-2">
                                    {{ $paketTour->nama_paket ?? '' }}
                                </p>
                                <table class="text-sm desc my-5">
                                    <tr>
                                        <td>Nama Objek Pariwisata</td>
                                        <td class="px-3">:</td>
                                        <td>{{ $paketTour->rObjekWisata?->nama_wisata ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Penginapan</td>
                                        <td class="px-3">:</td>
                                        <td>{{ $paketTour->rPenginapan?->nama_penginapan ?? '' }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td>Kontak</td>
                                        <td class="px-3">:</td>
                                        <td>{{ $paketTour->rPemilik?->no_hp ?? '' }}</td>
                                    </tr> --}}
                                    <tr>
                                        <td>Harga Paket</td>
                                        <td class="px-3">:</td>
                                        <td>Rp. {{ App\Helpers\GlobalFunction::formatMoney($paketTour->harga ?? '') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Item</td>
                                        <td class="px-3">:</td>
                                        <td>
                                            @if ($paketTour->rItemTambahan && $paketTour->rItemTambahan->count() > 0)
                                                @foreach ($paketTour->rItemTambahan as $itemTambahan)
                                                    {{ $itemTambahan->nama_item ?? '' }}
                                                @endforeach
                                            @else
                                                <p>Tidak ada</p>
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($paketTour->medsos)
                                        <tr>
                                            <td>Medsos (Instagram)</td>
                                            <td class="px-3">:</td>
                                            <td class="text-sky-500 hover:underline hover:text-violet-500">
                                                @<a
                                                    href="{{ $paketTour->medsos ?? '#' }}">{{ explode('/', parse_url($paketTour->medsos, PHP_URL_PATH))[1] ?? '' }}</a>
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                                <p class="text-sm desc my-2">
                                    {{-- untuk item lu jabarin dalam bentuk paragraf aja cok --}}
                                    {{ $paketTour->deskripsi ?? '' }}
                                </p>

                                <div class="my-6">
                                    <a href="{{ App\Helpers\GlobalFunction::urlPemesanan($paketTour->rPemilik?->no_hp, $paketTour->nama_paket, $paketTour->id) }}"
                                        target="_blank" type="button"
                                        class="focus:outline-none text-white bg-green-500 hover:bg-green-600  font-medium rounded-xl text-sm px-5 py-2.5">
                                        Pesan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- paket -->
        <section id="paket" class="my-20">
            <p class="text-center text-2xl font-bold text-slate-700">PAKET TOUR LAINNYA</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 mt-5 justify-items-center gap-5">
                @foreach ($paketTourRandom as $tourRandom)
                    <a href="{{ route('detail-paket', $tourRandom->id) }}" class="w-full max-w-lg">
                        <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank"
                            data-aos="fade-up" data-aos-duration="1000">
                            <div class="p-5 overflow-hidden rounded-xl flex-grow">
                                <img src="{{ asset('dist/assets/img/paket-tour/' . $tourRandom->image ?? '') }}"
                                    alt="" class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                                <p class="text-xl font-bold text-slate-700 my-2 text-center">
                                    {{ $tourRandom->nama_paket ?? '' }}
                                </p>
                                <p class="text-orange-500 text-md my-2 text-center">
                                    Rp. {{ App\Helpers\GlobalFunction::formatMoney($tourRandom->harga ?? 0) }}
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
