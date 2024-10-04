@extends('layouts.user_type.kepala-sekolah.form')

@section('content')
<div class="container-fluid py-4 mt-5">
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
                            <label for="tahun_ajaran" class="form-control-label">Tahun Ajaran <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" placeholder="Masukkan Tahun Ajaran" name="tahun_ajaran" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_mulai" class="form-control-label">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input class="form-control" type="date" placeholder="Masukkan Tanggal Mulai" name="tanggal_mulai" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_akhir" class="form-control-label">Tanggal Akhir <span class="text-danger">*</span></label>
                            <input class="form-control" type="date" placeholder="Masukkan Tanggal Mulai" name="tanggal_akhir" required>
                        </div>
                        <div class="form-group">
                            <label for="kelas_id" class="form-control-label">Kelas <span class="text-danger">*</span></label>
                            <select name="kelas_id" id="" class="form-select">
                                <option value="0" selected disabled>Pilih Kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Semester <span class="text-danger">*</span></label>
                            <select name="nama" id="" class="form-select">
                                <option value="0" selected disabled>Pilih Semester</option>
                                <option value="Gasal">Gasal</option>
                                <option value="Genap">Genap</option>
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