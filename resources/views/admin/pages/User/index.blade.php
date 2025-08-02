@extends('admin.app')

@section('title', 'Daftar Users')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>Daftar Users</h6>
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <a href="#" class="btn bg-gradient-warning" data-bs-toggle="modal" data-bs-target="#addUsers"><i
                                class="fa fa-plus" aria-hidden="true"></i><span
                                class="text-capitalize ms-1">Tambah</span></a>
                        {{-- <a href="{{ route('users.download') }}" class="btn bg-gradient-success"><i
                                class="bi bi-plus-circle"></i><span class="text-capitalize ms-1">Unduh Rekap Data</span></a> --}}
                    </div>
                    <div class="card-body px-5 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <x-admin.table id="datatable">
                                @slot('header')
                                    <tr>
                                        <x-admin.th>No</x-admin.th>
                                        <x-admin.th>Nama</x-admin.th>
                                        <x-admin.th>Email</x-admin.th>
                                        <x-admin.th>Role</x-admin.th>
                                        <x-admin.th>Nomor HP</x-admin.th>
                                        <x-admin.th>Alamat</x-admin.th>
                                        <x-admin.th>Jenis Kelamin</x-admin.th>
                                        <x-admin.th>Action</x-admin.th>
                                    </tr>
                                @endslot

                                @foreach ($users as $item)
                                    <tr>
                                        <x-admin.td>{{ $loop->iteration }}</x-admin.td>
                                        <x-admin.td>{{ $item->name ?? '' }}</x-admin.td>
                                        <x-admin.td>{{ $item->email ?? '' }}</x-admin.td>
                                        <x-admin.td>{{ $item->role ?? '' }}</x-admin.td>
                                        <x-admin.td>{{ $item->no_hp ?? '' }}</x-admin.td>
                                        <x-admin.td>{{ $item->alamat ?? '' }}</x-admin.td>
                                        <x-admin.td>{{ $item->jenis_kelamin ?? '' }}</x-admin.td>
                                        <x-admin.td>
                                            <a href="#" class="btn bg-gradient-info" data-bs-toggle="modal"
                                                data-bs-target="#editUsers{{ $item->id }}"><i class="fa fa-pencil"
                                                    aria-hidden="true"></i><span
                                                    class="text-capitalize ms-1">Edit</span></a>
                                            <a href="#" class="btn bg-gradient-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapusUsers{{ $item->id }}"><i class="fa fa-trash"
                                                    aria-hidden="true"></i><span
                                                    class="text-capitalize ms-1">Hapus</span></a>
                                        </x-admin.td>

                                        <!-- Modal Edit Users -->
                                        <div class="modal fade" id="editUsers{{ $item->id }}" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="editUsersLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editUsersLabel">Edit Data Users
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('users.update', $item->id) }}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <x-admin.input type="text" placeholder="Nama"
                                                                label="Nama" name="nama"
                                                                value="{{ $item->name ?? '' }}" />
                                                            <x-admin.input type="number" placeholder="Nomor HP"
                                                                label="Nomor HP" name="no_hp"
                                                                value="{{ $item->no_hp ?? '' }}" />
                                                            <x-admin.input type="text" placeholder="Alamat"
                                                                label="Alamat" name="alamat"
                                                                value="{{ $item->alamat ?? '' }}" />
                                                            <x-admin.input type="email" placeholder="Email"
                                                                label="Email" name="email"
                                                                value="{{ $item->email ?? '' }}" />
                                                            <Label>Jenis Kelamin</Label>
                                                            <select class="form-select mb-3"
                                                                aria-label="Default select example" name="gender">
                                                                <option hidden value="">--- Pilih Jenis Kelamin ---
                                                                </option>
                                                                <option value="Pria"
                                                                    {{ $item->jenis_kelamin == 'Pria' ? 'selected' : '' }}>
                                                                    Pria
                                                                </option>
                                                                <option value="Wanita"
                                                                    {{ $item->jenis_kelamin == 'Wanita' ? 'selected' : '' }}>
                                                                    Wanita</option>
                                                            </select>
                                                            <Label>Role</Label>
                                                            <select class="form-select mb-3"
                                                                aria-label="Default select example" name="role">
                                                                <option hidden>--- Pilih Role ---</option>
                                                                <option value="Admin"
                                                                    {{ $item->role == 'Admin' ? 'selected' : '' }}>Admin
                                                                </option>
                                                                <option value="user"
                                                                    {{ $item->role == 'user' ? 'selected' : '' }}>
                                                                    Siswa</option>
                                                            </select>
                                                            <x-admin.input type="password" placeholder="********"
                                                                label="Password" name="password" />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn btn-sm btn-success">Update</button>
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Hapus Users -->
                                        <div class="modal fade" id="hapusUsers{{ $item->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="hapusUsersLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="hapusUsersLabel">Hapus Data User
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('dist/assets/img/bin.gif') }}" alt=""
                                                            class="img-fluid w-25">
                                                        <p>Yakin ingin menghapus data {{ $item->name }}?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('users.destroy', $item->id) }}" type="submit"
                                                            class="btn btn-sm btn-danger">Hapus</a>
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </x-admin.table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Users -->
    <div class="modal fade" id="addUsers" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addUsersLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addUsersLabel">Tambah Data User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <x-admin.input type="text" placeholder="Nama" label="Nama" name="nama" />
                        <x-admin.input type="number" placeholder="Nomor HP" label="Nomor HP" name="no_hp" />
                        <x-admin.input type="text" placeholder="Alamat" label="Alamat" name="alamat" />
                        <x-admin.input type="email" placeholder="Email" label="Email" name="email" />
                        <Label>Jenis Kelamin</Label>
                        <select class="form-select mb-3" aria-label="Default select example" name="gender">
                            <option hidden>--- Pilih Jenis Kelamin ---</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                        <Label>Role</Label>
                        <select class="form-select mb-3" aria-label="Default select example" name="role">
                            <option hidden>--- Pilih Role ---</option>
                            <option value="Admin">Admin</option>
                            <option value="user">Siswa</option>
                        </select>
                        <x-admin.input type="password" placeholder="********" label="Password" name="password" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
