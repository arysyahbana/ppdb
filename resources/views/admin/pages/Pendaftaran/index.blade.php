@extends('admin.app')

@section('title', 'List Pendaftaran')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>List Pendaftaran</h6>
                <div class="card mb-4">
                    <div class="card-body px-5 pt-4 pb-2">
                        <div class="table-responsive p-0">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn bg-gradient-success" data-bs-toggle="modal"
                                    data-bs-target="#publishModal">
                                    <i class="fa fa-upload"></i><span class="ms-1">Publish</span>
                                </button>

                                <div class="fs-6">
                                    Tanggal Publish :
                                    {!! optional(optional($siswa->first())->rPendaftaran)->published_berkas_at
                                        ? '<span class="text-success fw-bold">' .
                                            \Carbon\Carbon::parse(optional(optional($siswa->first())->rPendaftaran)->published_berkas_at)->translatedFormat('d F Y, H:i') .
                                            ' WIB</span>'
                                        : '<span class="text-danger fw-bold">Belum dipublish</span>' !!}
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
                                                <div class="text-success">Lolos</div>
                                            @elseif ($item->rPendaftaran->status_verifikasi == 'tolak')
                                                <div class="text-danger">Tidak Lolos</div>
                                            @else
                                                <div class="text-warning">Menunggu...</div>
                                            @endif
                                        </x-admin.td>
                                        <x-admin.td>
                                            <a href="{{ route('listpendaftaran.detail', $item->id) }}" class="btn bg-gradient-info"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i><span
                                                    class="text-capitalize ms-1">Detail Data</span></a>
                                            <a href="#" class="btn bg-gradient-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapusPendaftaran{{ $item->id }}"><i class="fa fa-trash"
                                                    aria-hidden="true"></i><span
                                                    class="text-capitalize ms-1">Hapus</span></a>
                                        </x-admin.td>
                                    </tr>

                                    <!-- Modal Hapus Users -->
                                    <div class="modal fade" id="hapusPendaftaran{{ $item->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="hapusPendaftaranLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="hapusPendaftaranLabel">Hapus Data Pendaftaran</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('dist/assets/img/bin.gif') }}" alt=""
                                                        class="img-fluid w-25">
                                                    <p>Yakin ingin menghapus data {{ $item->name }}?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('listpendaftaran.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                    </form>
                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
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
            <form action="{{ route('listpendaftaran.publish') }}" method="POST">
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
