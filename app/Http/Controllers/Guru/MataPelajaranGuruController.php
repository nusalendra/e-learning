<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\KelasSemester;
use App\Models\MataPelajaran;
use App\Models\NilaiMataPelajaran;
use App\Models\Siswa;
use App\Models\SiswaMataPelajaran;
use App\Models\UploadTugas;
use App\Models\User;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MataPelajaranGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user(); 
        $data = MataPelajaran::where('user_id', $user->id)->whereHas('kelasSemester', function($query) {
            $query->where('status', 'Dibuka');
        })->get();
            
        return view('pages.guru.mata-pelajaran.index', compact('data'));
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
        $user = Auth::user();
        $mataPelajaran = MataPelajaran::find($id);
        $kelasId = WaliKelas::where('user_id', $user->id)->value('kelas_id');

        $kelasSemester = KelasSemester::where('kelas_id', $kelasId)->get();
        $data = SiswaMataPelajaran::where('mata_pelajaran_id', $id)->get();

        return view('pages.guru.mata-pelajaran.show', compact('data', 'mataPelajaran', 'kelasSemester'));
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

    public function pageInputNilai($id) {
        $data = SiswaMataPelajaran::find($id);
        $uploadTugas = UploadTugas::where('mata_pelajaran_id', $data->mata_pelajaran_id)->get();
        $nilaiMataPelajaran = NilaiMataPelajaran::where('siswa_mata_pelajaran_id', $id)->get();
        
        return view('pages.guru.mata-pelajaran.input-nilai', compact('data', 'uploadTugas', 'nilaiMataPelajaran'));
    }

    public function inputNilaiStore(Request $request) {
        foreach($request->upload_tugas_id as $uploadTugas) {
            $nilai = 'nilai_' . $uploadTugas;
            NilaiMataPelajaran::updateOrCreate(
                ['siswa_mata_pelajaran_id' => $request->siswa_mata_pelajaran_id, 'upload_tugas_id' => $uploadTugas],
                ['nilai' => $request->$nilai]
            );
        }

        return redirect()->route('mata-pelajaran.show', ['mata_pelajaran' => $request->siswa_id]);
    }
}
