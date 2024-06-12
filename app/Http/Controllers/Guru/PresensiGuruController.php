<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\RuangPresensi;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $data = RuangPresensi::where('user_id', $user->id)->whereHas('kelasSemester', function($query) {
            $query->where('status', 'Dibuka');
        })
        ->get();

        return view('pages.guru.presensi.index', compact('data'));
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
        $ruangPresensi = RuangPresensi::where('user_id', $request->user()->id)
            ->where('id', $request->ruang_presensi_id)
            ->first();

        if ($ruangPresensi) {
            foreach ($request->siswa_id as $index => $siswaId) {
                Presensi::updateOrCreate(
                    [
                        'siswa_id' => $siswaId,
                        'ruang_presensi_id' => $ruangPresensi->id
                    ],
                    [
                        'status_presensi' => $request->status_presensi[$index]
                    ]
                );
            }
        } else {
            return response()->json(['error' => 'Ruang presensi tidak ditemukan atau tidak dimiliki oleh user saat ini.'], 404);
        }

        return redirect('/presensi-guru');
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
        
        $siswa = Siswa::whereHas('kelasSemester', function($query) use ($ruangPresensi) {
            $query->where('kelas_id', '=', $ruangPresensi->kelasSemester->kelas->id);
        })->get();
        
        return view('pages.guru.presensi.presensi-siswa', compact('ruangPresensi', 'siswa'));
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
