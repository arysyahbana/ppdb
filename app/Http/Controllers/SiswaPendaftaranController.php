<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SiswaPendaftaranController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->rPendaftaran) {
            return redirect()->route('siswaProfile.show')->with('error', 'Kamu sudah melakukan pendaftaran.');
        }
        $page = 'SiswaPendaftaran';
        $jurusans = Jurusan::all();
        return view('admin.user_pages.Pendaftaran.index', compact('page', 'user', 'jurusans'));
    }

    public function store(Request $request)
    {
        $user = User::find(auth()->id());

        $validated = $request->validate([
            // user
            'name' => 'required|string|max:255',
            // 'email' => 'required|email',
            'no_hp' => 'required',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',

            // pendaftaran
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'nisn' => 'required|string',
            'nik' => 'required|string',
            'asal_sekolah' => 'required|string',

            // file
            'ijazah' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'kk' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'ktp_ortu' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'akte' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'kis' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'butawarna' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'foto' => 'required|file|mimes:jpg,jpeg,png',

            // pilihan
            'pilihan_1' => 'required|different:pilihan_2',
            'pilihan_2' => 'required',
        ]);

        $user->update(
            [
                'name' => $validated['name'],
                // 'email' => $validated['email'],
                'no_hp' => $validated['no_hp'],
                'alamat' => $validated['alamat'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
            ]
        );

        $filePaths = [];
        foreach (['ijazah', 'kk', 'ktp_ortu', 'akte', 'kis', 'butawarna', 'foto'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $filePaths[$fileField] = $request->file($fileField)->store("pendaftaran/{$user->id}", 'public');
            }
        }

        Pendaftaran::create([
            'user_id' => $user->id,
            'no_daftar' => (int) now()->format('YmdHis'),
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'nisn' => $validated['nisn'],
            'nik' => $validated['nik'],
            'asal_sekolah' => $validated['asal_sekolah'],
            'ijazah' => $filePaths['ijazah'] ?? null,
            'kk' => $filePaths['kk'] ?? null,
            'ktp_ortu' => $filePaths['ktp_ortu'] ?? null,
            'akte' => $filePaths['akte'] ?? null,
            'kis' => $filePaths['kis'] ?? null,
            'butawarna' => $filePaths['butawarna'] ?? null,
            'foto' => $filePaths['foto'] ?? null,
            'pilihan_1' => $validated['pilihan_1'],
            'pilihan_2' => $validated['pilihan_2'],
            'jurusan_diterima' => null,
            'status_verifikasi' => 'menunggu',
        ]);

        return redirect()->route('siswaProfile.show')->with('success', 'Pendaftaran Berhasil Dikirim');
    }
}
