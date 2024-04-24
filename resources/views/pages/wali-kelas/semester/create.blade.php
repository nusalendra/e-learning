@extends('layouts.user_type.wali-kelas.form')

@section('content')
<div class="container-fluid py-4 mt-10">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Tambah Data Semester</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="/semester" method="POST" role="form text-left">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_kelas" class="form-control-label">Kelas <span class="text-danger">*</span></label>
                            <input type="hidden" name="kelas_id" value="{{ $waliKelas->kelas_id }}">
                            <input class="form-control" type="text" value="{{ $waliKelas->kelas->nama }}" placeholder="Masukkan Semester" name="nama_kelas" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Semester <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" placeholder="Masukkan Semester" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-control-label">Status Semester <span class="text-danger">*</span></label>
                            <select name="status" id="" class="form-select">
                                <option value="0" selected disabled>Pilih Status Semester</option>
                                <option value="Dibuka">Dibuka</option>
                                <option value="Ditutup">Ditutup</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/semester" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                    <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Tambah' }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection