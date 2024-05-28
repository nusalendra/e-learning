<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakulikuler;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EkstrakulikulerSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Ekstrakulikuler::all();

        return view('pages.wali-kelas.ekstrakulikuler-siswa.index', compact('data'));
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
        $data = Siswa::where('ekstrakulikuler_id', $id)->get();
        $ekstrakulikuler = Ekstrakulikuler::find($id);
        
        return view('pages.wali-kelas.ekstrakulikuler-siswa.show', compact('data', 'ekstrakulikuler'));
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
        
        $ekstrakulikuler = Ekstrakulikuler::find($id);
        $data = Siswa::whereHas('kelasSemester.kelas', function ($query) use ($waliKelas) {
            $query->where('id', $waliKelas->kelas_id);
        })->whereNull('ekstrakulikuler_id')->get();
        
        return view('pages.wali-kelas.ekstrakulikuler-siswa.edit', compact('data', 'ekstrakulikuler'));
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
        $siswa = Siswa::find($request->siswa_id);
        $siswa->ekstrakulikuler_id = $request->ekstrakulikuler_id;
        $siswa->save();

        return redirect('/ekstrakulikuler-siswa/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $siswa = Siswa::find($request->siswa_id);
        $siswa->ekstrakulikuler_id = null;
        $siswa->save();

        return redirect('/ekstrakulikuler-siswa/' . $id);
    }
}
