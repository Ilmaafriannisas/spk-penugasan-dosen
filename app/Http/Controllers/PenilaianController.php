<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    public function index()
    {
        $data = DB::table('penilaian_dosen')
            ->join('dosen', 'penilaian_dosen.nidn', '=', 'dosen.NIDN')
            ->join('kriteria', 'penilaian_dosen.kode_kriteria', '=', 'kriteria.kode_kriteria')
            ->select('penilaian_dosen.*', 'dosen.Nama_Dosen', 'kriteria.nama_kriteria')
            ->paginate(10);

        return view('penilaian', compact('data'));
    }

    public function tambah()
    {
        $dosen = DB::table('dosen')->get();
        $kriteria = DB::table('kriteria')->get();
        $kategori_bidang = config('kategori_bidang');

        return view('tambah_penilaian', compact(
            'dosen',
            'kriteria',
            'kategori_bidang'
        ));
    }

    public function simpan(Request $request)
    {
        DB::table('penilaian_dosen')->insert([
            'nidn' => $request->nidn,
            'kategori_bidang' => $request->kategori_bidang,
            'kode_kriteria' => $request->kode_kriteria,
            'nilai' => $request->nilai
        ]);

        return redirect('/penilaian')
        ->with('success', 'Data penilaian berhasil ditambahkan');
    }

    public function hapus($id)
    {
        DB::table('penilaian_dosen')
            ->where('id', $id)
            ->delete();

        return redirect('/penilaian')
            ->with('success', 'Data penilaian berhasil dihapus!');
    }
    public function edit($id)
    {
        $penilaian = DB::table('penilaian_dosen')->where('id', $id)->first();
        $dosen = DB::table('dosen')->get();
        $kriteria = DB::table('kriteria')->get();
        $kategori_bidang = config('kategori_bidang');

        return view('edit_penilaian', compact(
            'penilaian',
            'dosen',
            'kriteria',
            'kategori_bidang'
        ));
    }
    public function update(Request $request, $id)
    {
        DB::table('penilaian_dosen')->where('id', $id)->update([
            'nidn' => $request->nidn,
            'kategori_bidang' => $request->kategori_bidang,
            'kode_kriteria' => $request->kode_kriteria,
            'nilai' => $request->nilai
        ]);

        return redirect('/penilaian')->with('success', 'Data penilaian berhasil diperbarui');
    }
}