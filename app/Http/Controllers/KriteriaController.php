<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = DB::table('kriteria')->paginate(10);
        return view('kriteria', compact('kriteria'));
    }

    public function tambah()
    {
        return view('tambah_kriteria');
    }

    public function simpan(Request $request)
    {
        DB::table('kriteria')->insert([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot
        ]);

        return redirect('/kriteria')
        ->with('success', 'Data kriteria berhasil ditambahkan');
    }

    public function edit($kode)
    {
        $kriteria = DB::table('kriteria')
            ->where('kode_kriteria', $kode)
            ->first();

        return view('edit_kriteria', compact('kriteria'));
    }

    public function update(Request $request, $kode)
    {
        DB::table('kriteria')
            ->where('kode_kriteria', $kode)
            ->update([
                'nama_kriteria' => $request->nama_kriteria,
                'bobot' => $request->bobot
            ]);

        return redirect('/kriteria')
        ->with('success', 'Data kriteria berhasil diperbarui');
    }

    public function hapus($kode)
    {
        DB::table('kriteria')
            ->where('kode_kriteria', $kode)
            ->delete();

        return redirect('/kriteria')
            ->with('success', 'Data kriteria berhasil dihapus!');
    }
}