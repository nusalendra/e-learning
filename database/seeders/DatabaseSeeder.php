<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call([
        //     UserSeeder::class
        // ]);

        DB::table('users')->insert([
            'name' => 'Nusalendra Putra Restu Bumi',
            'NIP' => '197505261998072002',
            'username' => 'ezra',
            'password' => Hash::make('ezra123'),
            'TTL' => 'Denpasar, 17 Oktober 1998',
            'tanggal' => '22 Desember 1999',
            'alamat' => 'Perumahan Denpasar No. 1',
            'agama' => 'Islam',
            'role' => 'Kepala Sekolah'
        ]);

        // DB::table('users')->insert([
        //     'name' => 'Budi Setyo',
        //     'NIP' => '198205172008012015',
        //     'username' => 'budisetyo',
        //     'password' => Hash::make('password'),
        //     'role' => 'Wali Kelas'
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'Arif',
        //     'NIP' => '198205172008012015',
        //     'username' => 'arif',
        //     'password' => Hash::make('password'),
        //     'role' => 'Guru'
        // ]);

        // DB::table('periode')->insert([
        //     'tahun_ajaran' => '2021 - 2022',
        // ]);

        DB::table('kelas')->insert([
            'nama' => 'I (Satu)',
        ]);

        DB::table('kelas')->insert([
            'nama' => 'II (Dua)',
        ]);

        // DB::table('wali_kelas')->insert([
        //     'user_id' => 2,
        //     'kelas_id' => 1,
        // ]);

        // DB::table('semester')->insert([
        //     'nama' => 'I (Satu)',
        // ]);

        // DB::table('kelas_semester')->insert([
        //     'kelas_id' => 1,
        //     'semester_id' => 1,
        //     'status' => 'Dibuka'
        // ]);

        // DB::table('semester')->insert([
        //     'nama' => 'II (Dua)',
        // ]);

        // DB::table('kelas_semester')->insert([
        //     'kelas_id' => 1,
        //     'semester_id' => 2,
        //     'status' => 'Ditutup'
        // ]);

        // DB::table('kategori')->insert([
        //     'nama' => 'Mata Pelajaran',
        // ]);

        // DB::table('kategori')->insert([
        //     'nama' => 'Muatan Pelajaran',
        // ]);

        // DB::table('ekstrakulikuler')->insert([
        //     'nama' => 'Pramuka',
        // ]);

        // DB::table('ekstrakulikuler')->insert([
        //     'nama' => 'Sepak Bola',
        // ]);

        // DB::table('ekstrakulikuler')->insert([
        //     'nama' => 'Bulu Tangkis',
        // ]);

        // DB::table('siswa')->insert([
        //     'nama' => 'Intan Tri Suaka Henry',
        //     'NIS' => '12345',
        //     'NISN' => '12345',
        //     'jenis_kelamin' => 'Perempuan',
        //     'tempat_lahir' => 'Denpasar',
        //     'tanggal_lahir' => '2020-02-05',
        //     'agama' => 'Islam',
        //     'pendidikan_sebelumnya' => 'TK',
        //     'alamat' => 'Jl. Soetomo',
        // ]);

        // DB::table('data_orang_tua')->insert([
        //     'siswa_id' => 1,
        //     'nama_ayah' => 'tes',
        //     'nama_ibu' => 'tes',
        //     'pekerjaan_ayah' => 'tes',
        //     'pekerjaan_ibu' => 'tes',
        //     'jalan' => 'tes',
        //     'kelurahan' => 'tes',
        //     'kecamatan' => 'tes',
        //     'kota' => 'tes',
        //     'provinsi' => 'tes',
        // ]);

        // DB::table('rapor')->insert([
        //     'siswa_id' => 1,
        // ]);

        // DB::table('siswa')->insert([
        //     'nama' => 'Joko',
        //     'NIS' => '22345',
        //     'NISN' => '22345',
        //     'jenis_kelamin' => 'Laki-Laki',
        //     'tempat_lahir' => 'Denpasar',
        //     'tanggal_lahir' => '2020-02-05',
        //     'agama' => 'Islam',
        //     'pendidikan_sebelumnya' => 'TK',
        //     'alamat' => 'Jl. Soetomo',
        // ]);

        // DB::table('data_orang_tua')->insert([
        //     'siswa_id' => 2,
        //     'nama_ayah' => 'tes',
        //     'nama_ibu' => 'tes',
        //     'pekerjaan_ayah' => 'tes',
        //     'pekerjaan_ibu' => 'tes',
        //     'jalan' => 'tes',
        //     'kelurahan' => 'tes',
        //     'kecamatan' => 'tes',
        //     'kota' => 'tes',
        //     'provinsi' => 'tes',
        // ]);

        // DB::table('rapor')->insert([
        //     'siswa_id' => 2,
        // ]);

        // DB::table('siswa')->insert([
        //     'nama' => 'Dewa',
        //     'NIS' => '22345',
        //     'NISN' => '22345',
        //     'jenis_kelamin' => 'Laki-Laki',
        //     'tempat_lahir' => 'Denpasar',
        //     'tanggal_lahir' => '2020-02-05',
        //     'agama' => 'Islam',
        //     'pendidikan_sebelumnya' => 'TK',
        //     'alamat' => 'Jl. Soetomo',
        // ]);

        // DB::table('data_orang_tua')->insert([
        //     'siswa_id' => 3,
        //     'nama_ayah' => 'tes',
        //     'nama_ibu' => 'tes',
        //     'pekerjaan_ayah' => 'tes',
        //     'pekerjaan_ibu' => 'tes',
        //     'jalan' => 'tes',
        //     'kelurahan' => 'tes',
        //     'kecamatan' => 'tes',
        //     'kota' => 'tes',
        //     'provinsi' => 'tes',
        // ]);

        // DB::table('rapor')->insert([
        //     'siswa_id' => 3,
        // ]);

        // DB::table('siswa')->insert([
        //     'nama' => 'Dewi',
        //     'NIS' => '22345',
        //     'NISN' => '22345',
        //     'jenis_kelamin' => 'Perempuan',
        //     'tempat_lahir' => 'Denpasar',
        //     'tanggal_lahir' => '2020-02-05',
        //     'agama' => 'Islam',
        //     'pendidikan_sebelumnya' => 'TK',
        //     'alamat' => 'Jl. Soetomo',
        // ]);

        // DB::table('data_orang_tua')->insert([
        //     'siswa_id' => 4,
        //     'nama_ayah' => 'tes',
        //     'nama_ibu' => 'tes',
        //     'pekerjaan_ayah' => 'tes',
        //     'pekerjaan_ibu' => 'tes',
        //     'jalan' => 'tes',
        //     'kelurahan' => 'tes',
        //     'kecamatan' => 'tes',
        //     'kota' => 'tes',
        //     'provinsi' => 'tes',
        // ]);

        // DB::table('rapor')->insert([
        //     'siswa_id' => 4,
        // ]);

        // DB::table('siswa')->insert([
        //     'nama' => 'Della',
        //     'NIS' => '22355',
        //     'NISN' => '22355',
        //     'jenis_kelamin' => 'Perempuan',
        //     'tempat_lahir' => 'Denpasar',
        //     'tanggal_lahir' => '2020-02-05',
        //     'agama' => 'Islam',
        //     'pendidikan_sebelumnya' => 'TK',
        //     'alamat' => 'Jl. Soetomo',
        // ]);

        // DB::table('data_orang_tua')->insert([
        //     'siswa_id' => 5,
        //     'nama_ayah' => 'tes',
        //     'nama_ibu' => 'tes',
        //     'pekerjaan_ayah' => 'tes',
        //     'pekerjaan_ibu' => 'tes',
        //     'jalan' => 'tes',
        //     'kelurahan' => 'tes',
        //     'kecamatan' => 'tes',
        //     'kota' => 'tes',
        //     'provinsi' => 'tes',
        // ]);

        // DB::table('rapor')->insert([
        //     'siswa_id' => 5,
        // ]);
    }
}
