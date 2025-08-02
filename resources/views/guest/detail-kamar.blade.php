<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIOP-Kamar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('dist/assets/img/logo-yana.png') }}">
</head>

<body>
    @include('guest.layouts.navbar')

    <main class="container mx-auto">
        <!-- detail paket -->
        <section id="detail-paket" class="mt-32">
            <p class="text-center text-2xl font-bold text-slate-700">DETAIL KAMAR PENGINAPAN</p>

            <div class="grid grid-cols-1 mt-10 justify-items-center gap-5">
                <div class="w-full">
                    <div class="bg-white rounded-xl h-full flex flex-col" target="blank" data-aos="fade-up"
                        data-aos-duration="1000">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mx-5 md:mx-0">
                            <div class="grid grid-cols-4 gap-2">
                                <!-- Gambar utama -->
                                <div class="col-span-4">
                                    <a href="{{ asset('dist/assets/img/kamar/' . App\Helpers\GlobalFunction::pemisahKoma($kamar->image)) }}"
                                        target="blank">
                                        <img id="mainImage"
                                            src="{{ asset('dist/assets/img/kamar/' . App\Helpers\GlobalFunction::pemisahKoma($kamar->image)) }}"
                                            alt="" class="object-cover shadow-lg rounded-xl h-[400px] w-full" />
                                    </a>
                                </div>

                                <!-- Gambar kecil -->
                                @foreach (explode(',', $kamar->image) as $listImage)
                                    <img src="{{ asset('dist/assets/img/kamar/' . trim($listImage)) }}" alt=""
                                        class="thumbnail object-cover shadow-lg rounded-xl h-[100px] w-full" />
                                @endforeach
                            </div>
                            <div class="place-self-center">
                                <p class="text-2xl font-bold text-slate-700 my-2">
                                    {{ $kamar->nomor_kamar ?? '' }}
                                </p>
                                <table class="text-sm desc my-5">
                                    <tr>
                                        <td>Nama Penginapan</td>
                                        <td class="px-3">:</td>
                                        <td>{{ $kamar->rPenginapan?->nama_penginapan ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Owner</td>
                                        <td class="px-3">:</td>
                                        <td>{{ $kamar->rPenginapan->rPemilik?->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Harga Kamar</td>
                                        <td class="px-3">:</td>
                                        <td>Rp. {{ App\Helpers\GlobalFunction::formatMoney($kamar->harga) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kapasitas Kamar</td>
                                        <td class="px-3">:</td>
                                        <td>{{ $kamar->kapasitas_kamar.' Orang' ?? '' }}</td>
                                    </tr>
                                </table>
                                <p class="text-sm desc my-2">
                                    {{ $kamar->deskripsi ?? '' }}
                                </p>
                                <div class="my-6">
                                    <a href="{{ App\Helpers\GlobalFunction::urlPemesanan($kamar->rPenginapan->rPemilik->no_hp, $kamar->nomor_kamar, $kamar->id) }}"
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
            <p class="text-center text-2xl font-bold text-slate-700">KAMAR LAINNYA</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 mt-5 justify-items-center gap-5">
                @foreach ($kamarRandom as $random)
                    <a href="{{ route('detail-kamar', $random->id) }}"
                        class="w-full max-w-lg block no-underline text-inherit">
                        <div class="bg-white rounded-xl hover:shadow-xl h-full flex flex-col" data-aos="fade-up"
                            data-aos-duration="1000">
                            <div class="p-5 overflow-hidden rounded-xl flex-grow">
                                <img src="{{ asset('dist/assets/img/kamar/' . App\Helpers\GlobalFunction::pemisahKoma($random->image) ?? '') }}"
                                    alt="" class="object-cover shadow-lg rounded-xl h-[180px] w-full" />
                                <div class="flex justify-between">
                                    <p class="text-xl font-bold text-slate-700 my-2">
                                        {{ $random->nomor_kamar ?? '' }}
                                    </p>
                                    <p class="text-sm desc my-3 text-violet-800">
                                        Kamar
                                    </p>
                                </div>
                                <p class="text-sm desc my-2">
                                    {{ $random->deskripsi ?? '' }}
                                </p>
                                <div class="flex justify-end items-center">
                                    <p class="text-orange-500 text-lg">Rp.
                                        {{ App\Helpers\GlobalFunction::formatMoney($random->harga) }} / Malam</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </main>

    @include('guest.layouts.footer')

    @include('guest.layouts.jsfoot')

    <script>
        // Dapatkan elemen gambar utama
        const mainImage = document.getElementById("mainImage");

        // Dapatkan semua gambar kecil
        const thumbnails = document.querySelectorAll(".thumbnail");

        // Tambahkan event listener untuk setiap thumbnail
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener("click", () => {
                // Ubah sumber gambar utama sesuai dengan thumbnail yang diklik
                mainImage.src = thumbnail.src;
                // Ubah link pada gambar utama
                mainImage.parentElement.href = thumbnail.src;
            });
        });
    </script>
</body>

</html>
