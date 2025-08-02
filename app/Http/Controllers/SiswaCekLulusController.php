<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiswaCekLulusController extends Controller
{
    public function index()
    {
        $page = 'Cek';
        $siswa = User::with([
            'rPendaftaran.jurusanPilihan1',
            'rPendaftaran.jurusanPilihan2',
            'rPendaftaran.jurusanDiterima'
        ])->find(auth()->id());

        $showBerkas = false;
        $showJurusan = false;

        if ($siswa && $siswa->rPendaftaran) {
            $pendaftaran = $siswa->rPendaftaran;
            $now = Carbon::now();

            $publishedBerkas = $pendaftaran->published_berkas_at;
            $publishedJurusan = $pendaftaran->published_jurusan_at;
            $statusVerifikasi = $pendaftaran->status_verifikasi;

            // ✅ Cek showJurusan terlebih dahulu
            if ($publishedJurusan && $now->gte(Carbon::parse($publishedJurusan))) {
                $showJurusan = true;
            }
            // ✅ Kalau belum masuk fase jurusan, cek fase berkas
            elseif (!is_null($statusVerifikasi) && $publishedBerkas && $now->gte(Carbon::parse($publishedBerkas))) {
                $showBerkas = true;
            }
        }

        return view('admin.user_pages.Cek.index', compact('page', 'siswa', 'showBerkas', 'showJurusan'));
    }

    public function print()
    {
        $page = 'Cek';
        $siswa = User::with('rPendaftaran')->find(auth()->id());
        return view('admin.user_pages.Cek.cetak', compact('page', 'siswa'));
    }
}
