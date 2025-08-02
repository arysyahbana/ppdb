<?php

namespace App\Http\Controllers;

use App\Exports\GenericExport;
use App\Helpers\GlobalFunction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $page = 'Users';
        $users = User::get();
        return view('admin.pages.User.index', compact('page', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        $store = new User();
        $store->name = $request->input('nama');
        $store->email = $request->input('email');
        $store->role = $request->input('role');
        $store->no_hp = GlobalFunction::formatPhoneNumber($request->input('no_hp'));
        $store->alamat = $request->input('alamat');
        $store->jenis_kelamin = $request->input('gender');
        // $store->status = 'Accept';
        $store->password = Hash::make($request->password);
        $store->save();

        return redirect()->route('users.show')->with('success', 'Data user berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        $update = User::find($id);
        $update->name = $request->input('nama');
        $update->email = $request->input('email');
        $update->role = $request->input('role');
        $update->no_hp = GlobalFunction::formatPhoneNumber($request->input('no_hp'));
        $update->alamat = $request->input('alamat');
        $update->jenis_kelamin = $request->input('gender');
        if ($request->input('password') != null) {
            $update->password = Hash::make($request->input('password'));
        }
        $update->save();
        return redirect()->route('users.show')->with('success', 'Data user berhasil diubah.');
    }

    public function destroy($id)
    {
        $destroy = User::find($id);
        $destroy->delete();
        return redirect()->route('users.show')->with('success', 'Data user berhasil dihapus.');
    }

    public function download()
    {
        $columns = ['name', 'email', 'role', 'no_hp', 'alamat', 'jenis_kelamin'];

        return Excel::download(new GenericExport(User::class, $columns, 'G', 'penginapan'), 'User.xlsx');
    }

    // public function AccUser($id, $status)
    // {
    //     $penginapan = User::find($id);
    //     if ($status == 'Accept') {
    //         $penginapan->status = 'Accept';
    //     } else {
    //         $penginapan->status = 'Decline';
    //     }
    //     $penginapan->update();
    //     return back()->with('success', 'Data User Berhasil Diubah');
    // }
}
