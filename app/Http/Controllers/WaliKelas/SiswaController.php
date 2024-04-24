<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\DataOrangTua;
use App\Models\DataSiswa;
use App\Models\KelasSemester;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
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
        $data = Siswa::join('kelas_semester', 'siswa.kelas_semester_id', 'kelas_semester.id')
            ->where('kelas_semester.kelas_id', $kelasId)
            ->where('kelas_semester.status', '=', 'Dibuka')
            ->get();

        return view('pages.wali-kelas.siswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $kelasId = WaliKelas::where('user_id', $user->id)->value('kelas_id');

        $kelasSemester = KelasSemester::where('kelas_id', $kelasId)->get();
        $data = Siswa::where('kelas_semester_id', null)->get();

        return view('pages.wali-kelas.siswa.create', compact('data', 'kelasSemester'));
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
        $data = Siswa::find($id);
        return view('pages.wali-kelas.siswa.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Siswa::find($id);
        return view('pages.wali-kelas.siswa.edit', compact('data'));
    }

    public function tambahSiswa(Request $request, $id) {
        $data = Siswa::find($id);
        $data->kelas_semester_id = $request->kelas_semester_id;
        $data->save();

        return back();
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
        $siswa = Siswa::find($id);
        $siswa->nama = $request->nama;
        $siswa->save();

        $dataSiswa = DataSiswa::where('siswa_id', $siswa->id)->first();
        $dataSiswa->siswa_id = $siswa->id;
        $dataSiswa->NIS = $request->NIS;
        $dataSiswa->NISN = $request->NISN;
        $dataSiswa->jenis_kelamin = $request->jenis_kelamin;
        $dataSiswa->tempat_Lahir = $request->tempat_lahir;
        $dataSiswa->tanggal_lahir = $request->tanggal_lahir;
        $dataSiswa->agama = $request->agama;
        $dataSiswa->pendidikan_sebelumnya = $request->pendidikan_sebelumnya;
        $dataSiswa->alamat = $request->alamat;
        $dataSiswa->save();

        $dataOrangTua = DataOrangTua::where('siswa_id', $siswa->id)->first();
        $dataOrangTua->siswa_id = $siswa->id;
        $dataOrangTua->nama_ayah = $request->nama_ayah;
        $dataOrangTua->nama_ibu = $request->nama_ibu;
        $dataOrangTua->pekerjaan_ayah = $request->pekerjaan_ayah;
        $dataOrangTua->pekerjaan_ibu = $request->pekerjaan_ibu;
        $dataOrangTua->jalan = $request->jalan;
        $dataOrangTua->kelurahan = $request->kelurahan;
        $dataOrangTua->kecamatan = $request->kecamatan;
        $dataOrangTua->kota = $request->kota;
        $dataOrangTua->provinsi = $request->provinsi;
        $dataOrangTua->save();

        return redirect('/siswa');
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
