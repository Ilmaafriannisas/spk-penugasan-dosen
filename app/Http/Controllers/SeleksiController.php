<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeleksiController extends Controller
{
    public function index()
    {
        $requestMatkul = request('matkul');
        $query = DB::table('mata_kuliah')
            ->join('dosen', function ($join) {

                $join->whereRaw("
                    dosen.bidang_keahlian LIKE CONCAT('%', mata_kuliah.kategori_bidang, '%')
                ");

            })

            ->join('penilaian_dosen', 'dosen.NIDN', '=', 'penilaian_dosen.nidn')

            ->join('kriteria', 'penilaian_dosen.kode_kriteria', '=', 'kriteria.kode_kriteria')

            ->select(
                'mata_kuliah.kode_matkul',
                'mata_kuliah.nama_matkul',

                'dosen.NIDN',
                'dosen.Nama_Dosen',

                DB::raw('SUM(penilaian_dosen.nilai * kriteria.bobot) as total_nilai')
            )

            ->where('mata_kuliah.kategori_bidang', '!=', 'Pembimbingan')

            ->groupBy(
                'mata_kuliah.kode_matkul',
                'mata_kuliah.nama_matkul',
                'mata_kuliah.kategori_bidang',

                'dosen.NIDN',
                'dosen.Nama_Dosen'
            )

            ->orderBy('mata_kuliah.nama_matkul')
            ->orderByDesc('total_nilai');

            if($requestMatkul)
            {
                $query->where(
                    'mata_kuliah.kode_matkul',
                    $requestMatkul
                );
            }
            $hasil = $query->paginate(10);

            foreach ($hasil as $h) {

            $cek = DB::table('hasil_seleksi')
                ->where('kode_matkul', $h->kode_matkul)
                ->where('nidn', $h->NIDN)
                ->exists();

            $h->status_penugasan = $cek;
        }

        $matkul = DB::table('mata_kuliah')
        ->orderBy('nama_matkul')
        ->get();

        return view(
            'seleksi.index',
            compact('hasil', 'matkul')
        );
    }

    public function tugaskan(Request $request)
    {
        DB::table('hasil_seleksi')->insert([
            'kode_matkul' => $request->kode_matkul,
            'nidn' => $request->nidn
        ]);

        return redirect('/seleksi')
            ->with('success', 'Dosen berhasil ditugaskan');
    }

    public function batalkan(Request $request)
    {
        DB::table('hasil_seleksi')
            ->where('kode_matkul', $request->kode_matkul)
            ->where('nidn', $request->nidn)
            ->delete();

        return redirect('/seleksi')
            ->with('success', 'Penugasan berhasil dibatalkan');
    }

    public function hasilSeleksi(Request $request)
    {
        $query = DB::table('hasil_seleksi')

            ->join(
                'dosen',
                'hasil_seleksi.nidn',
                '=',
                'dosen.NIDN'
            )

            ->join(
                'mata_kuliah',
                'hasil_seleksi.kode_matkul',
                '=',
                'mata_kuliah.kode_matkul'
            )

            ->select(
                'dosen.Nama_Dosen',
                'dosen.NIDN',
                'mata_kuliah.nama_matkul',
                'mata_kuliah.sks'
            );

        if($request->dosen)
        {
            $query->where(
                'hasil_seleksi.nidn',
                $request->dosen
            );
        }

        $hasil = $query->paginate(10);

        $dosen = DB::table('dosen')->get();

        return view(
            'hasil_seleksi',
            compact('hasil','dosen')
        );
    }
}