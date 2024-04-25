<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\RuangPresensi;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $kelasId = WaliKelas::where('user_id', $user->id)->value('kelas_id');
        $data = RuangPresensi::whereHas('kelasSemester', function($query) use ($kelasId) {
            $query->where('status', 'Dibuka');
            $query->where('kelas_id', '=', $kelasId);
        })
        ->get();

        return view('pages.wali-kelas.presensi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request->siswa_id as $index => $siswaId) {
            Presensi::updateOrCreate(
                ['siswa_id' => $siswaId],
                [
                    'ruang_presensi_id' => $request->ruang_presensi_id,
                    'status_presensi' => $request->status_presensi[$index]
                ]
            );
        }

        return redirect('/presensi');
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
        $ruangPresensi = RuangPresensi::find($id);
        $user = Auth::user();
        $kelasId = WaliKelas::where('user_id', $user->id)->value('kelas_id');
        $siswa = Siswa::whereHas('kelasSemester', function($query) use ($kelasId) {
            $query->where('kelas_id', '=', $kelasId);
        })->get();
        
        return view('pages.wali-kelas.presensi.presensi-siswa', compact('ruangPresensi', 'siswa'));
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
