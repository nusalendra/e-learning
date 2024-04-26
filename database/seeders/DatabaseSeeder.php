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
            'username' => 'nusalendra',
            'password' => Hash::make('nusalendra'),
            'role' => 'Kepala Sekolah'
        ]);

        DB::table('users')->insert([
            'name' => 'Budi Setyo',
            'username' => 'budisetyo',
            'password' => Hash::make('password'),
            'role' => 'Wali Kelas'
        ]);

        DB::table('periode')->insert([
            'tahun_ajaran' => 'Tahun Ajaran 2021/2022',
        ]);

        DB::table('kelas')->insert([
            'periode_id' => 1,
            'nama' => 'Kelas 1',
        ]);

        DB::table('wali_kelas')->insert([
            'user_id' => 2,
            'kelas_id' => 1,
        ]);

        DB::table('semester')->insert([
            'nama' => 'Semester Ganjil',
        ]);

        DB::table('kelas_semester')->insert([
            'kelas_id' => 1,
            'semester_id' => 1,
            'status' => 'Dibuka'
        ]);

        DB::table('semester')->insert([
            'nama' => 'Semester Genap',
        ]);

        DB::table('kelas_semester')->insert([
            'kelas_id' => 1,
            'semester_id' => 2,
            'status' => 'Ditutup'
        ]);

        DB::table('kategori')->insert([
            'nama' => 'Mata Pelajaran',
        ]);

        DB::table('kategori')->insert([
            'nama' => 'Muatan Pelajaran',
        ]);
    }
}
