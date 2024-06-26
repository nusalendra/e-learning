@extends('layouts.user_type.wali-kelas.form')

@section('content')
<div class="container-fluid py-4 mt-10">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Edit Data Semester</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="/semester/{{ $data->id }}" method="POST" role="form text-left">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_kelas" class="form-control-label">Kelas</label>
                            <input type="hidden" name="kelas_id" value="{{ $waliKelas->kelas_id }}">
                            <input class="form-control" type="text" value="{{ $waliKelas->kelas->nama }}" placeholder="Masukkan Semester" name="nama_kelas" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Semester</label>
                            <input class="form-control" type="text" value="{{ $data->semester->nama }}" placeholder="Masukkan Semester" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-control-label">Status Semester</label>
                            <select name="status" id="status" class="form-select">
                                <option value="0" disabled>Pilih Status Semester</option>
                                <option value="Dibuka" {{ $data->status === 'Dibuka' ? 'selected' : '' }}>Dibuka</option>
                                <option value="Ditutup" {{ $data->status === 'Ditutup' ? 'selected' : '' }}>Ditutup</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/semester" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                    <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection