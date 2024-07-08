<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Hasil Belajar (Rapor)</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        header {
            text-align: center;
            margin-bottom: 10px;
        }

        h1 {
            font-size: 2rem; 
            font-weight: bold;
            border-bottom: 2px solid #343a40;
            display: inline-block;
            padding-bottom: 10px;
        }

        h2.small-margin {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .info-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 8px;
            vertical-align: top;
        }

        .info-table td:nth-child(odd) {
            font-weight: bold;
        }

        .info-table td:nth-child(even) {
            padding-right: 20px;
        }

        .table-bordered {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .table-bordered th {
            background-color: white;
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <h2 class="small-margin">LAPORAN HASIL BELAJAR</h2>
        <h2 class="small-margin">(RAPOR)</h2>
    </header>
    <div class="container">
        <table class="info-table">
            <tr>
                <td>Nama Peserta Didik</td>
                <td>: Aulia Nia Ramadani</td>
                <td>Kelas</td>
                <td>: IV (Empat)</td>
            </tr>
            <tr>
                <td>NISN</td>
                <td>: 3133717078</td>
                <td>Fase</td>
                <td>: A</td>
            </tr>
            <tr>
                <td>Sekolah</td>
                <td>: SD Negeri 009 Marangkayu</td>
                <td>Semester</td>
                <td>: II (Dua)</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: Jl. Batu Menetes</td>
                <td>Tahun Pelajaran</td>
                <td>: 2022 / 2023</td>
            </tr>
        </table>
        <div class="table-responsive">
            <table class="table mt-4 table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Nilai Akhir</th>
                        <th>Capaian Kompetensi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->mataPelajaran->nama }}</td>
                            <td>{{ $nilaiAkhir }}</td>
                            <td>tes</td>
                        </tr>
                    @endforeach
                </tbody>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Nilai Akhir</th>
                        <th>Capaian Kompetensi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</body>

</html>
