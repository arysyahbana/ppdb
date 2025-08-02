<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);
        $user = Auth::user();

        if ($user->role == 'Admin') {
            return redirect()->intended('/dashboard')->with('success', 'Selamat datang ' . $user->name);
        }

        if ($user->role == 'user') {
            return redirect()->intended('/profile-siswa/show')->with('success', 'Selamat datang ' . $user->name);
        }

        // Kondisi default jika tidak memenuhi kriteria
        return redirect()->intended('/login')->with('error', 'Akun anda tidak memiliki akses');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
