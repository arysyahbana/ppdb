<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $page = 'Jurusan';
        $jurusan = Jurusan::all();
        return view('admin.pages.Jurusan.index', compact('page', 'jurusan'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'jurusan' => 'required',
            'deskripsi' => 'required',
        ]);

        $store = new Jurusan();
        $store->jurusan = $request->input('jurusan');
        $store->deskripsi = $request->input('deskripsi');
        $store->save();

        return redirect()->route('jurusan.show')->with('success', 'Data jurusan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jurusan' => 'required',
            'deskripsi' => 'required',
        ]);

        $update = Jurusan::find($id);
        $update->jurusan = $request->input('jurusan');
        $update->deskripsi = $request->input('deskripsi');
        $update->save();
        return redirect()->route('jurusan.show')->with('success', 'Data jurusan berhasil diubah.');
    }

    public function destroy($id)
    {
        $destroy = Jurusan::find($id);
        $destroy->delete();
        return redirect()->route('jurusan.show')->with('success', 'Data jurusan berhasil dihapus.');
    }
}
