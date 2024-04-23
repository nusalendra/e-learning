<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\KelasSemester;
use App\Models\Periode;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = KelasSemester::with('periode', 'kelas', 'semester')->get();
        return view('pages.wali-kelas.semester.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periode = Periode::all();
        $kelas = Kelas::all();
        return view('pages.wali-kelas.semester.create', compact('periode', 'kelas'));
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
        $semester->nama = $request->nama;
        $semester->save();

        $kelasSemester = new KelasSemester();
        $kelasSemester->periode_id = $request->periode_id;
        $kelasSemester->kelas_id = $request->kelas_id;
        $kelasSemester->semester_id = $semester->id;
        $kelasSemester->save();

        return redirect('/semester');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = KelasSemester::find($id);
        $periode = Periode::all();
        $kelas = Kelas::all();
        return view('pages.wali-kelas.semester.edit', compact('periode', 'kelas', 'data'));
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

        $kelasSemester->periode_id = $request->periode_id;
        $kelasSemester->kelas_id = $request->kelas_id;
        $kelasSemester->semester_id = $semester->id;
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
}
