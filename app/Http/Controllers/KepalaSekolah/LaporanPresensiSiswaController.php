<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\KelasSemester;
use App\Models\Presensi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class LaporanPresensiSiswaController extends Controller
{
    public function index()
    {
        $data = KelasSemester::where('status', 'Dibuka')->get();

        return view('pages.kepala-sekolah.laporan-presensi-siswa.index', compact('data'));
    }

    public function show($id)
    {
        $kelasSemester = KelasSemester::find($id);
        $data = Siswa::where('kelas_semester_id', '=', $kelasSemester->id)->get();
        foreach ($data as $siswa) {
            $countSakit = Presensi::where('siswa_id', $siswa->id)
                ->whereHas('ruangPresensi', function ($query) use ($id) {
                    $query->where('kelas_semester_id', $id);
                })
                ->where('status_presensi', 'Sakit')
                ->count();

            $countIzin = Presensi::where('siswa_id', $siswa->id)
                ->whereHas('ruangPresensi', function ($query) use ($id) {
                    $query->where('kelas_semester_id', $id);
                })
                ->where('status_presensi', 'Izin')
                ->count();

            $countTanpaKeterangan = Presensi::where('siswa_id', $siswa->id)
                ->whereHas('ruangPresensi', function ($query) use ($id) {
                    $query->where('kelas_semester_id', $id);
                })
                ->where('status_presensi', 'Tanpa Keterangan')
                ->count();

            $siswa->countSakit = $countSakit;
            $siswa->countIzin = $countIzin;
            $siswa->countTanpaKeterangan = $countTanpaKeterangan;
        }

        return view('pages.kepala-sekolah.laporan-presensi-siswa.show', compact('data', 'kelasSemester'));
    }
}
