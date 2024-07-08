@extends('layouts.user_type.wali-kelas.form')

@section('content')
    <div class="container-fluid py-2">
        <div>
            <h3 class="fw-bolder text-black text-center">DETAIL CATATAN SISWA</h3>
        </div>
        <div class="card mt-4">
            <div class="card-body pt-4 p-3">
                <form action="">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="nilai" class="form-control-label fs-6">Nama Siswa</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="nilai"
                                        class="form-control-label fs-6 fw-normal">{{ $data->siswa->nama }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="nilai" class="form-control-label fs-6">Ekstrakulikuler</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="nilai"
                                        class="form-control-label fs-6 fw-normal">{{ $data->ekstrakulikuler->nama }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="nilai" class="form-control-label fs-6">Predikat</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="nilai"
                                        class="form-control-label fs-6 fw-normal">{{ $data->predikat }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row">
                            <div class="col-md-2 mt-1">
                                <div class="form-group">
                                    <label for="nilai" class="form-control-label fs-6">Keterangan</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="nilai"
                                        class="form-control-label fs-6 fw-normal text-justify">{{ $data->keterangan }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/ekstrakulikuler-siswa/{{ $data->id }}/input-catatan-siswa"
                            class="btn bg-gradient-danger btn-md mt-4 mb-4 me-2">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
