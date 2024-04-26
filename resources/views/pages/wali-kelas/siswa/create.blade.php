@extends('layouts.user_type.wali-kelas.form')

@section('content')
    <div>
        <div class="py-1">
            <div class="card mb-4 p-3">
                <div class="py-2 px-1">
                    <h6 class="mb-0 fs-5">Penambahan Siswa ke Kelas</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2 mt-3">
                    <div class="table-responsive p-0">
                        <table id="myTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                                    <th class="text-uppercase text-xs font-weight-bolder">Nama Siswa</th>
                                    <th class="text-uppercase text-xs font-weight-bolder">Kelas</th>
                                    <th class="text-uppercase text-xs font-weight-bolder">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $index + 1 }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $item->nama }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        @if($item->kelas_semester_id == null)
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm text-danger">Belum Ditentukan</h6>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="ms-2 d-flex flex-column justify-content-center">
                                                    <form action="/siswa/{{ $item->id }}/tambah-siswa" method="POST" role="form text-left">
                                                        @csrf
                                                        @method('PUT')
                                                        @foreach ($mataPelajaran as $item)
                                                            <input type="hidden" name="mata_pelajaran_id[]" value="{{ $item->id }}">
                                                        @endforeach
                                                        @foreach ($kelasSemester as $item)
                                                        @if($item->status == 'Dibuka')
                                                                <input type="hidden" name="kelas_semester_id" value="{{ $item->id }}">
                                                                <button type="submit" class="btn bg-gradient-warning">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                                                    </svg>
                                                                    Tambahkan ke {{ $item->kelas->nama }} {{ $item->semester->nama }}
                                                                </button>
                                                            @endif
                                                        @endforeach
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                        <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
                        <script>let table = new DataTable('#myTable');</script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
