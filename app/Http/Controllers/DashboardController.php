<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\ObjekWisata;
use App\Models\PaketTour;
use App\Models\Pendaftaran;
use App\Models\Penginapan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $page = 'Dashboard';

        $pendaftar = Pendaftaran::count();
        $jurusan = Jurusan::count();
        $lolos = Pendaftaran::where('status_verifikasi', 'lolos')->count();
        $tolak = Pendaftaran::where('status_verifikasi', 'tolak')->count();

        $chartData = Jurusan::withCount('rPendaftar')->get()->map(function ($item) {
            return [
                'label' => $item->jurusan,
                'count' => $item->r_pendaftar_count,
            ];
        });

        $genderChart = DB::table('users')
            ->select('jenis_kelamin', DB::raw('count(*) as total'))
            ->where('role', 'user')
            ->groupBy('jenis_kelamin')
            ->get()
            ->map(function ($item) {
                return [
                    'label' => $item->jenis_kelamin === 'Pria' ? 'Pria' : 'Wanita',
                    'count' => $item->total
                ];
            });

        return view('admin.pages.dashboard', compact('page', 'pendaftar', 'jurusan', 'lolos', 'tolak', 'chartData', 'genderChart'));
    }
}
