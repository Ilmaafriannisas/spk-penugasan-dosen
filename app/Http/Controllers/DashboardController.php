<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDosen = DB::table('dosen')->count();
        $totalMatkul = DB::table('mata_kuliah')->count();
        $totalKriteria = DB::table('kriteria')->count();
        $totalPenugasan = DB::table('hasil_seleksi')->count();

        $ringkasan = DB::table('hasil_seleksi')
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
                DB::raw('SUM(mata_kuliah.sks) as total_sks')
            )

            ->groupBy(
                'dosen.NIDN',
                'dosen.Nama_Dosen'
            )

            ->orderByDesc('total_sks')

            ->get();

        return view(
            'dashboard',
            compact(
                'totalDosen',
                'totalMatkul',
                'totalKriteria',
                'totalPenugasan',
                'ringkasan'
            )
        );
    }
}