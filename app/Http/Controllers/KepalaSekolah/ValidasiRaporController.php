<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\EkstrakulikulerSiswa;
use App\Models\KelasSemester;
use App\Models\NilaiMataPelajaran;
use App\Models\Presensi;
use App\Models\RuangPresensi;
use App\Models\Siswa;
use App\Models\SiswaMataPelajaran;
use App\Models\WaliKelas;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ValidasiRaporController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = KelasSemester::where('status', 'Dibuka')->get();

        return view('pages.kepala-sekolah.validasi-rapor.index', compact('data'));
    }

    public function checkRaporPDF($id)
    {
        $siswa = Siswa::find($id);
        $data = SiswaMataPelajaran::where('siswa_id', $siswa->id)->get();
        $ekstrakulikuler = EkstrakulikulerSiswa::where('siswa_id', $siswa->id)->get();
        $waliKelas = WaliKelas::where('kelas_id', $siswa->kelasSemester->kelas_id)->first();

        $countSakit = Presensi::where('siswa_id', $siswa->id)
            ->whereHas('ruangPresensi', function ($query) use ($siswa) {
                $query->where('kelas_semester_id', $siswa->kelas_semester_id);
            })
            ->where('status_presensi', 'Sakit')
            ->count();

        $countIzin = Presensi::where('siswa_id', $siswa->id)
            ->whereHas('ruangPresensi', function ($query) use ($siswa) {
                $query->where('kelas_semester_id', $siswa->kelas_semester_id);
            })
            ->where('status_presensi', 'Izin')
            ->count();

        $countTanpaKeterangan = Presensi::where('siswa_id', $siswa->id)
            ->whereHas('ruangPresensi', function ($query) use ($siswa) {
                $query->where('kelas_semester_id', $siswa->kelas_semester_id);
            })
            ->where('status_presensi', 'Tanpa Keterangan')
            ->count();

        $siswa->countSakit = $countSakit;
        $siswa->countIzin = $countIzin;
        $siswa->countTanpaKeterangan = $countTanpaKeterangan;

        $pdf = Pdf::loadView('pages.kepala-sekolah.validasi-rapor.show-rapor-pdf', [
            'siswa' => $siswa,
            'data' => $data,
            'ekstrakulikuler' => $ekstrakulikuler,
            'waliKelas' => $waliKelas
        ])->setPaper('a4', 'potrait');

        return $pdf->stream('rapor.pdf');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelasSemester = KelasSemester::find($id);
        $data = Siswa::where('kelas_semester_id', '=', $kelasSemester->id)->get();

        return view('pages.kepala-sekolah.validasi-rapor.show', compact('data', 'kelasSemester'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
