<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\KelasSemester;
use App\Models\Semester;
use App\Models\WaliKelas;
use Illuminate\Support\Facades\Auth;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = KelasSemester::with('kelas', 'semester')->get();
        return view('pages.kepala-sekolah.semester.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('pages.kepala-sekolah.semester.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $semester = new Semester();
        $semester->tahun_ajaran = $request->tahun_ajaran;
        $semester->nama = $request->nama;
        $semester->tanggal_mulai = $request->tanggal_mulai;
        $semester->tanggal_akhir = $request->tanggal_akhir;
        $semester->save();

        $kelasSemester = new KelasSemester();
        $kelasSemester->kelas_id = $request->kelas_id;
        $kelasSemester->semester_id = $semester->id;
        $kelasSemester->status = 'Non Aktif';
        $kelasSemester->save();

        return redirect('/semester');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $waliKelas = WaliKelas::where('user_id', $user->id)->first();
        $data = KelasSemester::find($id);

        return view('pages.kepala-sekolah.semester.edit', compact('data', 'waliKelas'));
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
        $kelasSemester = KelasSemester::find($id);

        $semester = Semester::where('id', $kelasSemester->semester_id)->first();
        $semester->nama = $request->nama;
        $semester->save();

        $kelasSemester->kelas_id = $request->kelas_id;
        $kelasSemester->semester_id = $semester->id;
        $kelasSemester->status = $request->status;
        $kelasSemester->save();

        return redirect('/semester');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelasSemester = KelasSemester::find($id);
        $kelasSemester->delete();

        return redirect('/semester');
    }

    public function ubahStatus(Request $request, $id)
    {
        $kelasSemester = KelasSemester::find($id);
        $kelasSemester->status = $request->status;
        $kelasSemester->save();

        return redirect('/semester');
    }
}
