<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $matkul = DB::table('mata_kuliah')
            ->when($search, function ($query, $search) {
                return $query->where('nama_matkul', 'like', "%{$search}%")
                            ->orWhere('kode_matkul', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('mata_kuliah', compact('matkul', 'search'));
    }
    public function tambah()
    {
        $kategori_bidang = config('kategori_bidang');

        return view('tambah_matkul', compact('kategori_bidang'));
    }

    public function simpan(Request $request)
    {
        DB::table('mata_kuliah')->insert([
            'kode_matkul' => $request->kode_matkul,
            'nama_matkul' => $request->nama_matkul,
            'sks' => $request->sks,
            'semester' => $request->semester,
            'kategori_bidang' => $request->kategori_bidang
        ]);

        return redirect('/mata-kuliah')
        ->with('success', 'Data mata kuliah berhasil ditambahkan');
        dd($request->all());
    }
    public function edit($kode)
    {
        $matkul = DB::table('mata_kuliah')
            ->where('kode_matkul', $kode)
            ->first();

        $kategori_bidang = config('kategori_bidang');

        return view('edit_matkul', compact('matkul', 'kategori_bidang'));
    }

    public function update(Request $request, $kode)
    {
        DB::table('mata_kuliah')
            ->where('kode_matkul', $kode)
            ->update([
                'nama_matkul' => $request->nama_matkul,
                'sks' => $request->sks,
                'semester' => $request->semester,
                'kategori_bidang' => $request->kategori_bidang
            ]);

        return redirect('/mata-kuliah')
        ->with('success', 'Data mata kuliah berhasil diperbarui');
    }

    public function hapus($kode)
    {
        DB::table('mata_kuliah')
            ->where('kode_matkul', $kode)
            ->delete();

        return redirect('/mata-kuliah')
            ->with('success', 'Data mata kuliah berhasil dihapus!');
    }
}