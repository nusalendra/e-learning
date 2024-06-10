<?php

namespace App\Http\Controllers\WaliKelas;

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

class MataPelajaranController extends Controller
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
        $data = MataPelajaran::whereHas('kelasSemester', function($query) use ($kelasId) {
                $query->where('status', 'Dibuka');
                $query->where('kelas_id', $kelasId);
            })
            ->get();
            
        return view('pages.wali-kelas.mata-pelajaran.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $kategori = Kategori::all();
        $semester = KelasSemester::where('status', '=', 'Dibuka')->get();
        $pengajar = User::where('role', '!=', 'Kepala Sekolah')
                        ->where(function($query) use ($user) {
                            $query->where('role', 'Wali Kelas')
                                ->where('id', $user->id);
                        })
                        ->orWhere('role', 'Guru')
                        ->get();

        $kelasId = WaliKelas::where('user_id', $user->id)->value('kelas_id');
        $siswa = Siswa::whereHas('kelasSemester', function($query) use ($kelasId) {
            $query->where('status', 'Dibuka');
            $query->where('kelas_id', $kelasId);
        })->get();
                        
        return view('pages.wali-kelas.mata-pelajaran.create', compact('pengajar', 'kategori', 'semester', 'siswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mataPelajaran = new MataPelajaran();
        $mataPelajaran->kelas_semester_id = $request->semester_id;
        $mataPelajaran->user_id = $request->user_id;
        $mataPelajaran->kategori_id = $request->kategori_id;
        $mataPelajaran->nama = $request->nama;

        $mataPelajaran->save();

        if($request->siswa_id) {
            foreach($request->siswa_id as $siswaId) {
                SiswaMataPelajaran::updateOrCreate(
                    ['siswa_id' => $siswaId, 'mata_pelajaran_id' => $mataPelajaran->id],
                    ['siswa_id' => $siswaId, 'mata_pelajaran_id' => $mataPelajaran->id]
                );
            }
        }

        return redirect('/mata-pelajaran');
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

        return view('pages.wali-kelas.mata-pelajaran.show', compact('data', 'mataPelajaran', 'kelasSemester'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = MataPelajaran::find($id);
        $user = Auth::user();
        $kategori = Kategori::all();
        $semester = KelasSemester::where('status', '=', 'Dibuka')->get();
        $pengajar = User::where('role', '!=', 'Kepala Sekolah')
                        ->where(function($query) use ($user) {
                            $query->where('role', 'Wali Kelas')
                                ->where('id', $user->id);
                        })
                        ->orWhere('role', 'Guru')
                        ->get();
                        
        return view('pages.wali-kelas.mata-pelajaran.edit', compact('data', 'pengajar', 'kategori', 'semester'));
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
        $mataPelajaran = MataPelajaran::find($id);
        $mataPelajaran->kelas_semester_id = $request->semester_id;
        $mataPelajaran->user_id = $request->user_id;
        $mataPelajaran->kategori_id = $request->kategori_id;
        $mataPelajaran->nama = $request->nama;

        $mataPelajaran->save();

        return redirect('/mata-pelajaran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mataPelajaran = MataPelajaran::find($id);
        $mataPelajaran->delete();

        return redirect('/mata-pelajaran');
    }

    public function pageInputNilai($id) {
        $data = SiswaMataPelajaran::find($id);
        $uploadTugas = UploadTugas::where('mata_pelajaran_id', $data->mata_pelajaran_id)->get();
        $nilaiMataPelajaran = NilaiMataPelajaran::where('siswa_mata_pelajaran_id', $id)->get();
        
        return view('pages.wali-kelas.mata-pelajaran.input-nilai', compact('data', 'uploadTugas', 'nilaiMataPelajaran'));
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
