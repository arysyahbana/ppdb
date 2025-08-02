<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListPendaftaranController extends Controller
{
    public function index()
    {
        $page = 'List';

        $siswa = User::where('role', 'user')
            ->whereHas('rPendaftaran', function ($query) {
                $query->whereIn('status_verifikasi', ['lolos', 'tolak', 'menunggu']);
            })
            ->with(['rPendaftaran' => function ($query) {
                $query->whereIn('status_verifikasi', ['lolos', 'tolak', 'menunggu']);
            }])
            ->get();

        return view('admin.pages.Pendaftaran.index', compact('page', 'siswa'));
    }


    public function detail($id)
    {
        $page = 'List';

        $siswa = User::where('role', 'user')
            ->where('id', $id)
            ->with(['rPendaftaran.jurusanPilihan1', 'rPendaftaran.jurusanPilihan2'])
            ->firstOrFail();

        return view('admin.pages.Pendaftaran.detail', compact('page', 'siswa'));
    }

    public function lolos($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update(['status_verifikasi' => 'lolos']);

        return redirect()->route('listpendaftaran.show')->with('success', 'Pendaftaran lolos');
    }

    public function tolak($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update(['status_verifikasi' => 'tolak']);

        return redirect()->route('listpendaftaran.show')->with('success', 'Pendaftaran ditolak');
    }

    public function publish(Request $request)
    {
        $request->validate([
            'published_at' => 'required|date',
        ]);

        // Update semua data yang lolos dan belum punya jurusan_diterima
        $count = Pendaftaran::whereIn('status_verifikasi', ['lolos', 'tolak'])
            ->where(function ($q) {
                $q->whereNull('jurusan_diterima')
                    ->orWhere('jurusan_diterima', '')
                    ->orWhere('jurusan_diterima', 0);
            })
            ->update(['published_berkas_at' => $request->published_at]);

        // dd("Jumlah baris diupdate: $count");

        return redirect()->back()->with('success', 'Semua data berhasil dijadwalkan untuk publish.');
    }

    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Hapus file
        $fileFields = ['ijazah', 'kk', 'ktp_ortu', 'akte', 'kis', 'butawarna', 'foto'];
        foreach ($fileFields as $fileField) {
            if ($pendaftaran->$fileField && Storage::disk('public')->exists($pendaftaran->$fileField)) {
                Storage::disk('public')->delete($pendaftaran->$fileField);
            }
        }

        $pendaftaran->delete();

        return redirect()->back()->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}
