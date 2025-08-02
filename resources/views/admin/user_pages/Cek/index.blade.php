@extends('admin.app')

@section('title', 'Cek Kelulusan')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col col-12 col-lg-6 mx-auto float-none">

                {{-- ✅ Kartu Jurusan --}}
                @if ($showJurusan)
                    <div class="card border-success mb-4">
                        @if ($siswa->rPendaftaran->jurusanDiterima)
                            <div class="card-header bg-success text-white fw-bold text-center">
                                SELAMAT! ANDA DINYATAKAN LULUS
                            </div>
                        @else
                            <div class="card-header bg-danger text-white fw-bold text-center">
                                ANDA BELUM DINYATAKAN LULUS
                            </div>
                        @endif
                        <div class="card-body text-dark">
                            @if ($siswa->rPendaftaran->jurusanDiterima)
                                <p class="text-center">
                                    Anda diterima di jurusan:
                                    <span class="fw-bold text-success">
                                        {{ $siswa->rPendaftaran->jurusanDiterima->jurusan ?? '-' }}
                                    </span>
                                </p>
                            @else
                                <p class="text-center">
                                    Maaf Anda belum diterima di jurusan apapun.
                                </p>
                            @endif
                            <hr>
                            <p class="text-muted text-sm">
                                Silakan cetak bukti kelulusan ini dan ikuti proses daftar ulang sesuai informasi dari panitia.
                            </p>
                            <a href="{{ route('siswaCekLulus.print') }}" target="_blank" class="btn btn-success w-100 mt-2">Cetak Bukti</a>
                        </div>

                        <div class="card mt-2">
                            <div class="card-body">
                                <div class="d-flex flex-col justify-content-between gap-5 text-dark">
                                    <div class="">
                                        <img src="{{ asset('dist/assets/img/logo-yana.png') }}" alt="" class="img-fluid" style="max-width: 100px">
                                    </div>
                                    <div class="text-center">KARTU PENDAFTARAN <br> PMB ONLINE PROVINSI RIAU <br> TAHUN AJARAN 2025/2026</div>
                                    <div class="">
                                        <img src="{{ asset('dist/assets/img/logo-yana.png') }}" alt="" class="img-fluid" style="max-width: 100px">
                                    </div>
                                </div>
                                <div class="border border-dark p-3 mt-3">
                                    <div class="row">
                                        <div class="col col-8 text-dark">
                                            <table>
                                                <tr><td>No Pendaftaran</td><td class="px-2">:</td><td>{{ $siswa->rPendaftaran->no_daftar ?? '-' }}</td></tr>
                                                <tr><td>Nama Peserta</td><td class="px-2">:</td><td>{{ $siswa->name ?? '-' }}</td></tr>
                                                <tr><td>Tempat Lahir</td><td class="px-2">:</td><td>{{ $siswa->rPendaftaran->tempat_lahir ?? '-' }}</td></tr>
                                                <tr><td>Tanggal Lahir</td><td class="px-2">:</td>
                                                    <td>
                                                        {{ $siswa->rPendaftaran->tanggal_lahir
                                                            ? \Carbon\Carbon::parse($siswa->rPendaftaran->tanggal_lahir)->translatedFormat('d F Y')
                                                            : '-' }}
                                                    </td>
                                                </tr>
                                                <tr><td>NISN</td><td class="px-2">:</td><td>{{ $siswa->rPendaftaran->nisn ?? '-' }}</td></tr>
                                                <tr><td>NIK</td><td class="px-2">:</td><td>{{ $siswa->rPendaftaran->nik ?? '-' }}</td></tr>
                                                <tr><td>Asal Sekolah</td><td class="px-2">:</td><td>{{ $siswa->rPendaftaran->asal_sekolah ?? '-' }}</td></tr>
                                            </table>
                                        </div>
                                        <div class="col col-4">
                                            @if ($siswa->rPendaftaran && $siswa->rPendaftaran->foto)
                                                <img src="{{ asset('storage/' . $siswa->rPendaftaran->foto) }}" alt="Foto" class="img-fluid">
                                            @else
                                                <img src="{{ asset('dist/assets/img/marie.jpg') }}" alt="" class="img-fluid">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <table class="table mt-3 text-sm text-center border">
                                    <tr class="bg-info text-white fw-bold">
                                        <td>Tanggal Pendaftaran</td>
                                        <td>Jurusan Pilihan 1</td>
                                        <td>Jurusan Pilihan 2</td>
                                        <td>Status Verifikasi Berkas</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>
                                            {{ $siswa->rPendaftaran->created_at
                                                ? \Carbon\Carbon::parse($siswa->rPendaftaran->created_at)->translatedFormat('d F Y, H:i')
                                                : '-' }}
                                        </td>
                                        <td>{{ $siswa->rPendaftaran->jurusanPilihan1->jurusan ?? '-' }}</td>
                                        <td>{{ $siswa->rPendaftaran->jurusanPilihan2->jurusan ?? '-' }}</td>
                                        <td class="text-capitalize">
                                            @if ($siswa->rPendaftaran->status_verifikasi == 'tolak')
                                                Tidak Lolos
                                            @else
                                                {{ $siswa->rPendaftaran->status_verifikasi ?? '-' }}
                                            @endif
                                        </td>
                                    </tr>
                                </table>

                                <div class="border border-dark p-3 mt-3 text-dark">
                                    <div class="">Jurusan Diterima : <span class="fw-bold">
                                        @if ($siswa->rPendaftaran->status_verifikasi == 'tolak')
                                            Tidak Lolos
                                        @else
                                            {{ $siswa->rPendaftaran->jurusanDiterima->jurusan ?? 'Tidak Lolos' }}
                                        @endif</span></div>
                                </div>

                                <div class="border border-dark p-3 mt-3 text-dark">
                                    <p class="fw-bold">INFORMASI PENTING</p>
                                    <ol>
                                        <li>Kartu Pendaftaran ini wajib dibawa dan ditunjukkan saat pelaksanaan pendaftaran ulang di sekolah pilihan</li>
                                        <li>Membawa kartu/bukti identitas diri asli</li>
                                        <li>Membawa seluruh dokumen asli yang diupload</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                {{-- ✅ Kartu Verifikasi Berkas --}}
                @elseif ($showBerkas)
                <div class="d-flex justify-content-end">
                    <a href="{{ route('siswaCekLulus.print') }}" target="_blank" class="btn btn-sm btn-primary">Cetak Kartu</a>
                </div>
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="d-flex flex-col justify-content-between gap-5 text-dark">
                                <div class="">
                                    <img src="{{ asset('dist/assets/img/logo-yana.png') }}" alt="" class="img-fluid" style="max-width: 100px">
                                </div>
                                <div class="text-center">KARTU PENDAFTARAN <br> PMB ONLINE PROVINSI RIAU <br> TAHUN AJARAN 2025/2026</div>
                                <div class="">
                                    <img src="{{ asset('dist/assets/img/logo-yana.png') }}" alt="" class="img-fluid" style="max-width: 100px">
                                </div>
                            </div>
                            <div class="border border-dark p-3 mt-3">
                                <div class="row">
                                    <div class="col col-8 text-dark">
                                        <table>
                                            <tr><td>No Pendaftaran</td><td class="px-2">:</td><td>{{ $siswa->rPendaftaran->no_daftar ?? '-' }}</td></tr>
                                            <tr><td>Nama Peserta</td><td class="px-2">:</td><td>{{ $siswa->name ?? '-' }}</td></tr>
                                            <tr><td>Tempat Lahir</td><td class="px-2">:</td><td>{{ $siswa->rPendaftaran->tempat_lahir ?? '-' }}</td></tr>
                                            <tr><td>Tanggal Lahir</td><td class="px-2">:</td>
                                                <td>
                                                    {{ $siswa->rPendaftaran->tanggal_lahir
                                                        ? \Carbon\Carbon::parse($siswa->rPendaftaran->tanggal_lahir)->translatedFormat('d F Y')
                                                        : '-' }}
                                                </td>
                                            </tr>
                                            <tr><td>NISN</td><td class="px-2">:</td><td>{{ $siswa->rPendaftaran->nisn ?? '-' }}</td></tr>
                                            <tr><td>NIK</td><td class="px-2">:</td><td>{{ $siswa->rPendaftaran->nik ?? '-' }}</td></tr>
                                            <tr><td>Asal Sekolah</td><td class="px-2">:</td><td>{{ $siswa->rPendaftaran->asal_sekolah ?? '-' }}</td></tr>
                                        </table>
                                    </div>
                                    <div class="col col-4">
                                        @if ($siswa->rPendaftaran && $siswa->rPendaftaran->foto)
                                            <img src="{{ asset('storage/' . $siswa->rPendaftaran->foto) }}" alt="Foto" class="img-fluid">
                                        @else
                                            <img src="{{ asset('dist/assets/img/marie.jpg') }}" alt="" class="img-fluid">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <table class="table mt-3 text-sm text-center border">
                                <tr class="bg-info text-white fw-bold">
                                    <td>Tanggal Pendaftaran</td>
                                    <td>Jurusan Pilihan 1</td>
                                    <td>Jurusan Pilihan 2</td>
                                    <td>Status Verifikasi Berkas</td>
                                </tr>
                                <tr class="text-dark">
                                    <td>
                                        {{ $siswa->rPendaftaran->created_at
                                            ? \Carbon\Carbon::parse($siswa->rPendaftaran->created_at)->translatedFormat('d F Y, H:i')
                                            : '-' }}
                                    </td>
                                    <td>{{ $siswa->rPendaftaran->jurusanPilihan1->jurusan ?? '-' }}</td>
                                    <td>{{ $siswa->rPendaftaran->jurusanPilihan2->jurusan ?? '-' }}</td>
                                    <td class="text-capitalize">
                                        @if ($siswa->rPendaftaran->status_verifikasi == 'tolak')
                                            Tidak Lolos
                                        @else
                                            {{ $siswa->rPendaftaran->status_verifikasi ?? '-' }}
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            <div class="border border-dark p-3 mt-3 text-dark">
                                <div class="">Jurusan Diterima : <span class="fw-bold">
                                    @if ($siswa->rPendaftaran->status_verifikasi == 'tolak')
                                        Tidak Lolos
                                    @else
                                        {{ $siswa->rPendaftaran->jurusanDiterima->jurusan ?? 'Belum Dipilih' }}
                                    @endif</span></div>
                            </div>

                            <div class="border border-dark p-3 mt-3 text-dark">
                                <p class="fw-bold">INFORMASI PENTING</p>
                                <ol>
                                    <li>Kartu Pendaftaran ini wajib dibawa dan ditunjukkan saat pelaksanaan pendaftaran ulang di sekolah pilihan</li>
                                    <li>Membawa kartu/bukti identitas diri asli</li>
                                    <li>Membawa seluruh dokumen asli yang diupload</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                {{-- ⛔ Belum waktunya tampil --}}
                @else
                    <div class="alert alert-success text-center text-light fw-bold">
                        Informasi pendaftaran belum tersedia. Silakan cek kembali sesuai jadwal pengumuman.
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
