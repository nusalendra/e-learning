@extends('layouts.user_type.form_admin')

@section('content')
<div class="container-fluid py-4 mt-10">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Tambah Data Wali Kelas</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="/wali-kelas/{{ $data->id }}" method="POST" role="form text-left">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Nama Wali Kelas</label>
                            @if ($data->waliKelas)
                                <input class="form-control" type="text" value="{{ $data->waliKelas->nama }}" placeholder="Masukkan Nama Wali Kelas" name="nama">
                            @else
                                <input class="form-control" type="text" placeholder="Masukkan Nama Wali Kelas" name="nama">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Kelas</label>
                            <select name="kelas_id" id="" class="form-select">
                                <option value="0" selected disabled>Pilih Kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}" {{ $data->waliKelas && $data->waliKelas->kelas_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
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
                    <a href="/wali-kelas" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                    <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection