<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIOP-Penginapan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('dist/assets/img/logo-yana.png') }}">
</head>

<body>
    @include('guest.layouts.navbar')

    <main class="container mx-auto">
        <!-- detail penginapan -->
        <section id="detail-penginapan" class="mt-32">
            <p class="text-center text-2xl font-bold text-slate-700">DETAIL PENGINAPAN</p>

            <div class="grid grid-cols-2 mt-5 justify-items-center gap-5">
                <div class="w-full">
                    <div class="bg-white rounded-xl h-full flex flex-col" target="blank" data-aos="fade-up"
                        data-aos-duration="1000">
                        <div class="p-5 overflow-hidden rounded-xl flex-grow">
                            <img src="{{ asset('dist/assets/img/penginapan/' . $penginapan->image ?? '') }}"
                                alt="" class="object-cover shadow-lg rounded-xl h-[400px] w-full" />
                        </div>
                    </div>
                </div>
                <div class="w-full py-5">
                    <div class="flex justify-between">
                        <p class="text-xl font-bold text-slate-700 my-2">
                            {{ $penginapan->nama_penginapan ?? '' }}
                        </p>
                        {{-- <p class="text-end my-2 text-orange-500 text-lg">Rp. 50.000 / orang</p> --}}
                    </div>
                    <p class="text-sm desc my-2">
                        {{ $penginapan->deskripsi ?? '' }}
                    </p>

                    <p class="mt-2">
                    <table>
                        {{-- <tr class="text-sm desc">
                            <td>Kontak</td>
                            <td class="px-3">:</td>
                            <td>{{ $penginapan->rPemilik?->no_hp ?? '' }}</td>
                        </tr> --}}
                        <tr class="text-sm desc">
                            <td>Lokasi</td>
                            <td class="px-3">:</td>
                            <td>{{ $penginapan->rLokasi?->nama_lokasi ?? '' }}</td>
                        </tr>
                        <tr class="text-sm desc">
                            <td>Maps</td>
                            <td class="px-3">:</td>
                            <td>
                                <a href="{{ $penginapan->maps ?? '' }}" target="_blank"
                                    class="text-sky-500 hover:underline hover:text-violet-500">Maps
                                    {{ $penginapan->nama_penginapan ?? '' }}</a>
                            </td>
                        </tr>
                        <tr class="text-sm desc">
                            <td>Jenis Penginapan</td>
                            <td class="px-3">:</td>
                            <td>{{ $penginapan->jenis_penginapan ?? '' }}</td>
                        </tr>
                        <tr class="text-sm desc">
                            <td>Wahana Permainan</td>
                            <td class="px-3">:</td>
                            <td>{{ $penginapan->wahana ?? '' }}</td>
                        </tr>
                        <tr class="text-sm desc">
                            <td>Fun Games dan Outbound</td>
                            <td class="px-3">:</td>
                            <td>{{ $penginapan->outbound ?? '' }}</td>
                        </tr>
                        <tr class="text-sm desc">
                            <td>Kafe / Restoran </td>
                            <td class="px-3">:</td>
                            <td>{{ $penginapan->kafe ?? '' }}</td>
                        </tr>
                        @if ($penginapan->medsos)
                            <tr class="text-sm desc">
                                <td>Instagram</td>
                                <td class="px-3">:</td>
                                <td class="text-sky-500 hover:underline hover:text-violet-500">@<a
                                        href="{{ $penginapan->medsos ?? '#' }}"
                                        target="_blank">{{ explode('/', parse_url($penginapan->medsos, PHP_URL_PATH))[1] ?? '' }}</a>
                                </td>
                            </tr>
                        @endif
                    </table>
                    </p>
                </div>
            </div>
        </section>

        <!-- kamar -->
        <section id="kamar" class="my-20">
            <p class="text-center text-2xl font-bold text-slate-700">KAMAR YANG TERSEDIA DI PENGINAPAN INI</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 mt-5 justify-items-center gap-5">
                @foreach ($penginapan->rKamar as $item)
                    @if ($item->status == 'Kosong')
                        {{-- <a href="{{ route('detail-kamar') }}" class="border">
                            <div class="w-full max-w-lg">
                                <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" target="blank"
                                    data-aos="fade-up" data-aos-duration="1000">
                                    <div class="p-5 overflow-hidden rounded-xl flex-grow">
                                        <img src="{{ asset('dist/assets/img/kamar/' . $item->image ?? '') }}"
                                            alt="" class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                                        <div class="flex justify-between">
                                            <p class="text-xl font-bold text-slate-700 my-2">
                                                {{ $item->nomor_kamar ?? '' }}
                                            </p>
                                            <p class="text-sm desc my-3 text-violet-800">
                                                Kamar
                                            </p>
                                        </div>
                                        <p class="text-sm desc my-2">
                                            {{ $item->deskripsi ?? '' }}
                                        </p>
                                        <div class="flex justify-between items-center">
                                            <p class="text-orange-500 text-lg">Rp.
                                                {{ App\Helpers\GlobalFunction::formatMoney($item->harga) }} / Malam</p>
                                            <a href="{{ App\Helpers\GlobalFunction::urlPemesanan($penginapan->rPemilik?->no_hp, $item->nomor_kamar, $penginapan->id) }}"
                                                target="_blank" type="button"
                                                class="focus:outline-none text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-500 font-medium rounded-xl text-sm px-5 py-2.5">
                                                <div class="flex gap-2 items-center">
                                                    <img src="{{ asset('dist/assets/img/wa.svg') }}" alt=""
                                                        class="w-4 h-4">
                                                    <span>Pesan</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a> --}}
                        <a href="{{ route('detail-kamar', $item->id) }}"
                            class="w-full max-w-lg block no-underline text-inherit">
                            <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" data-aos="fade-up"
                                data-aos-duration="1000">
                                <div class="p-5 overflow-hidden rounded-xl flex-grow">
                                    <img src="{{ asset('dist/assets/img/kamar/' . App\Helpers\GlobalFunction::pemisahKoma($item->image) ?? '') }}"
                                        alt="" class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                                    <div class="flex justify-between">
                                        <p class="text-xl font-bold text-slate-700 my-2">
                                            {{ $item->nomor_kamar ?? '' }}
                                        </p>
                                        <p class="text-sm desc my-3 text-violet-800">
                                            Kapasitas Kamar : {{ $item->kapasitas_kamar . ' Orang' ?? '' }}
                                        </p>
                                    </div>
                                    <p class="text-sm desc my-2">
                                        {{ $item->deskripsi ?? '' }}
                                    </p>
                                    <div class="flex justify-end items-center">
                                        <p class="text-orange-500 text-lg">Rp.
                                            {{ App\Helpers\GlobalFunction::formatMoney($item->harga) }} / Malam</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>

        </section>
    </main>

    @include('guest.layouts.footer')

    @include('guest.layouts.jsfoot')
</body>

</html>
