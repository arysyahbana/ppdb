<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Http\Request;

class SeleksiJurController extends Controller
{
    public function index()
    {
        $page = 'Seleksi';
        $siswa = User::where('role', 'user')
            ->whereHas('rPendaftaran', function ($query) {
                $query->whereIn('status_verifikasi', ['lolos']);
            })
            ->with(['rPendaftaran' => function ($query) {
                $query->whereIn('status_verifikasi', ['lolos']);
            }])
            ->get();
        return view('admin.pages.Seleksijur.index', compact('page', 'siswa'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'jurusan_diterima' => 'nullable|exists:jurusans,id',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->jurusan_diterima = $request->jurusan_diterima ?: null;
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Jurusan diterima berhasil disimpan.');
    }

    public function publish(Request $request)
    {
        $request->validate([
            'published_at' => 'required|date',
        ]);

        // Update semua data yang lolos dan belum punya jurusan_diterima
        Pendaftaran::where('status_verifikasi', 'lolos')
            ->update([
                'published_jurusan_at' => $request->published_at,
                'published_berkas_at' => null // kosongkan agar hanya kartu jurusan yang tampil
            ]);

        return redirect()->back()->with('success', 'Semua data berhasil dijadwalkan untuk publish.');
    }

    public function resetPublish(Request $request)
    {
        // Update semua data yang lolos dan belum punya jurusan_diterima
        Pendaftaran::whereNotNull('status_verifikasi')
            ->update(['published_jurusan_at' => null]);

        return redirect()->back()->with('success', 'Waktu publish berhasil direset.');
    }
}
