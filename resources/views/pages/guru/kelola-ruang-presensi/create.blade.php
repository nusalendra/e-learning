@extends('layouts.user_type.guru.form')

@section('content')
<div class="container-fluid py-4 mt-10">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Tambah Data Presensi</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="/kelola-ruang-presensi-guru" method="POST" role="form text-left">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="semester_id" class="form-control-label">Semester <span class="text-danger">*</span></label>
                            <select name="semester_id" id="" class="form-select">
                                @foreach ($semester as $item)
                                    <option value="{{ $item->id }}">{{ $item->semester->nama }} - {{ $item->kelas->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_presensi" class="form-control-label">Tanggal Presensi <span class="text-danger">*</span></label>
                            <input class="form-control" type="date" placeholder="Masukkan Tanggal Presensi" name="tanggal_presensi" required>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/kelola-ruang-presensi-guru" class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                    <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Tambah' }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection