<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $dosen = DB::table('dosen')
            ->when($search, function ($query, $search) {
                return $query->where('Nama_Dosen', 'like', '%' . $search . '%')
                            ->orWhere('NIDN', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('dosen', compact('dosen'));
    }
    public function tambah()
    {
        $matkul = DB::table('mata_kuliah')->get();
        $kategori_bidang = config('kategori_bidang');

        return view('tambah_dosen', compact('kategori_bidang'));
    }

    public function store(Request $request)
    {
        DB::table('dosen')->insert([
            'NIDN' => $request->nidn,
            'Nama_Dosen' => $request->nama,
            'bidang_keahlian' => $request->bidang_keahlian
        ]);

        return redirect('/dosen')
        ->with('success', 'Data dosen berhasil ditambahkan');
    }
    public function hapus($id)
    {
        DB::table('dosen')->where('NIDN', $id)->delete();
        return redirect('/dosen')
        ->with('success', 'Data dosen berhasil dihapus!');
    }
    public function edit($id)
    {
        $dosen = DB::table('dosen')->where('NIDN', $id)->first();

        if (!$dosen) {
            return redirect('/dosen')->with('error', 'Data dosen tidak ditemukan');
        }

        $kategori_bidang = config('kategori_bidang');

        return view('edit_dosen', compact('dosen', 'kategori_bidang'));
    }

    public function update(Request $request, $id)
    {
        DB::table('dosen')->where('NIDN', $request->nidn)->update([
            'Nama_Dosen' => $request->nama,
            'bidang_keahlian' => $request->bidang_keahlian
        ]);

        return redirect('/dosen')->with('success', 'Data dosen berhasil diperbarui!');
    }
}

