<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\User;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TenagaPengajarController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('pages.kepala-sekolah.tenaga-pengajar.index', compact('data'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('pages.kepala-sekolah.tenaga-pengajar.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $jabatan = $request->role;

        $user = new User();
        if ($jabatan == 'Wali Kelas') {
            $user->name = $request->name;
            $user->NIP = $request->NIP;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->TTL = $request->TTL;
            $user->alamat = $request->alamat;
            $user->agama = $request->agama;
            $user->role = $jabatan;

            $user->save();

            $userId = $user->getKey();

            $waliKelas = new WaliKelas();
            $waliKelas->user_id = $userId;
            $waliKelas->kelas_id = $request->kelas_id;

            $waliKelas->save();
        } else {
            $user->name = $request->name;
            $user->NIP = $request->NIP;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->TTL = $request->TTL;
            $user->alamat = $request->alamat;
            $user->agama = $request->agama;
            $user->role = $jabatan;

            $user->save();
        }

        return redirect('/tenaga-pengajar');
    }

    public function show($id) {
        $data = User::find($id);
        return view('pages.kepala-sekolah.tenaga-pengajar.show', compact('data'));
    }

    public function edit($id)
    {
        $data = User::find($id);
        $kelas = Kelas::all();
        return view('pages.kepala-sekolah.tenaga-pengajar.edit', compact('data', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        if ($user->role == 'Wali Kelas') {
            $user->name = $request->name;
            $user->NIP = $request->NIP;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->TTL = $request->TTL;
            $user->alamat = $request->alamat;
            $user->agama = $request->agama;

            $user->save();

            $userId = $user->getKey();

            WaliKelas::updateOrCreate(
                ['user_id' => $userId],
                ['kelas_id' => $request->kelas_id]
            );
        } else {
            $user->name = $request->name;
            $user->NIP = $request->NIP;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->TTL = $request->TTL;
            $user->alamat = $request->alamat;
            $user->agama = $request->agama;

            $user->save();
        }

        return redirect('/tenaga-pengajar');
    }

    public function destroy($id) {
        $data = User::find($id);

        $data->delete();

        return redirect('/tenaga-pengajar');
    }
}
