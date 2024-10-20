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
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '1998-06-19',
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
    }
}
