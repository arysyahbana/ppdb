@extends('admin.app')

@section('title', 'Pendaftaran')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>Pendaftaran</h6>
                <form id="formPendaftaran" action="{{ route('siswaPendaftaran.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col col-12 col-lg-6">
                            <div class="card mb-4">
                                <div class="card-body px-4 pt-4 pb-2">
                                    <div class="table-responsive p-0">
                                        <x-admin.input type="text" placeholder="Nama" label="Nama"
                                            name="name" value="{{ $user->name ?? '' }}" />

                                        {{-- <x-admin.input type="email" placeholder="Email" label="Email"
                                            name="email" value="{{ $user->email ?? '' }}" /> --}}

                                        <x-admin.input type="number" placeholder="NISN" label="NISN"
                                            name="nisn" />

                                        <x-admin.input type="number" placeholder="NIK" label="NIK"
                                            name="nik" />

                                        <div class="d-flex flex-wrap gap-2">
                                            <div class="col-5">
                                                <x-admin.input type="text" placeholder="Tempat Lahir" label="Tempat Lahir" name="tempat_lahir" />
                                            </div>
                                            <div class="col-5">
                                                <x-admin.input type="date" placeholder="Tanggal Lahir" label="Tanggal Lahir" name="tanggal_lahir" />
                                            </div>
                                        </div>

                                        <label for="" class="form-label">Jenis Kelamin</label>
                                        <div class="">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="Pria" value="Pria" @if(isset($user) && $user->jenis_kelamin == 'Pria') checked @endif>
                                                <label class="form-check-label" for="Pria">Pria</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="Wanita" value="Wanita" @if(isset($user) && $user->jenis_kelamin == 'Wanita') checked @endif>
                                                <label class="form-check-label" for="Wanita">Wanita</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-wrap gap-2">
                                            <div class="col-5">
                                                <div class="mb-3">
                                                    <label for="jurusan">Jurusan Pilihan 1</label>
                                                    <select id="pilihan_1" class="form-select" aria-label="Default select example" name="pilihan_1">
                                                        <option selected hidden>Pilih Jurusan</option>
                                                        @foreach ($jurusans as $jurusan)
                                                            <option value="{{ $jurusan->id ?? '' }}">{{ $jurusan->jurusan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div class="mb-3">
                                                    <label for="jurusan">Jurusan Pilihan 2</label>
                                                    <select id="pilihan_2" class="form-select" aria-label="Default select example" name="pilihan_2">
                                                        <option selected hidden>Pilih Jurusan</option>
                                                        @foreach ($jurusans as $jurusan)
                                                            <option value="{{ $jurusan->id ?? '' }}">{{ $jurusan->jurusan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <label for="" class="form-label">Alamat</label>
                                        <textarea name="alamat" id="" class="form-control mb-3">{{ $user->alamat ?? '' }}</textarea>

                                        <x-admin.input type="text" placeholder="Asal Sekolah" label="Asal Sekolah"
                                            name="asal_sekolah" />

                                        <x-admin.input type="nu\mber" placeholder="Nomor HP" label="Nomor HP"
                                            name="no_hp" value="{{ $user->no_hp ?? '' }}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-12 col-lg-6">
                            <div class="card mb-4">
                                <div class="card-body px-4 pt-4 pb-2">
                                    <div class="table-responsive p-0">
                                        <x-admin.input type="file" label="Ijazah / SKHU" name="ijazah" />

                                        <x-admin.input type="file" label="KK" name="kk" />

                                        <x-admin.input type="file" label="KTP Orang Tua" name="ktp_ortu" />

                                        <x-admin.input type="file" label="Akte Kelahiran" name="akte" />

                                        <div id="butawarnaInput" style="display: none;">
                                            <x-admin.input type="file" label="Surat Keterangan Tidak Buta Warna" name="butawarna" />
                                        </div>

                                        <x-admin.input type="file" label="KIS/PKH/PIP" name="kis" />

                                        <x-admin.input type="file" label="Foto" name="foto" />
                                    </div>
                                    <div class="d-flex justify-content-end mt-2">
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                data-bs-target="#daftar">Daftar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="daftar"
        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="daftarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="daftarLabel">Daftar Berkas
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('dist/assets/img/daftar.gif') }}" alt=""
                        class="img-fluid w-25">
                     <p>Apakah kamu yakin ingin mengirim pendaftaran ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="submitPendaftaran">Ya, Daftar</button>
                    <button type="button" class="btn btn-sm btn-secondary"
                        data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const pilihan1 = document.getElementById("pilihan_1");
            const pilihan2 = document.getElementById("pilihan_2");
            const butawarnaInput = document.getElementById("butawarnaInput");

            const keywords = ["tkj", "komputer", "jaringan", "teknik komputer", "teknik komputer dan jaringan"];

            function checkJurusanButawarna() {
                const text1 = pilihan1.options[pilihan1.selectedIndex]?.text?.toLowerCase() || '';
                const text2 = pilihan2.options[pilihan2.selectedIndex]?.text?.toLowerCase() || '';

                const matched = keywords.some(keyword => text1.includes(keyword) || text2.includes(keyword));

                butawarnaInput.style.display = matched ? "block" : "none";
            }

            pilihan1.addEventListener("change", checkJurusanButawarna);
            pilihan2.addEventListener("change", checkJurusanButawarna);
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tombolSubmit = document.getElementById("submitPendaftaran");
            const formPendaftaran = document.getElementById("formPendaftaran");

            tombolSubmit.addEventListener("click", function () {
                formPendaftaran.submit();
            });
        });
    </script>

@endsection
