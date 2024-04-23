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
                            <label for="periode_id" class="form-control-label">Periode</label>
                            <select name="periode_id" id="" class="form-select">
                                <option value="0" selected disabled>Pilih Periode</option>
                                @foreach ($periode as $item)
                                <option value="{{ $item->id }}" {{ $data && $data->periode_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->tahun_ajaran }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelas_id" class="form-control-label">Kelas</label>
                            <select name="kelas_id" id="" class="form-select">
                                <option value="0" selected disabled>Pilih Kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}" {{ $data && $data->kelas_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Semester</label>
                            <input class="form-control" type="text" value="{{ $data->semester->nama }}" placeholder="Masukkan Semester" name="nama">
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