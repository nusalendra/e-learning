<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\KelasSemester;
use App\Models\MataPelajaran;
use App\Models\NilaiMataPelajaran;
use App\Models\Siswa;
use App\Models\SiswaMataPelajaran;
use App\Models\UploadTugas;
use Illuminate\Http\Request;

class LaporanNilaiSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = KelasSemester::where('status', 'Dibuka')->get();
        // dd($data);

        return view('pages.kepala-sekolah.laporan-nilai-siswa.index', compact('data'));
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

        return view('pages.kepala-sekolah.laporan-nilai-siswa.show', compact('data', 'kelasSemester'));
    }

    public function mataPelajaranShow($id)
    {
        $siswa = Siswa::find($id);
        $data = SiswaMataPelajaran::where('siswa_id', '=', $siswa->id)->get();

        return view('pages.kepala-sekolah.laporan-nilai-siswa.mata-pelajaran-show', compact('data', 'siswa'));
    }

    public function nilaiSiswaShow($id)
    {
        $data = SiswaMataPelajaran::find($id);
        $mataPelajaranId = MataPelajaran::where('id', $data->mata_pelajaran_id)->value('id');
        $uploadTugas = UploadTugas::where('mata_pelajaran_id', $data->mata_pelajaran_id)->get();
        $nilaiMataPelajaran = NilaiMataPelajaran::where('siswa_mata_pelajaran_id', $id)->get();

        return view('pages.kepala-sekolah.laporan-nilai-siswa.nilai-siswa-show', compact('data', 'uploadTugas', 'nilaiMataPelajaran', 'mataPelajaranId'));
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
