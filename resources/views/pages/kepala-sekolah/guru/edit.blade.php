@extends('layouts.user_type.kepala-sekolah.form')

@section('content')
<div class="container-fluid py-4 mt-10">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Tambah Data Wali Kelas</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="/guru/{{ $data->id }}" method="POST" role="form text-left">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Nama Guru <span class="text-danger">*</span></label>
                            <input class="form-control" value="{{ $data->name }}" type="text" placeholder="Masukkan Nama Wali Kelas" name="name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role" class="form-control-label">Jabatan <span class="text-danger">*</span></label>
                            <select name="role" id="" class="form-select">
                                <option value="Guru">Guru</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username" class="form-control-label">Nama User</label>
                            <input class="form-control" type="text" value="{{ $data->username }}" placeholder="Masukkan Nama User Untuk Login" name="username">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="form-control-label">Ubah Password</label>
                            <input class="form-control" type="password" placeholder="Masukkan Password Baru" name="password">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/guru" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                    <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection