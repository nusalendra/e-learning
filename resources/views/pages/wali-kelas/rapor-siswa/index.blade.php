@extends('layouts.user_type.wali-kelas.auth')

@section('content')
    <div>
        <div class="py-1">
            <div class="card mb-4 p-3">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="myTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                                    <th class="text-uppercase text-xs font-weight-bolder">Nama Siswa</th>
                                    <th class="text-uppercase text-xs font-weight-bolder">Status Rapor</th>
                                    <th class="text-uppercase text-xs font-weight-bolder">Status Siswa</th>
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
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $item->kelasSemester->kelas->nama }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $item->kelasSemester->semester->nama }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="ms-2 d-flex flex-column justify-content-center">
                                                    <form action="/rapor-siswa/{{ $item->id }}" method="POST"
                                                        role="form text-left">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="lulus" value="1">
                                                        <button type="submit" class="btn bg-gradient-info">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-arrow-up mb-1" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd"
                                                                    d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5" />
                                                            </svg>
                                                            Lulus
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="ms-2 d-flex flex-column justify-content-center">
                                                    <form action="/rapor-siswa/{{ $item->id }}" method="POST"
                                                        role="form text-left">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="tidak_lulus" value="1">
                                                        <button type="submit" class="btn bg-gradient-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-arrow-down mb-1" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd"
                                                                    d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                                            </svg>
                                                            Tidak Lulus
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="ms-2 d-flex flex-column justify-content-center">
                                                    <form action="/rapor-siswa/{{ $item->id }}" method="POST"
                                                        role="form text-left">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="tidak_lulus" value="1">
                                                        <button type="submit" class="btn bg-gradient-dark">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-arrow-down mb-1" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd"
                                                                    d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                                            </svg>
                                                            Unduh Rapor
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                        <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
                        <script>
                            let table = new DataTable('#myTable');
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
