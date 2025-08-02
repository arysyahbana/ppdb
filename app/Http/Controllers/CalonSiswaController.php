<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CalonSiswaController extends Controller
{
    public function index()
    {
        $page = 'Calon_Siswa';
        $siswa = User::where('role', 'user')->get();
        return view('admin.pages.Siswa.index', compact('page', 'siswa'));
    }
}
