<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\CapaianKompetensi;
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

class CapaianKompetensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $kelasId = WaliKelas::where('user_id', $user->id)->pluck('kelas_id');
        $data = Siswa::whereHas('kelasSemester', function ($query) use ($kelasId) {
            $query->where('status', 'Dibuka');
            $query->where('kelas_id', $kelasId);
        })
        ->get();

        return view('pages.wali-kelas.capaian-kompetensi.index', compact('data'));
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
        // $data = SiswaMataPelajaran::where('siswa_id', $id)->get();

        $data = NilaiMataPelajaran::whereHas('siswaMataPelajaran', function ($query) use ($id) {
            $query->where('siswa_id', $id);
        })->get();
        
        return view('pages.wali-kelas.capaian-kompetensi.show', compact('data', 'mataPelajaran', 'kelasSemester'));
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
    public function destroy($id, Request $request)
    {
        $capaianKompetensi = CapaianKompetensi::find($id);
        $capaianKompetensi->delete();

        return redirect()->route('page-input-capaian-kompetensi', ['id' => $request->nilai_mata_pelajaran_id]);
    }

    public function pageCapaianKompetensi($id)
    {
        $nilaiMataPelajaran = NilaiMataPelajaran::find($id);
        $capaianKompetensi = CapaianKompetensi::where('nilai_mata_pelajaran_id', $id)->get();

        return view('pages.wali-kelas.capaian-kompetensi.input-capaian-kompetensi', compact('nilaiMataPelajaran', 'capaianKompetensi'));
    }

    public function inputCapaianKompetensiStore(Request $request)
    {
        $capaianKompetensi = new CapaianKompetensi();
        $capaianKompetensi->nilai_mata_pelajaran_id = $request->nilai_mata_pelajaran_id;
        $capaianKompetensi->catatan = $request->catatan;
        $capaianKompetensi->save();

        return redirect()->route('page-input-capaian-kompetensi', ['id' => $request->nilai_mata_pelajaran_id]);
    }

    public function pageShowCapaianKompetensi($id)
    {
        $capaianKompetensi = CapaianKompetensi::find($id);

        return view('pages.wali-kelas.capaian-kompetensi.show-capaian-kompetensi', compact('capaianKompetensi'));
    }
}
