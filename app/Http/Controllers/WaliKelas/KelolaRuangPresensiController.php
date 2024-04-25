<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\KelasSemester;
use App\Models\RuangPresensi;
use Illuminate\Http\Request;

class KelolaRuangPresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RuangPresensi::whereHas('kelasSemester', function($query) {
            $query->where('status', 'Dibuka');
        })
        ->get();

        return view('pages.wali-kelas.kelola-ruang-presensi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $semester = KelasSemester::where('status', '=', 'Dibuka')->get();

        return view('pages.wali-kelas.kelola-ruang-presensi.create', compact('semester'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ruangPresensi = new RuangPresensi();
        $ruangPresensi->kelas_semester_id = $request->semester_id;
        $ruangPresensi->tanggal_presensi = $request->tanggal_presensi;
        $ruangPresensi->save();

        return redirect('/kelola-ruang-presensi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = RuangPresensi::find($id);
        $semester = KelasSemester::where('status', '=', 'Dibuka')->get();

        return view('pages.wali-kelas.kelola-ruang-presensi.edit', compact('data', 'semester'));
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
        $ruangPresensi = RuangPresensi::find($id);
        $ruangPresensi->kelas_semester_id = $request->semester_id;
        $ruangPresensi->tanggal_presensi = $request->tanggal_presensi;
        $ruangPresensi->save();

        return redirect('/kelola-ruang-presensi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ruangPresensi = RuangPresensi::find($id);
        $ruangPresensi->delete();

        return redirect('/kelola-ruang-presensi');
    }
}
