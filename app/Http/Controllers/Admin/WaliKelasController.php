<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\User;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WaliKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('role', '=', 'Wali Kelas')->with('waliKelas')->get();
        return view('pages.admin.wali-kelas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('pages.admin.wali-kelas.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = 'Wali Kelas';
        
        $user->save();

        $userId = $user->getKey();

        $waliKelas = new WaliKelas();
        $waliKelas->user_id = $userId;
        $waliKelas->kelas_id = $request->kelas_id;
        $waliKelas->nama = $request->nama;

        $waliKelas->save();

        return redirect('/wali-kelas');
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
        $data = User::with('waliKelas')->find($id);
        $kelas = Kelas::all();

        return view('pages.admin.wali-kelas.edit', compact('data', 'kelas'));
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
        $user = User::find($id);
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        
        $user->save();
        
        $userId = $user->getKey();
        
        WaliKelas::updateOrCreate(
            ['user_id' => $userId],
            ['kelas_id' => $request->kelas_id, 'nama' => $request->nama]
        );

        return redirect('/wali-kelas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id);

        $data->delete();

        return redirect('/wali-kelas');
    }
}
