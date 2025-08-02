@extends('admin.app')

@section('title', 'Detail Data Siswa')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>Detail Data Siswa</h6>
                <div class="card mb-4">
                    <div class="row">
                        <div class="col col-12 col-lg-6">
                            <div class="row mt-5">
                                <div class="col col-12 text-center">
                                    @if ($siswa->rPendaftaran->foto)
                                        <img src="{{ asset('storage/' . $siswa->rPendaftaran->foto) }}" alt="Foto" class="img-fluid img-thumbnail">
                                    @else
                                        <img src="{{ asset('dist/assets/img/marie.jpg') }}" alt="" class="img-fluid img-thumbnail" style="max-width: 500px;">
                                    @endif
                                </div>
                                <div class="col col-12">
                                    <div class="d-flex flex-wrap gap-5 pt-5 justify-content-center">
                                        @if ($siswa->rPendaftaran->ijazah)
                                            <div class="d-flex flex-column mb-2 justify-content-center align-items-center">
                                                <img src="{{ asset('dist/assets/img/google-docs.png') }}" alt="" class="mb-2" style="height: 70px; width: 70px; object-fit: contain;">
                                                <span class="text-sm mb-1">Ijazah / SKHU</span>
                                                <a href="{{ asset('storage/' . $siswa->rPendaftaran->ijazah) }}" class="btn btn-sm btn-secondary text-xs" target="_blank">Lihat</a>
                                            </div>
                                        @else
                                        @endif
                                        @if ($siswa->rPendaftaran->kk)
                                            <div class="d-flex flex-column mb-2 justify-content-center align-items-center">
                                                <img src="{{ asset('dist/assets/img/google-docs.png') }}" alt="" class="mb-2" style="height: 70px; width: 70px; object-fit: contain;">
                                                <span class="text-sm mb-1">Kartu Keluarga</span>
                                                <a href="{{ asset('storage/' . $siswa->rPendaftaran->kk) }}" class="btn btn-sm btn-secondary text-xs" target="_blank">Lihat</a>
                                            </div>
                                        @else
                                        @endif
                                        @if ($siswa->rPendaftaran->ktp_ortu)
                                            <div class="d-flex flex-column mb-2 justify-content-center align-items-center">
                                                <img src="{{ asset('dist/assets/img/google-docs.png') }}" alt="" class="mb-2" style="height: 70px; width: 70px; object-fit: contain;">
                                                <span class="text-sm mb-1">KTP Orang Tua</span>
                                                <a href="{{ asset('storage/' . $siswa->rPendaftaran->ktp_ortu) }}" class="btn btn-sm btn-secondary text-xs" target="_blank">Lihat</a>
                                            </div>
                                        @else
                                        @endif
                                        @if ($siswa->rPendaftaran->akte)
                                            <div class="d-flex flex-column mb-2 justify-content-center align-items-center">
                                                <img src="{{ asset('dist/assets/img/google-docs.png') }}" alt="" class="mb-2" style="height: 70px; width: 70px; object-fit: contain;">
                                                <span class="text-sm mb-1">Akte Kelahiran</span>
                                                <a href="{{ asset('storage/' . $siswa->rPendaftaran->akte) }}" class="btn btn-sm btn-secondary text-xs" target="_blank">Lihat</a>
                                            </div>
                                        @else
                                        @endif
                                        @if ($siswa->rPendaftaran->kis)
                                            <div class="d-flex flex-column mb-2 justify-content-center align-items-center">
                                                <img src="{{ asset('dist/assets/img/google-docs.png') }}" alt="" class="mb-2" style="height: 70px; width: 70px; object-fit: contain;">
                                                <span class="text-sm mb-1">KIS/PKH/PIP</span>
                                                <a href="{{ asset('storage/' . $siswa->rPendaftaran->kis) }}" class="btn btn-sm btn-secondary text-xs" target="_blank">Lihat</a>
                                            </div>
                                        @else
                                        @endif
                                        @if ($siswa->rPendaftaran->butawarna)
                                            <div class="d-flex flex-column mb-2 justify-content-center align-items-center">
                                                <img src="{{ asset('dist/assets/img/google-docs.png') }}" alt="" class="mb-2" style="height: 70px; width: 70px; object-fit: contain;">
                                                <span class="text-sm mb-1">Buta Warna</span>
                                                <a href="{{ asset('storage/' . $siswa->rPendaftaran->butawarna) }}" class="btn btn-sm btn-secondary text-xs" target="_blank">Lihat</a>
                                            </div>
                                        @else
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-12 col-lg-6">
                            <div class="card-body px-5 pt-0 pb-2">
                                <div class="table-responsive p-5">
                                    <table class="table table-striped mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="text-sm fw-bold" style="width: 150px;">No Daftar</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $siswa->rPendaftaran->no_daftar ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold" style="width: 150px;">Nama</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $siswa->name ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold" style="width: 150px;">NIK</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $siswa->rPendaftaran->nik ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold" style="width: 150px;">NISN</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $siswa->rPendaftaran->nisn ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold">Email</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $siswa->email ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold">Tempat/Tanggal Lahir</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $siswa->rPendaftaran->tempat_lahir ?? '-' }} / {{ $siswa->rPendaftaran->tanggal_lahir ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold">Jenis Kelamin</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $siswa->jenis_kelamin ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold">No HP</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $siswa->no_hp ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold">Alamat</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $siswa->alamat ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold">Asal Sekolah</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $siswa->rPendaftaran->asal_sekolah ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold">Pilihan 1</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $siswa->rPendaftaran->jurusanPilihan1->jurusan ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold">Pilihan 2</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $siswa->rPendaftaran->jurusanPilihan2->jurusan ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm fw-bold">Status Verifikasi</td>
                                                <td class="text-sm">:</td>
                                                <td class="text-sm">{{ $siswa->rPendaftaran->status_verifikasi ?? '-' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 px-5">
                        @if ($siswa->rPendaftaran->status_verifikasi == 'lolos')
                            <a href="#" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#tolak-{{ $siswa->id }}"><i class="fa fa-pencil" aria-hidden="true"></i><span class="text-capitalize ms-1">Tidak Lolos</span></a>
                        @elseif ($siswa->rPendaftaran->status_verifikasi == 'tolak')
                            <a href="#" class="btn bg-gradient-info" data-bs-toggle="modal" data-bs-target="#lolos-{{ $siswa->id }}"><i class="fa fa-pencil" aria-hidden="true"></i><span class="text-capitalize ms-1">Lolos Verifikasi</span></a>
                        @else
                            <a href="#" class="btn bg-gradient-info" data-bs-toggle="modal" data-bs-target="#lolos-{{ $siswa->id }}"><i class="fa fa-pencil" aria-hidden="true"></i><span class="text-capitalize ms-1">Lolos Verifikasi</span></a>
                            <a href="#" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#tolak-{{ $siswa->id }}"><i class="fa fa-pencil" aria-hidden="true"></i><span class="text-capitalize ms-1">Tidak Lolos</span></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- lolos --}}
    <div class="modal fade" id="lolos-{{ $siswa->id }}"
        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="hapusUsersLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapusUsersLabel">Verifikasi Berkas
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('dist/assets/img/daftar.gif') }}" alt=""
                        class="img-fluid w-25">
                    <p>Yakin ingin meloloskan pendaftaran?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('listpendaftaran.lolos', $siswa->rPendaftaran->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">Ya, Lolos</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- tolak --}}
    <div class="modal fade" id="tolak-{{ $siswa->id }}"
        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="hapusUsersLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapusUsersLabel">Verifikasi Berkas
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('dist/assets/img/bin.gif') }}" alt=""
                        class="img-fluid w-25">
                    <p>Yakin ingin menolak pendaftaran?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('listpendaftaran.tolak', $siswa->rPendaftaran->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">tolak</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
