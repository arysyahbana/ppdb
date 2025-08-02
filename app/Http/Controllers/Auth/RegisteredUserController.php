<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required'],
            'noHp' => ['required', 'numeric', 'digits_between:9,13'],
            'alamat' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'user',
            'jenis_kelamin' => $request->input('gender'),
            'no_hp' => $request->input('noHp'),
            'alamat' => $request->input('alamat'),
            // 'status' => 'Pending',
        ]);
        event(new Registered($user));

        Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        if (Auth::user()->role == 'Admin') {
            return redirect()->intended('/dashboard')->with('success', 'Selamat datang ' . Auth::user()->name);
        } elseif (Auth::user()->role == 'user') {
            return redirect()->intended('/profile-siswa/show')->with('success', 'Selamat datang ' . Auth::user()->name);
        } else {
            return redirect()->route('login')->with('error', 'Akun anda tidak memiliki akses');
        }
    }
}
