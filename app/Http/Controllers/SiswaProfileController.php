<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SiswaProfileController extends Controller
{
    public function index()
    {
        $page = 'SiswaProfile';
        $user = User::with('rPendaftaran')->find(auth()->id());
        return view('admin.user_pages.Profile.index', compact('page', 'user'));
    }
}
