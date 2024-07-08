<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\KelasSemester;
use App\Models\NilaiMataPelajaran;
use App\Models\Siswa;
use App\Models\SiswaMataPelajaran;
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

        $nilaiAkhir = [];

        foreach ($data as $item) {
            // Menghitung total nilai berdasarkan siswa_mata_pelajaran_id
            $totalNilai = NilaiMataPelajaran::where('siswa_mata_pelajaran_id', $item->id)
                ->sum('nilai');

            // Menghitung total upload tugas
            $totalUploadTugas = NilaiMataPelajaran::where('siswa_mata_pelajaran_id', $item->id)
                ->distinct('upload_tugas_id')
                ->count('upload_tugas_id');

            // Menghitung nilai akhir dengan membagi total nilai dengan total upload tugas
            $nilaiAkhir[$item->id] = $totalUploadTugas > 0 ? $totalNilai / $totalUploadTugas : 0;
        }

        $pdf = Pdf::loadView('pages.kepala-sekolah.validasi-rapor.show-rapor-pdf', [
            'siswa' => $siswa,
            'data' => $data,
            'nilaiAkhir' => $nilaiAkhir
        ])
            ->setPaper('a4', 'portrait');

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
