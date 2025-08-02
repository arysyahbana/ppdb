@extends('admin.app')

@section('title', 'Seleksi Jurusan')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>Seleksi Jurusan</h6>
                <div class="card mb-4">
                    <div class="card-body px-5 pt-4 pb-2">
                        <div class="table-responsive p-0">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-col gap-3">
                                    <button type="button" class="btn bg-gradient-success" data-bs-toggle="modal"
                                        data-bs-target="#publishModal">
                                        <i class="fa fa-upload"></i><span class="ms-1">Publish</span>
                                    </button>
                                    <form action="{{ route('seleksijurusan.reset') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn bg-gradient-danger">
                                                <i class="fa fa-refresh"></i><span class="ms-1">Reset</span>
                                            </button>
                                    </form>
                                </div>
                                <div class="fs-6">
                                    Tanggal Publish :
                                    @if ($siswa->first()->rPendaftaran->published_jurusan_at)
                                        <span class="text-success fw-bold">
                                            {{ \Carbon\Carbon::parse($siswa->first()->rPendaftaran->published_jurusan_at)->translatedFormat('d F Y, H:i') }} WIB
                                        </span>
                                    @else
                                        <span class="text-danger fw-bold">Belum dipublish</span>
                                    @endif
                                </div>
                            </div>
                            <x-admin.table id="datatable">
                                @slot('header')
                                    <tr>
                                        <x-admin.th>No</x-admin.th>
                                        <x-admin.th>Nama Siswa</x-admin.th>
                                        <x-admin.th>NISN</x-admin.th>
                                        <x-admin.th>Asal Sekolah</x-admin.th>
                                        <x-admin.th>Status</x-admin.th>
                                        <x-admin.th>Pilihan 1</x-admin.th>
                                        <x-admin.th>Pilihan 2</x-admin.th>
                                        <x-admin.th>Jurusan Diterima</x-admin.th>
                                        <x-admin.th>Action</x-admin.th>
                                    </tr>
                                @endslot
                                @foreach ($siswa as $item)
                                    <tr>
                                        <x-admin.td>{{ $loop->iteration }}</x-admin.td>
                                        <x-admin.td>{{ $item->name ?? '' }}</x-admin.td>
                                        <x-admin.td>{{ $item->rPendaftaran->nisn ?? '' }}</x-admin.td>
                                        <x-admin.td>{{ $item->rPendaftaran->asal_sekolah ?? '' }}</x-admin.td>
                                        <x-admin.td>
                                            @if ($item->rPendaftaran->status_verifikasi == 'lolos')
                                                <div class="badge bg-success">Lolos</div>
                                            @elseif ($item->rPendaftaran->status_verifikasi == 'tolak')
                                                <div class="badge bg-danger">Tidak Lolos</div>
                                            @else
                                                <div class="badge bg-warning">Menunggu</div>
                                            @endif
                                        </x-admin.td>
                                        <x-admin.td>{{ $item->rPendaftaran->jurusanPilihan1->jurusan ?? '-' }}</x-admin.td>
                                        <x-admin.td>{{ $item->rPendaftaran->jurusanPilihan2->jurusan ?? '-' }}</x-admin.td>
                                        <x-admin.td>
                                            @if ($item->rPendaftaran->jurusan_diterima)
                                                <span class="badge bg-secondary">{{ $item->rPendaftaran->jurusanDiterima->jurusan ?? '' }}</span>
                                            @else
                                                <div class="badge bg-danger">Tidak Lolos</div>
                                            @endif
                                        </x-admin.td>
                                        <x-admin.td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#seleksi{{ $item->rPendaftaran->id }}" class="btn bg-gradient-info"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i><span
                                                    class="text-capitalize ms-1">Seleksi Jurusan</span></a>
                                        </x-admin.td>
                                    </tr>

                                    <div class="modal fade" id="seleksi{{ $item->rPendaftaran->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="hapusUsersLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="hapusUsersLabel">Seleksi Jurusan</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col col-12 col-lg-6">
                                                            @if ($item->rPendaftaran->foto)
                                                                <img src="{{ asset('storage/' . $item->rPendaftaran->foto) }}" alt="Foto" class="img-fluid img-thumbnail">
                                                            @else
                                                                <img src="{{ asset('dist/assets/img/marie.jpg') }}" alt="" class="img-fluid img-thumbnail" style="max-width: 500px;">
                                                            @endif
                                                        </div>
                                                        <div class="col col-12 col-lg-6">
                                                            <div class="container text-sm">
                                                                <div class="row mb-2">
                                                                    <div class="col-sm-4 fw-bold">No Daftar</div>
                                                                    <div class="col-sm-1">:</div>
                                                                    <div class="col-sm-7">{{ $item->rPendaftaran->no_daftar ?? '-' }}</div>
                                                                </div>

                                                                <div class="row mb-2">
                                                                    <div class="col-sm-4 fw-bold">Nama</div>
                                                                    <div class="col-sm-1">:</div>
                                                                    <div class="col-sm-7">{{ $item->name ?? '-' }}</div>
                                                                </div>

                                                                <div class="row mb-2">
                                                                    <div class="col-sm-4 fw-bold">NIK</div>
                                                                    <div class="col-sm-1">:</div>
                                                                    <div class="col-sm-7">{{ $item->rPendaftaran->nik ?? '-' }}</div>
                                                                </div>

                                                                <div class="row mb-2">
                                                                    <div class="col-sm-4 fw-bold">NISN</div>
                                                                    <div class="col-sm-1">:</div>
                                                                    <div class="col-sm-7">{{ $item->rPendaftaran->nisn ?? '-' }}</div>
                                                                </div>

                                                                <div class="row mb-2">
                                                                    <div class="col-sm-4 fw-bold">Email</div>
                                                                    <div class="col-sm-1">:</div>
                                                                    <div class="col-sm-7">{{ $item->email ?? '-' }}</div>
                                                                </div>

                                                                <div class="row mb-2">
                                                                    <div class="col-sm-4 fw-bold">Tempat/Tanggal Lahir</div>
                                                                    <div class="col-sm-1">:</div>
                                                                    <div class="col-sm-7">
                                                                        {{ $item->rPendaftaran->tempat_lahir ?? '-' }} / {{ $item->rPendaftaran->tanggal_lahir ?? '-' }}
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-2">
                                                                    <div class="col-sm-4 fw-bold">Jenis Kelamin</div>
                                                                    <div class="col-sm-1">:</div>
                                                                    <div class="col-sm-7">{{ $item->jenis_kelamin ?? '-' }}</div>
                                                                </div>

                                                                <div class="row mb-2">
                                                                    <div class="col-sm-4 fw-bold">No HP</div>
                                                                    <div class="col-sm-1">:</div>
                                                                    <div class="col-sm-7">{{ $item->no_hp ?? '-' }}</div>
                                                                </div>

                                                                <div class="row mb-2">
                                                                    <div class="col-sm-4 fw-bold">Alamat</div>
                                                                    <div class="col-sm-1">:</div>
                                                                    <div class="col-sm-7">{{ $item->alamat ?? '-' }}</div>
                                                                </div>

                                                                <div class="row mb-2">
                                                                    <div class="col-sm-4 fw-bold">Asal Sekolah</div>
                                                                    <div class="col-sm-1">:</div>
                                                                    <div class="col-sm-7">{{ $item->rPendaftaran->asal_sekolah ?? '-' }}</div>
                                                                </div>

                                                                <div class="row mb-2">
                                                                    <div class="col-sm-4 fw-bold">Pilihan 1</div>
                                                                    <div class="col-sm-1">:</div>
                                                                    <div class="col-sm-7">{{ $item->rPendaftaran->jurusanPilihan1->jurusan ?? '-' }}</div>
                                                                </div>

                                                                <div class="row mb-2">
                                                                    <div class="col-sm-4 fw-bold">Pilihan 2</div>
                                                                    <div class="col-sm-1">:</div>
                                                                    <div class="col-sm-7">{{ $item->rPendaftaran->jurusanPilihan2->jurusan ?? '-' }}</div>
                                                                </div>

                                                                <div class="row mb-2">
                                                                    <div class="col-sm-4 fw-bold">Status Verifikasi Berkas</div>
                                                                    <div class="col-sm-1">:</div>
                                                                    <div class="col-sm-7 text-capitalize">
                                                                        <span class="badge bg-success">{{ $item->rPendaftaran->status_verifikasi ?? '-' }}</span>
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-2">
                                                                    <div class="col-sm-4 fw-bold">Status Pilih Jurusan</div>
                                                                    <div class="col-sm-1">:</div>
                                                                    <div class="col-sm-7">
                                                                        @if ($item->rPendaftaran->jurusan_diterima == null)
                                                                            <span class="badge bg-danger">Tidak Lolos</span>
                                                                        @else
                                                                            <span class="badge bg-success">Lolos</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-2">
                                                                    <div class="col-12 fw-bold">
                                                                        <hr>
                                                                    <form action="{{ route('seleksijurusan.store', $item->rPendaftaran->id) }}" method="POST">
                                                                    @csrf
                                                                        <label for="">Seleksi Jurusan</label>
                                                                        <select class="form-select" aria-label="Default select example" name="jurusan_diterima">
                                                                            <option disabled selected hidden>Pilih Jurusan Diterima</option>
                                                                            @if ($item->rPendaftaran->jurusanPilihan1)
                                                                                <option value="{{ $item->rPendaftaran->jurusanPilihan1->id }}">
                                                                                    {{ $item->rPendaftaran->jurusanPilihan1->jurusan }}
                                                                                </option>
                                                                            @endif

                                                                            @if ($item->rPendaftaran->jurusanPilihan2)
                                                                                <option value="{{ $item->rPendaftaran->jurusanPilihan2->id }}">
                                                                                    {{ $item->rPendaftaran->jurusanPilihan2->jurusan }}
                                                                                </option>
                                                                            @endif
                                                                            <option value="">Tidak Diterima</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                        <button type="submit" class="btn btn-sm btn-success">Pilih Jurusan</button>
                                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </x-admin.table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     {{-- Modal Publish --}}
    <div class="modal fade" id="publishModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('seleksijurusan.publish') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Atur Waktu Publish</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <label for="published_at">Tanggal & Jam:</label>
                        <input type="datetime-local" name="published_at" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Publish Semua</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
