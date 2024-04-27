<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\NilaiMataPelajaran;
use App\Models\SiswaMataPelajaran;
use App\Models\UploadTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class UploadTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $data = UploadTugas::whereHas('mataPelajaran', function($query) use ($user){
            $query->where('user_id', $user->id)
            ->whereHas('kelasSemester', function($query) {
                $query->where('status', 'Dibuka');
            });
        })->get();
        
        return view('pages.wali-kelas.upload-tugas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $mataPelajaran = MataPelajaran::where('user_id', $user->id)->get();
        // $siswa = SiswaMataPelajaran::where('mata_pelajaran_id', $mataPelajaran->id)->get();

        return view('pages.wali-kelas.upload-tugas.create', compact('user', 'mataPelajaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->siswa_mata_pelajaran_id);
        $uploadTugas = new UploadTugas();
        $uploadTugas->user_id = $request->user_id;
        $uploadTugas->mata_pelajaran_id = $request->mata_pelajaran_id;
        $uploadTugas->nama_tugas = $request->nama_tugas;
        if ($request->hasFile('upload_tugas')) {
            $file = $request->file('upload_tugas');
            $filename = $uploadTugas->mataPelajaran->nama . '_' . $uploadTugas->nama_tugas . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload_tugas'), $filename);
            $uploadTugas->upload_tugas = $filename;
        }
        $uploadTugas->save();

        $siswa = SiswaMataPelajaran::where('mata_pelajaran_id', $request->mata_pelajaran_id)->get();
        foreach($siswa as $item) {
            NilaiMataPelajaran::create([
                'siswa_mata_pelajaran_id' => $item->id,
                'upload_tugas_id' => $uploadTugas->id
            ]);
        }

        return redirect('/upload-tugas');
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
        $user = Auth::user();
        $data = UploadTugas::find($id);
        $mataPelajaran = MataPelajaran::where('user_id', $user->id)->get();
        
        return view('pages.wali-kelas.upload-tugas.edit', compact('user', 'data', 'mataPelajaran'));
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
        $uploadTugas = UploadTugas::find($id);
        $uploadTugas->user_id = $request->user_id;
        $uploadTugas->mata_pelajaran_id = $request->mata_pelajaran_id;
        $uploadTugas->nama_tugas = $request->nama_tugas;
        if ($request->hasfile('upload_tugas')) {
            if ($uploadTugas->upload_tugas) {
                File::delete('upload_tugas/' . $uploadTugas->upload_tugas);
            }

            $file = $request->file('upload_tugas');
            $filename = $uploadTugas->mataPelajaran->nama . '_' . $uploadTugas->nama_tugas . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload_tugas'), $filename);
            $uploadTugas->upload_tugas = $filename;
        }

        $uploadTugas->save();

        return redirect('/upload-tugas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = UploadTugas::find($id);

        File::delete('upload_tugas/' . $data->upload_tugas);
        $data->delete();

        return redirect('/upload-tugas');
    }

    public function unduhTugas($id) {
        $data = UploadTugas::find($id);
        $file = public_path('upload_tugas/' . $data->upload_tugas);
        
        return Response::download($file);
    }
}
