<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\KelasSemester;
use App\Models\Periode;
use App\Models\Semester;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
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
        $user = Auth::user();
        $waliKelas = WaliKelas::where('user_id', $user->id)->pluck('kelas_id');
        $data = KelasSemester::with('kelas', 'semester')->whereIn('kelas_id', $waliKelas)->get();
        return view('pages.wali-kelas.semester.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $waliKelas = WaliKelas::where('user_id', $user->id)->first();
        return view('pages.wali-kelas.semester.create', compact('waliKelas'));
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
        $user = Auth::user();
        $waliKelas = WaliKelas::where('user_id', $user->id)->first();
        $data = KelasSemester::find($id);

        return view('pages.wali-kelas.semester.edit', compact('data', 'waliKelas'));
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
