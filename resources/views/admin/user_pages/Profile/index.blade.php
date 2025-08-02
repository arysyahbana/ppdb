@extends('admin.app')

@section('title', 'Profile')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>Profile</h6>
                <div class="row">
                    <div class="col col-12 col-lg-4">
                        @if ($user->rPendaftaran && $user->rPendaftaran->foto)
                            <img src="{{ asset('storage/' . $user->rPendaftaran->foto) }}" alt="Foto" class="img-fluid img-thumbnail">
                        @else
                            <img src="{{ asset('dist/assets/img/noprofile.png') }}" alt="" class="img-fluid img-thumbnail">
                        @endif

                    </div>
                    <div class="col col-12 col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body px-4 pt-4 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table table-striped mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="text-sm fw-bold" style="width: 150px;">No Daftar</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $user->rPendaftaran->no_daftar ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold" style="width: 150px;">Nama</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $user->name ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold" style="width: 150px;">NIK</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $user->rPendaftaran->nik ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold" style="width: 150px;">NISN</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $user->rPendaftaran->nisn ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold">Email</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $user->email ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold">Tempat/Tanggal Lahir</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $user->rPendaftaran->tempat_lahir ?? '-' }} / {{ $user->rPendaftaran->tanggal_lahir ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold">Jenis Kelamin</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $user->jenis_kelamin ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold">No HP</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $user->no_hp ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold">Alamat</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $user->alamat ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold">Asal Sekolah</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $user->rPendaftaran->asal_sekolah ?? '-' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-5 pt-4">
                            @if ($user->rPendaftaran && $user->rPendaftaran->ijazah)
                                <div class="d-flex flex-column mb-2 justify-content-center align-items-center">
                                    <img src="{{ asset('dist/assets/img/google-docs.png') }}" alt="" class="mb-2" style="height: 70px; width: 70px; object-fit: contain;">
                                    <span class="text-sm mb-1">Ijazah / SKHU</span>
                                    <a href="{{ asset('storage/' . $user->rPendaftaran->ijazah) }}" class="btn btn-sm btn-secondary text-xs" target="_blank">Lihat</a>
                                </div>
                            @else
                            @endif
                            @if ($user->rPendaftaran && $user->rPendaftaran->kk)
                                <div class="d-flex flex-column mb-2 justify-content-center align-items-center">
                                    <img src="{{ asset('dist/assets/img/google-docs.png') }}" alt="" class="mb-2" style="height: 70px; width: 70px; object-fit: contain;">
                                    <span class="text-sm mb-1">Kartu Keluarga</span>
                                    <a href="{{ asset('storage/' . $user->rPendaftaran->kk) }}" class="btn btn-sm btn-secondary text-xs" target="_blank">Lihat</a>
                                </div>
                            @else
                            @endif
                            @if ($user->rPendaftaran && $user->rPendaftaran->ktp_ortu)
                                <div class="d-flex flex-column mb-2 justify-content-center align-items-center">
                                    <img src="{{ asset('dist/assets/img/google-docs.png') }}" alt="" class="mb-2" style="height: 70px; width: 70px; object-fit: contain;">
                                    <span class="text-sm mb-1">KTP Orang Tua</span>
                                    <a href="{{ asset('storage/' . $user->rPendaftaran->ktp_ortu) }}" class="btn btn-sm btn-secondary text-xs" target="_blank">Lihat</a>
                                </div>
                            @else
                            @endif
                            @if ($user->rPendaftaran && $user->rPendaftaran->akte)
                                <div class="d-flex flex-column mb-2 justify-content-center align-items-center">
                                    <img src="{{ asset('dist/assets/img/google-docs.png') }}" alt="" class="mb-2" style="height: 70px; width: 70px; object-fit: contain;">
                                    <span class="text-sm mb-1">Akte Kelahiran</span>
                                    <a href="{{ asset('storage/' . $user->rPendaftaran->akte) }}" class="btn btn-sm btn-secondary text-xs" target="_blank">Lihat</a>
                                </div>
                            @else
                            @endif
                            @if ($user->rPendaftaran && $user->rPendaftaran->kis)
                                <div class="d-flex flex-column mb-2 justify-content-center align-items-center">
                                    <img src="{{ asset('dist/assets/img/google-docs.png') }}" alt="" class="mb-2" style="height: 70px; width: 70px; object-fit: contain;">
                                    <span class="text-sm mb-1">KIS/PKH/PIP</span>
                                    <a href="{{ asset('storage/' . $user->rPendaftaran->kis) }}" class="btn btn-sm btn-secondary text-xs" target="_blank">Lihat</a>
                                </div>
                            @else
                            @endif
                            @if ($user->rPendaftaran && $user->rPendaftaran->butawarna)
                                <div class="d-flex flex-column mb-2 justify-content-center align-items-center">
                                    <img src="{{ asset('dist/assets/img/google-docs.png') }}" alt="" class="mb-2" style="height: 70px; width: 70px; object-fit: contain;">
                                    <span class="text-sm mb-1">Buta Warna</span>
                                    <a href="{{ asset('storage/' . $user->rPendaftaran->butawarna) }}" class="btn btn-sm btn-secondary text-xs" target="_blank">Lihat</a>
                                </div>
                            @else
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
