@extends('layouts.user_type.kepala-sekolah.form')

@section('content')
<div class="container-fluid py-4 mt-10">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Tambah Data Wali Kelas</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="/wali-kelas" method="POST" role="form text-left">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Nama Wali Kelas <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" placeholder="Masukkan Nama Wali Kelas" name="name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Kelas <span class="text-danger">*</span></label>
                            <select name="kelas_id" id="" class="form-select">
                                <option value="0" selected disabled>Pilih Kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username" class="form-control-label">Nama User <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" placeholder="Masukkan Nama User Untuk Login" name="username" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="form-control-label">Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" placeholder="Masukkan Password" name="password" required>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/kelas" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                    <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Tambah' }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection